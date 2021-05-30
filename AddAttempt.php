<?php
/*  Name: Frank Kufer  
    Date: December 12th, 2020
    Description: this file adds the pzrameters to an exsting table called upgradeattempt
    and retrun json_encode array of all the columns in that table
*/ 
session_start();
include "connect.php";
date_default_timezone_set("America/Toronto");

$access = isset($_SESSION["userEmail"]);
$email =  $_SESSION["userEmail"];
$attempt = filter_input(INPUT_GET, "attempt", FILTER_SANITIZE_SPECIAL_CHARS);
$chance = filter_input(INPUT_GET, "chance", FILTER_VALIDATE_FLOAT);
$grade = filter_input(INPUT_GET, "grade", FILTER_SANITIZE_SPECIAL_CHARS);
$date = date("Y-m-d");

if ($access) {
    if (
        $attempt !== "" && $attempt !== false && $attempt !== null &&
        $chance !== null && $chance !== false &&
        $grade !== "" && $grade !== false && $grade !== null

    ) {

        $command = "INSERT INTO `upgradeattempt`(`email`, `attempt`, `date`, `grade`, `enhancement_chance`) VALUES (?,?,?,?,?)";
        $stmt = $dbh->prepare($command);
        $success =  $stmt->execute([$email, $attempt, $date, $grade, $chance]);


        if ($success === false) {
            die("Bad DP Issue");
        }


        $command = "SELECT * FROM `upgradeattempt` WHERE email=? ";
        $stmt = $dbh->prepare($command);
        $success =  $stmt->execute([$email]);

        $output = [];
        while ($row = $stmt->fetch()) {
            $items = [
                "id" => (int)$row["id"],
                "email" => $row["email"],
                "attempt" => $row["attempt"],
                "date" => $row["date"],
                "grade" => $row["grade"],
                "enhancement_chance" => floatval($row["enhancement_chance"])

            ];
            $output[] = $items;
        }

        echo json_encode($output);
    } else {
        echo "there is something wrong with your parametes";
?>
        <p> Click<a href="index.html"> here</a> to Go Back</p>
    <?php
    }
} else {
    echo "please Log in ";
    ?>
    <p> Click<a href="index.html"> here</a> to Go Back</p>
<?php
}
