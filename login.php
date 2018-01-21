<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    global $conn;
    $servername = "localhost";
    $username = "root";
    $password_ = "";
    $dbname = "healthapp";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_);

    $sql = "SELECT * FROM users where e_mail=:email and password=:password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':password', $_POST['password']);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($result)) {
        header('Location: Registration_page.html');
        exit();
    }
    else {
        $_SESSION['id'] = $result[0]['id'];
        $_SESSION['first_name'] = $result[0]['first_name'];
        $_SESSION['last_name'] = $result[0]['last_name'];
        $_SESSION['e_mail'] = $result[0]['e_mail'];
        $_SESSION['symp_data'] ="";

        header('Location: My_Profile.php');
        exit();
    }
}
        
