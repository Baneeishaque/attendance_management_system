<?php

require 'dbconfig.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  
    $sql = "SELECT role FROM LOGIN WHERE `username`=:user AND `password`=:pass";
    $result = $conn->prepare($sql);
    $result->bindParam(':user', $_POST['username'], PDO::PARAM_STR);
    $result->bindParam(':pass', $_POST['password'], PDO::PARAM_STR);

    if ($result->execute()) {
        $number_of_rows = $result->rowCount();
        
        if ($number_of_rows > 0) {

            session_start();
            $_SESSION["user"] = $_POST['username'];
            $row = $result->fetch(PDO::FETCH_ASSOC);
           
            if ($row['role'] == "admin") {
              header("Location: admin_das.php");
              } else {
              header("Location: user_das.php");
              } 
        } else {
            echo '<div id="box"><label>Email Or Password Was Incorrect</label></div>';
        }
    } else {
        die("Can't execute the query");
    }
} catch (PDOException $pe) {
    die("Can't connect to the database $dbname :" . $pe->getMessage());
}
