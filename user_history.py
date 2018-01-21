# -*- coding: utf-8 -*-
#import string
import MySQLdb
from operator import itemgetter, attrgetter, methodcaller
import sys,os
#import datetime
from html import HTML


def  get_user_history (user_id):# each symptom with its rank in the dictionary
    dis_history = {}
    dis_history_list = []     
    cur.execute("select  disease_id , age , search_date  from user_history  where user_id = {0}".format(user_id)) 
    results = cur.fetchall()
    for row in results:
        dis_id = int(row[0])
        cur.execute("select  disease_name from diseases where disease_id = {0}".format(dis_id))
        dis_name = cur.fetchone()[0]
        #dis_name = str(results_name).replace("('","").replace("',)","")
        dis_history[dis_name]=[]
        dis_history[dis_name].append(str(row[1]))#age 
        dis_history[dis_name].append(str(row[2])) # search_date   
        
    #for key, value in dis_history.items():
        #value[0] = str(value[0])
        #value =  ','.join(value)
        #value = str(value).replace(","," years / ")
        #dis_history[key] = value
        #arr.replace("'", "").replace(']', '')   

    #dis_history_list = dis_history.items()
    #dis_history_list = str(dis_history_list).replace('[','').replace(']','').replace("('","").replace("',),","").replace("'","").replace(',',' years /')
    h =HTML()
    t = h.table(klass= '', style=' border: 3px solid red; border-collapse: collapse;padding: 15px;  text-align:center; background-color: #f1f1c1; border-color:red;')
    headers = t.tr
    headers.th('Disease' , style =' border: 3px solid black; font-size:xx-large; color:chocolate; text-align:inherit;' )
    headers.th('Age' , style =' border: 3px solid black; font-size:xx-large;color:chocolate; text-align:inherit;')
    headers.th(' Search Date' , style =' border: 3px solid black; font-size:xx-large;color:chocolate; text-align:inherit;')

    #headers.td('Search Date')

    #print dis_history_list
    for disease in dis_history.keys():
        r = t.tr
        r.td(disease , style =' border: 3px solid black; font-size:large;text-align:inherit;')
        r.td(dis_history[disease][0] , style =' border: 3px solid black; font-size:large;text-align:inherit;')
        r.td(dis_history[disease][1] , style =' border: 3px solid black; font-size:large;text-align:inherit;')

      #  r.td(element[2])

    print t
    #htmlcode = HTML.table(dis_history_list, header_row=['Disease', 'Age / Search Date'])
    #print htmlcode
    #print str(dis_history_list).replace('[','').replace(']','').replace("('","").replace("',),","").replace("'","").replace(',',' years /')
#******************* --------- Main --------- *******************

db_con = MySQLdb.connect(host="localhost",    # your host, usually localhost
                             user="root",         # your username
                             passwd="",  # your password
                             db="healthapp")        # name of the data base


cur = db_con.cursor() # open the connections

if __name__ == "__main__":
    userid = sys.argv[1]
    get_user_history(userid)
    #db_con.commit()
db_con.close() # close the db connection
