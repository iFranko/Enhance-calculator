<?php
/**
 * Connect to the db
 * Name: Frank Kufer  
 */
try {
    $dbh = new PDO(
        "mysql:host=localhost;dbname=username",
        "username",
        "password"
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}
