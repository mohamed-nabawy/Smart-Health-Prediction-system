from mrjob.job import MRJob
import MySQLdb
import sys,os
import matplotlib.pyplot as plt
from math import exp, expm1, log10
from datetime import date



syms_ids=[]
mr_out_diseases_glob=[]



db_con = MySQLdb.connect(host="localhost",    # your host, usually localhost
                             user="root",         # your username
                             #passwd="",  # your password
                             db="healthapp")        # name of the data base

cur = db_con.cursor() # open the connections


cur.execute( "select count(distinct Disease_ID) from user_history" )
    
distinct_histroy=int(cur.fetchone()[0])

cur.execute( "select count(*) from diseases" )
	    
diseases=int(cur.fetchone()[0])

	    # what if the disease doesn't exist in the user_history >>> pr = 0 ???????????????????????????
if  distinct_histroy == diseases : # also work for smoothing of prior
	naiive = True
			
else:
	naiive = False




class firstSearching(MRJob):
	
		

	def mapper(self, _, symptoms):

		
		syms_ids2=get_symptoms_ids(symptoms)
		
		syms_dic = {}

		cur.execute( "select symptom_id , symptom_name , rank from symptoms where symptom_id in {0}" .format(tuple(syms_ids2)) )
		results = cur.fetchall()
		

		for row in results:
			sym_name =row[1].rstrip()
			syms_dic[sym_name]=[]
			syms_dic[sym_name].append(int(row[0]))#id
			syms_dic[sym_name].append( int(row[2])) # rank
	            

		entered_symptoms=list(syms_dic.keys())
		#finished Entery of symptoms ^_^
		#get diseases related to the Selected symptoms
		


		for x in entered_symptoms:
			dis_id =[]
			cur.execute("SELECT disease_name ,disease_id FROM diseases WHERE disease_id IN (SELECT disease_id FROM symptoms_diseases WHERE symptom_id = %s )"% (syms_dic[x][0]) )
			results = cur.fetchall()
		    
		    
			for row in results:
			    dis_id.append((row[0].rstrip() ,int(row[1])))

			
			# get all disases alone in one list

			for dis in  dis_id :
				rank = syms_dic[x][1]
				yield(dis, rank)






		# called for each diseases or key
	def reducer(self, disease, ranks):
		#print sum(ranks)
		disease[0]= disease[0].encode('ascii')
	    
    # what if the disease doesn't exist in the user_history >>> pr = 0 ???????????????????????????
	    
		#print syms_ids

		if naiive :
			naiive_method((disease, sum(ranks)) , syms_ids)

		else:
			mr_out_diseases_glob.append((disease , sum(ranks)))
	
		#print (disease, sum(ranks))
		#yield(disease, sum(ranks))



	combiner = reducer	




def get_symptoms_ids(lines):
	
	fline_adder = lines.rstrip(' ').split('%')	
	
					
	if fline_adder [-1] == '':
		fline_adder = fline_adder[0:-1]

	symps_mapper = {}

	for line in fline_adder:
		line = line.replace("'","\\'")
		cur.execute("select symptom_id from symptoms where symptom_name = '%s'" %(line))
		symps_mapper[line] = int(cur.fetchone()[0])
	
	
	for x in list(symps_mapper.values()):
		syms_ids.append(x)
	
	return list(symps_mapper.values())



def naiive_method( mapper_out_disease ,symptoms_ids ):

	#naiive_out_disease= [] 
	try:
		
		cur.execute( "select count(*) from  user_history" )
		results = cur.fetchone()[0]
		count_all_dis_history=long(results)

		current_dis_id = mapper_out_disease[0][1] # get the id_disease .....  at least one disease in the output

		cur.execute( "select count(*) from  user_history where disease_id = (%s)" % (current_dis_id ) )
		count_current_dis_history =int( cur.fetchone()[0]) 

		
		   
		   
		# must insert values rather than zeros in count in the db
		Pr_current_dis = count_current_dis_history/float(count_all_dis_history) # prior of current disease 
		
		cur.execute( "select user_history_id from user_history where disease_id =( %s) " % (current_dis_id ) )
		results =(cur.fetchall()) 

		user_history_ids= [] 
		for row in results:
			user_history_ids.append(int(row[0]))


		symptoms_hist_ids_list=[]

		for h_id in user_history_ids:
		    cur.execute( "select symptom_id from  symptoms_history where user_history_id =( %s) " % (h_id ) )
		    results =cur.fetchall()
		    for result in results:
			symptoms_hist_ids_list.append(int(result[0])) 
		     

		symptoms_hist_ids_set= set(symptoms_hist_ids_list)   

		Pr_sym_given_current_dis=1.0


		# calculate pr of  symptoms|disease

		for sym_id in symptoms_ids:
		    if not sym_id in symptoms_hist_ids_set:
		        # go to smoothing
		        alpha=1.0
		        Pr_sym_given_current_dis *=   alpha /(len(symptoms_hist_ids_set)*alpha+ count_current_dis_history)#  * count_current_dis_history
		         # 1 /(no_of_syms + no_of_dis_in_the_history)
		    else:
		    	#print  mapper_out_disease[0][0] , 'No smoothing'
		        # calculate multiplication of liklihoods of pr( symptoms |disease)
		        Pr_sym_given_current_dis *=(symptoms_hist_ids_list.count(sym_id))/float(len(symptoms_hist_ids_list))


		# need work

		    
		# calculate posterior of  pr(disease|symptoms )   
		Pr_sym_given_current_dis*=Pr_current_dis

		# smoothing  = 1 / distinct  examples
		mr_out_diseases_glob.append(( mapper_out_disease[0] ,  Pr_sym_given_current_dis))
		# if Pr_sym_given_higher_dis < Pr_sym_given_current_dis:    #       i was right  
		#     higher_dis_id=current_dis_id
		#     Pr_sym_given_higher_dis=Pr_sym_given_current_dis


		# when classify >> make count+1 or hit the disease in the user_history table

		#return naiive_out_disease                
	except Exception as e:
		exc_type, exc_obj, exc_tb = sys.exc_info()
		fname = os.path.split(exc_tb.tb_frame.f_code.co_filename)[1]
		print(exc_type, fname, exc_tb.tb_lineno)






