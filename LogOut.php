<?php
/*  Name: Frank Kufer   
    Date: December 12th, 2020
    Description: this file allows the user to log out from the page by destroying 
    all the user information from the session
*/ 
session_start();
session_destroy();
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
       
        p{
            color: purple;
            margin-top: 25%;
        }
    </style>
</head>

<body id="img2">
    <p>You are Logged out<br><br>
     Please click <a href="index.html"> here</a> If you want to log in again</p>
</body>

</html>