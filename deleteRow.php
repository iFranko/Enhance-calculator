<?php
/*  Name: Frank Kufer 
    Date: December 12th, 2020
    Description: this file delets a specific row by passing the id parameter as the primary key 
    in the upgradeattempt table and retrun json_encode array 
*/ 
session_start();
include "connect.php";

$access = isset($_SESSION["userEmail"]);
$email =  $_SESSION["userEmail"];
$id=  filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if($access){
    if(
       
        $id !== null && $id!== false 
        
    )
    {
    
        $command = "DELETE FROM `upgradeattempt` WHERE id=?";
        $stmt = $dbh->prepare($command);
        $success =  $stmt->execute([$id]);
    
    

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

        
    }
    else{
        echo "there is something wrong with your parametes";
        ?>
        <p> Click<a href="index.html"> here</a> to Go Back</p>
    <?php
    }
}else{
    echo "please Log in ";
    ?>
    <p> Click<a href="index.html"> here</a> to Go Back</p>
   <?php 
}