def  save_record_history (higher_dis_id , user_id , symptoms_ids):

    try:
    
        cur.execute("select DOB  from users  where user_id =  {0}" .format (user_id ))

        DOB = (cur.fetchone()[0])
        years = (date.today().year-DOB.year) 
  
        if date.today().month <  DOB.month:
            years-=1
    

        cur.execute("INSERT INTO  user_history  (user_id , disease_id , age , search_date) VALUES ({0},{1},{2} ,'{3}' )" .format (user_id ,higher_dis_id , years , date.today() ))

        
        cur.execute("select user_history_id from user_history order by user_history_id DESC limit 1")
        last_user_history_id= int(cur.fetchone()[0])

       	#print last_user_history_id

        # update symptoms history

        for sym_id in symptoms_ids : 
            cur.execute("INSERT INTO  symptoms_history ( user_history_id , symptom_id ) VALUES ( %s , %s)" % ( last_user_history_id , sym_id ) )# wrong to take count as if some users were deleted , count-1 != last id

        #db_con.close() # close the db connection
 
    except Exception as e:
        raise
    else:
        pass
    finally:
        pass



def automated_ranking():

    #select each symptom's count from DB
    cur.execute("select  symptom_id , count(symptom_id)  from symptoms_diseases  group by symptom_id ") 
    results = cur.fetchall()

    max_occurences = max([ y for x,y in results ])

    # foreach symptom , we insert the count of it to an inverse relation to get the rank and insert the parameter "max_occurences" to the function
    for row in results:
        new_rank = reevaluate_rank(int(row[1]) , max_occurences)
        symptom_id= row[0]
        cur.execute("update symptoms set  rank ={0}  where symptom_id={1} ".format(new_rank , symptom_id)) 


    return True



def  reevaluate_rank ( x  , max_occurences ):# each symptom with its rank in the dictionary

	y =   - x  +  (1  + max_occurences)

	return  y # to remove from the results








#*************************************Main*********************************
#automated_ranking()

if __name__ == '__main__':
	userid = sys.argv[1]
	firstSearching().run()
	
	

mr_out_diseases_glob.sort(key=lambda tup: tup[1] , reverse=True) 


if len(mr_out_diseases_glob) > 6 :
	mr_out_diseases_glob = mr_out_diseases_glob[:6]

sum_Of_Probs=0

dt_out_diseases={}

for disease in mr_out_diseases_glob:
	name_id_list , score = disease
	if score != 0.0 :
		dt_out_diseases[name_id_list[0]] = score
		sum_Of_Probs += score


for key in dt_out_diseases.keys():
	dt_out_diseases[key] = dt_out_diseases[key]*100.0/float(sum_Of_Probs)

#print mr_out_diseases_glob



centers = range(len(dt_out_diseases))
plt.figure()
plt.bar(centers, dt_out_diseases.values(), align='center', tick_label=dt_out_diseases.keys())
plt.tight_layout()
plt.xticks(rotation=90)
plt.gca().axes.yaxis.set_ticklabels([])
plt.savefig('results.png',bbox_inches='tight')

higher_dis_score = mr_out_diseases_glob[0][1]

#out_dict = dict(zip(mr_out_diseases_glob[0::2], a[1::2])

print r'<h3 style="color:chocolate ;">The Heighest Diseases Scores in percentage  are :- </h3>'
for dis in mr_out_diseases_glob:  
    score =dis[1]
    if score==higher_dis_score :
    	save_record_history( dis[0][1] , userid , syms_ids)
    	print "<h4 style='color:blue ;'>{0} : {1} % .</br></h4>".format( dis[0][0] , round(dt_out_diseases[dis[0][0]] , 2))





db_con.commit()
db_con.close() # close the db connection
