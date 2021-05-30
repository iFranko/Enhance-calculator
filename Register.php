<?php
/*  Name: Frank Kufer   
    Date: December 12th, 2020
    Description: this file adds the user name, age, email and password to an existing 
    table called login table 
*/ 
session_start();
include "connect.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Enhancement Simulator</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Enhancement.css">
    <script src="js/EnhancementAjax.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        p {
            margin-left: 5%;
            color: purple;
            font-size: 30px;

        }

        a {
            background-color: #0172BA;
            color: white;
            text-align: center;
            text-decoration: none;
            border: solid 1px #0172BA;
            border-radius: 50px;
            padding: 10px;
        }

        #correct {
            margin-top: 5px;
        }
    </style>
</head>

<body id="img2">

    <?php
    $email = filter_input(INPUT_POST, "newEmail", FILTER_VALIDATE_EMAIL);
    $user_password = filter_input(INPUT_POST, "newPass", FILTER_SANITIZE_SPECIAL_CHARS);
    $user_name = filter_input(INPUT_POST, "userName", FILTER_SANITIZE_SPECIAL_CHARS);
    $age = filter_input(INPUT_POST, "Age",  FILTER_VALIDATE_INT);
    $hash = password_hash($user_password, PASSWORD_DEFAULT);

    if (

        $email !== null && $email !== false && $email !== ""
        && $user_password !== null && $user_password !== false
        && $user_name !== null && $user_name !== false && $user_name !== ""
        && $age !== null && $age !== false


    ) {

        $command = "INSERT INTO `login`(`emailAddress`, `password`, `userName`, `age`) VALUES (?,?,?,?)";
        $stmt = $dbh->prepare($command);
        $success =  $stmt->execute([$email, $hash, $user_name, $age]);
        if ($success) {

    ?>
            <p style="color:green;">Thank You! your account has been created <img src='images/correct.png' id="correct"><br><br>
                Please click <a href="index.html"> here</a> to return to the main log in page</p>
        <?php



        } else {
        ?>
            <p>The Email Already Exit <img src='images/x.png'> <br><br>
               please click <a href="index.html"> here</a> to return to the main log in page</p>
        <?php
        }
    } else {

        ?>
        <p>Somehting Wrong went with inputs <img src='images/x.png'> <br><br>
          please click <a href="index.html"> here</a> to return to the main log in page</p>
    <?php
    }
    ?>
</body>

</html>