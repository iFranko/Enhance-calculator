<?php
/*  Name: Frank Kufer 
    Date: December 12th, 2020
    Description: this file delets all the rows to a specific email that identify as forgin key
    in the upgradeattempt table and retrun an empty json_encode array 
*/ 
session_start();
include "connect.php";

$access = isset($_SESSION["userEmail"]);
$email =  $_SESSION["userEmail"];
if($access){

    
        $command = "DELETE FROM `upgradeattempt` WHERE email =?";
        $stmt = $dbh->prepare($command);
        $success =  $stmt->execute( [$email] );
    

        if ($success === false){
            die("Bad DP Issue");
        }

    
        $command = "SELECT * FROM `upgradeattempt` WHERE email=? ";
        $stmt = $dbh->prepare($command);
        $success =  $stmt->execute([$email]);
        
        $output=[];
        while($row =$stmt->fetch()){
                $items = [
                    "id"=> (int)$row["id"],
                    "email" => $row["email"],
                    "attempt" => $row["attempt"],
                    "date" => $row["date"],
                    "grade" => $row["grade"],
                    "enhancement_chance"=> floatval($row["enhancement_chance"])
                    
                ];
            $output[]=$items;
        }

        echo json_encode($output);
}else{
    echo "please Log in ";
    ?>
    <p> Click<a href="index.html"> here</a> to Go Back</p>
   <?php 
}