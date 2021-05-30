<?php
/*  Name: Frank Kufer  
    Date: December 12th, 2020
    Description: this file checks if the user is still logged in and if yes then 
    an html file will be created and the html is the game page where the user can interact with it
*/ 
session_start();
$access = isset($_SESSION["userEmail"]);

if ($access) {

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
            #enhance {
                background-color: rgb(0, 211, 11);
                color: white;
                text-decoration: none;
                border: solid 1px rgb(0, 211, 11);
                border-radius: 50px;
                padding: 10px;
            }

            .large button {
                font-size: xx-large;

            }

            .large {
                font-size: xx-large;

            }

            body {
                text-align: center;
                color: rgb(240, 171, 44);
            }

            button {
                background-color: #222;
                color: rgb(240, 171, 44);
            }

            #chance {
                color: rgb(0, 211, 11);
            }

            #items {
                font-size: xx-large;
                background-color: #222;
                color: rgb(240, 171, 44);
            }

        #logOut{
            margin-top: 20px;
            background-color: #0172BA;
            color: white;
            text-decoration: none;
            border: solid 1px  #0172BA;
            border-radius: 50px;
        }

        </style>
    </head>

    <body id="img3">
        <strong>

            <div class="MainHeader">
                
            
                <h1>Welcome <?= $_SESSION["userName"] ?></h1>
                <h1> Enhancement Simulator</h1>
                
                <form action="LogOut.php" >
                    <input type="submit" value="Log Out" id="logOut">
                </form>
                
            </div>

            <div id="body">
                <label for="items" class="large">Select Item type</label><br>
                <select name="items" id="items">
                    <option id="armor" id="armor">Armor</option>
                    <option id="weapon" value="weapon">Weapon</option>
                </select><br><br>
                <div class="large">
                    <button id="pri" value="11.76">Pri</button> <button id="duo" value="7.69">Duo</button> <button id="tri" value="6.25">Tri</button> <button id="tet" value="2">Tet</button> <button id="pen" value="0.30">Pen</button><br><br>

                    <button id="-25">-25</button> <button id="-10">-10</button> <button id="-5">-5 </button><span id="failstack"> 0 </span> <span> Fail Stacks </span> <button id="+5" value="5"> +5 </button> <button id="+10" value="10">+10</button> <button id="+25">+25</button>
                </div>

                <p class="large"> Enhancement Chance: <span id="chance">11.76%</span></p>

                <div>
                    <form id='EnhanceForm'>
                        <input id="enhance" type="submit" value="Enhance">
                    </form>
                </div>
                <div class="large">
                    <button id="reset">Reset</button>
                </div>
                <span id="outputFail"></span>
                <span id="outputSuccess"></span>
            </div>
        </strong>
        <span id="image" style="visibility: hidden;"><img src='images/success.png' id='imgSuccess'></span>
        <span id="image1" style="visibility: hidden;"><img src='images/fail.png' id='imgFail'></span>
    <?php


} else {
    ?>
        <p>Access denied Please Log In Again<br><br>
            Click <a href="index.html"> here</a> to go back to log in page</p>
    <?php
    session_destroy();
}
    ?>
    </body>

    </html>