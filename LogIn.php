<?php
/*  Name: Frank Kufer  
    Date: December 12th, 2020
    Description: this file checks if the user has an email and also check if the password that was entered matches 
    the password that was register with.
*/ 
session_start();
include "connect.php";

$email = filter_input(INPUT_POST, "userEmail", FILTER_VALIDATE_EMAIL);
$user_password = filter_input(INPUT_POST, "userPass", FILTER_SANITIZE_SPECIAL_CHARS);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Enhancement Simulator</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Enhancement.css">
    <script src="js/Ajax.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <style>
        a {
            background-color: purple;
            color: white;
            text-align: center;
            text-decoration: none;
            border: solid 1px purple;
            border-radius: 50px;
            padding: 10px;
        }

        input {
            background-color: purple;
            margin-bottom: 20px;
            box-sizing: 100%;
            font-size: xx-large;
            border: 1px solid purple;
            text-decoration: none;
            border: solid 1px purple;
            border-radius: 50px;

        }

        div {
            margin-top: 5%;
            margin-left: 5%;
        }

        button {
            background-color: purple;
            margin-bottom: 20px;
            box-sizing: 100%;
            font-size: xx-large;
            border: 1px solid purple;
            text-decoration: none;
            border: solid 1px purple;
            border-radius: 50px;
        }

        #info p {
            font-size: xx-large;
            color: purple;

        }
    </style>
</head>

<body id="img2">
    <?php

    if (

        $email !== null && $email !== false && $email !== ""
        && $user_password !== null && $user_password !== false

    ) {
        $command = "SELECT `emailAddress`, `password`, `userName`, `age`  FROM `login` WHERE emailAddress=?";
        $stmt = $dbh->prepare($command);
        $success =  $stmt->execute([$email]);
        $emailCheck = $stmt->fetch();



        if (!$emailCheck) {
    ?>
            <p>The Email Does not Exit <br><br>
                Click <a href="index.html"> here</a> to go back to log in page</p>
            <?php
            session_destroy();
        } else {
            $checkPass = $emailCheck["password"];
            if (password_verify($user_password, $checkPass)) {
                $_SESSION["userName"] = $emailCheck["userName"];
                $_SESSION["userEmail"] = $emailCheck["emailAddress"];

                if (isset($_SESSION["userEmail"])) {
            ?>
                    <div>
                        <form action="main.php" id="main">
                            <input type="submit" value="Start The Enhance Simulator">
                        </form>
                        <form action="LogOut.php" id="logout">
                            <input type="submit" value="Log Out">
                        </form>

                        <button id="help">help</button>

                    </div>
                    <div id="info" style="visibility: hidden;">
                    <button id="unhelp">Go Back</button>
                        <p id="p">
                            Enhance Simulator calculator <br>is based on the game,
                            Black<br> Desert gear Enhancement.<br> This app only calculates
                            the <br>filastack* with the original<br> chance % of the gear.<br>
                            The higher the grade level is<br> the lower chance 
                            and the ha<br>rder is to enhance it.<br><br><br><br>

                            *failstack(is the number of failling attempts <br>
                            added to the origianl level chance % of thegear)
                        </p>
                        
                    </div>
                <?php
                } else {
                    session_destroy();
                ?>
                    <p>Pleae log in again <br><br>
                        Click <a href="index.html"> here</a> to go back to log in page</p>
                <?php
                }
            } else {

                ?>
                <p>Access denied password is incorrect<br><br>
                    Click <a href="index.html"> here</a> to go back to log in page</p>
        <?php
                session_destroy();
            }
        }
    } else {

        ?>
        <p>Somehting Wrong went with inputs<br><br>
            Click <a href="index.html"> here</a> to go back to log in page</p>
    <?php
    }
    ?>
</body>

</html>