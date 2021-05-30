/*  Name: Frank Kufer  
    Date: December 12th, 2020
    Description:this script is created to manipulate with the design of the main php file 
    and add functionality to it 
 */
window.addEventListener("load", function () {
    // setting defualt varaibles 
    //@rate is the rate of base level of an armor and weapon 
    //@chance is the base grade chance
    //@failstack is the number of faild attempts from lower grade to higher one 
    //@count keeps track of how many times addFive and TakeFive is called to be used later in mathematical calculation
    let rate = 5.88;
    let chance = 11.76;
    let failstack = 0;
    let count = 0;
    let url = "selectAll.php?";
        fetch(url, {
                credentials: "include"
            })
            .then(response => response.json())
            .then(success)
 
    //Adding a listener to the form submit button 
    //@irand is the an random number from one to 100
    //@total is used to find what is the % that the item will success at 
    //@attempt hold a string if the enhance is success or fail  
    //@grade is used to store the level of the grade 
    //@url stores the link of AddAttempt.php
    document.forms.EnhanceForm.addEventListener("submit", function (event) {
        event.preventDefault();
        $("#body").hide();
        $("#body").show(7000);
        let rand = Math.floor((Math.random() * 99) + 1);
        let total = 100 - chance;
        let attempt;
        let grade;
        //if the rand is greater than the total then the enhancemnt is success 
        if (total <= rand) {
            document.getElementById("image").style.visibility = "visible";
            $("#imgSuccess").show();
            $("#imgSuccess").hide(2000);
            attempt = "Success";
            //otherwise is fail 
        } else {
            document.getElementById("image1").style.visibility = "visible";
            $("#imgFail").show();
            $("#imgFail").hide(2000);
            attempt = "Fail";

        }
        if (rate == 5.88) {

            $("#pri").fadeOut().fadeIn(2000);
            grade = "PRI";
        } else if (rate == 3.85) {
            $("#duo").fadeOut().fadeIn(2000);
            grade = "DUO";
        } else if (rate == 3.13) {
            $("#tri").fadeOut().fadeIn(2000);
            grade = "TRI";
        } else if (rate == 1.00) {
            $("#tet").fadeOut().fadeIn(2000);
            grade = "TET";
        } else if (rate == 0.15) {
            $("#pen").fadeOut().fadeIn(2000);
            grade = "PEN";
        }

        let url = "AddAttempt.php?grade=" + grade + "&chance=" + chance + "&attempt=" + attempt;
        fetch(url, {
                credentials: "include"
            })
            .then(response => response.json())
            .then(success)



    });

    //success function creates a list of the number of fails and success 
    //span stores the a delete button, an image of delete, garde, chance, date
    //spanSucess stores the a delete button, an image of delete, garde, chance, date
    //id stroes the value of the id 
    function success(data) {

        let span = document.getElementById("outputFail");
        let spanSuccess = document.getElementById("outputSuccess");
        span.innerHTML = "";
        spanSuccess.innerHTML = "";

        for (let i = 0; i < data.length; i++) {

            //if success 
            if (data[i].attempt === "Success") {
                spanSuccess.innerHTML += "<button class='delete' value='" + data[i].id + "'><img src='images/delete.png' ></button> " +
                    data[i].grade + " Enhancement Successful! your chance: " + data[i].enhancement_chance + " last time played " + data[i].date + "<br>" + "<br>";
                spanSuccess.style.color = "rgb(0, 211, 11)";
                $("#outputSuccess").css("font-size", "30px");

            }
            // otherwise is fail 
            else {
                span.innerHTML += "<button class='delete' value='" + data[i].id + "'><img src='images/delete.png' ></button> " +
                    data[i].grade + " Enhancement Fail! your chance: " + data[i].enhancement_chance + " last time played " + data[i].date + "<br>" + "<br>";
                span.style.color = "red";
                $("#outputFail").css("font-size", "30px");

            }

        }
        //remove has anonymous functions that sends id parameter and deletes a single row 
        //@url stores the link of deleteRow.php
        remove = document.querySelectorAll(".delete");
        console.log(document.querySelectorAll(".delete"));
        for (let i = 0; i < remove.length; i++) {
            remove[i].addEventListener("click", function (e) {
                let id = remove[i].value;
                console.log(id);
                let url = "deleteRow.php?id=" + id;
                fetch(url, {
                        credentials: "include"
                    })
                    .then(response => response.json())
                    .then(success)

            });
        }
        //removeAll has anonymous functions that delete all rows 
        //@url stores the link of deleteAll.php
        removeALL = document.getElementById("reset");
        removeALL.addEventListener("click", function (e) {
            let url = "deleteAll.php?";
            fetch(url, {
                    credentials: "include"
                })
                .then(response => response.json())
                .then(success)

        });


    }


    //addFive adds five to the failstcak 
    addFive = document.getElementById("+5");
    addFive.addEventListener("click", five);

    function five() {
        count++;
        let span1 = document.getElementById("failstack");
        failstack += 5;
        if (rate === 5.88) {
            chance += rate;
            pri();
        } else if (rate === 3.85) {

            Duo();
        } else if (rate === 3.13) {

            Tri();
        } else if (rate === 1.00) {

            Tet();
        } else if (rate === 0.15) {

            Pen();
        }


        span1.innerHTML = failstack;

    }

    //takeFive function takes 5 of failstack 
    takeFive = document.getElementById("-5");
    takeFive.addEventListener("click", TakeFive);

    function TakeFive() {
        if (count > 0) {
            count--;
        }
        let span1 = document.getElementById("failstack");
        //take 5 off failsatck ony if failstack is greater than 0 
        if (failstack > 0) {
            failstack -= 5;
            span1.innerHTML = failstack;
        }
        if (rate === 5.88) {
            chance += rate;
            pri();
        } else if (rate === 3.85) {

            Duo();
        } else if (rate === 3.13) {

            Tri();
        } else if (rate === 1.00) {

            Tet();
        } else if (rate === 0.15) {

            Pen();
        }

    };
    //addten adds ten to filstack 
    addten = document.getElementById("+10");
    addten.addEventListener("click", ten);

    //ten function calls five function times 2
    function ten() {
        five();
        five();
    }

    //addTwentyFive adds 25 to failstack
    addTwentyFive = document.getElementById("+25");
    addTwentyFive.addEventListener("click", twentyFive);

    //twentyFive function calls five function times 5
    function twentyFive() {
        five();
        five();
        five();
        five();
        five();
    }
    //takeTen takes ten off from the failstack 
    takeTen = document.getElementById("-10");
    takeTen.addEventListener("click", TakeTen);
    //takeTen function calls TakeFive function times 2 
    function TakeTen() {
        TakeFive();
        TakeFive();
    }
    //takeTwentyFive takes 25 off from the failstack 
    takeTwentyFive = document.getElementById("-25");
    takeTwentyFive.addEventListener("click", TakeTwentyFive);
    //TakeTwentyFive function calls TakeFive function times 5
    function TakeTwentyFive() {
        TakeFive();
        TakeFive();
        TakeFive();
        TakeFive();
        TakeFive();
    }

    //items add event listener when the index is changed and sets the rate to the default pri level grade 
    items = document.getElementById("items");
    options = items.querySelectorAll("option");
    items.addEventListener("change", function () {
        if (items.value == "weapon") {
            rate = 5.88;
            pri();
        }
        if (items.value == "armor") {
            rate = 5.88;
            pri();
        }
    });

    //@span stores the chance of the success 
    //@grade stores the value of the grade level 
    //@NumFailStack calculates the grade rate times the number of counts to show each level grade percentage chance
    //@total stores the new chance // extra variable 
    //@pri stores the grade level 
    //@duo stores the grade level
    //@tri stores the grade level
    //@tet stores the grade level
    //@pen stores the grade level
    Pri = document.getElementById("pri");
    Pri.addEventListener("click", pri);

    function pri() {
        let span = document.getElementById("chance");
        let grade = parseFloat(Pri.value);
        rate = 5.88;
        let NumFailStack = rate * count;
        chance = grade;
        chance += NumFailStack;
        if (chance <= 90) {
            let total = chance;
            span.innerHTML = total.toFixed(2) + '%';
        }
    }

    duo = document.getElementById("duo");
    duo.addEventListener("click", Duo)

    function Duo() {
        let span = document.getElementById("chance");
        let grade = parseFloat(duo.value);
        rate = 3.85;
        let NumFailStack = rate * count;
        chance = grade;
        chance += NumFailStack;
        if (chance <= 90) {
            let total = chance;
            span.innerHTML = total.toFixed(2) + '%';
        }
    }



    tri = document.getElementById("tri");
    tri.addEventListener("click", Tri)

    function Tri() {
        let span = document.getElementById("chance");
        let grade = parseFloat(tri.value);
        rate = 3.13;
        let NumFailStack = rate * count;
        chance = grade;
        chance += NumFailStack;
        if (chance <= 90) {
            let total = chance;
            span.innerHTML = total.toFixed(2) + '%';
        }
    }


    tet = document.getElementById("tet");
    tet.addEventListener("click", Tet);

    function Tet() {
        let span = document.getElementById("chance");
        let grade = parseFloat(tet.value);
        rate = 1.00;
        let NumFailStack = rate * count;
        chance = grade;
        chance += NumFailStack;
        if (chance <= 90) {
            let total = chance;
            span.innerHTML = total.toFixed(2) + '%';
        }
    }

    pen = document.getElementById("pen");
    pen.addEventListener("click", Pen);

    function Pen() {
        let span = document.getElementById("chance");
        let grade = parseFloat(pen.value);
        rate = 0.15;
        let NumFailStack = rate * count;
        chance = grade;
        chance += NumFailStack;
        if (chance <= 90) {
            let total = chance;
            span.innerHTML = total.toFixed(2) + '%';
        }
    }





});