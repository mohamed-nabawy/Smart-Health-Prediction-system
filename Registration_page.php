<?php
session_start();

global $conn;
$servername = "localhost";
$username = "root";
$password_ = "";
$dbname = "healthapp";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_);

$first_name = $last_name= $email = $password = $confirm_password = $gender = $DOB= $region = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
        $first_name = test_input($_POST["first_name"]);
        $last_name = test_input($_POST["last_name"]);
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);
        $confirm_password = test_input($_POST["password_confirmation"]);
        $gender = test_input($_POST["gender"]);
        $DOB = test_input($_POST["DOB"]);
        $region = test_input($_POST["region"]);
}
if (duplication($first_name, $email) === FALSE) {

    header('Location: Registration_page.html');
    exit();
}

function test_input($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

try {
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO `users` (`first_name`, `last_name`,`e_mail`, `password`, `gender`,`DOB`, `region`, `image`) VALUES (:first_name,:last_name, :email, :password , :gender, :DOB, :region)");
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':DOB', $DOB);
    $stmt->bindParam(':region', $region);
    $stmt->execute();
    $sql = "SELECT * FROM users where e_mail=:email and password=:password";
    $stmt1 = $conn->prepare($sql);
    $stmt1->bindParam(':email', $_POST['email']);
    $stmt1->bindParam(':password', $_POST['password']);
    $stmt1->execute();
    $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    
    echo "New records created successfully";
    $_SESSION['id'] = $result[0]['id'];
    $_SESSION['first_name'] = $result[0]['first_name'];
    $_SESSION['last_name'] = $result[0]['last_name'];
    $_SESSION['e_mail'] = $result[0]['e_mail'];
    header('Location: My_Profile.php');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

function duplication($first_name, $email) {
    global $conn;
    $sql = "SELECT * FROM users where e_mail=:email";
    $stmt = $conn->prepare($sql);
   // $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if (empty($result)) {
        return true;
    } else {
        return false;
    }
}
