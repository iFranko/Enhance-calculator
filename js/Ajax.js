/*  Name: Frank Kufer 
    Date: December 12th, 2020
    Description:this script is created to manipulate with the design of the login php file 
    and add functionality to it 
 */
window.addEventListener("load", function () {
    

    //@Help gets the help button
    Help = document.getElementById("help");
    Help.addEventListener("click", help);
    //help function hides everything on the page and shows a paragraph 
    function help(){
        $("#main").hide();
        $("#logout").hide();
        $("#help").hide();
        let info=  document.getElementById("info");
        info.style.visibility="visible";
         info.style.color="white";
    }

    //@Unhelp gets the unhelp button
    Unhelp = document.getElementById("unhelp");
    Unhelp.addEventListener("click",unhelp);
    //unhelp function hides the paragraph and shows all the other things
    function unhelp(){
        $("#main").show();
        $("#logout").show();
        $("#help").show();
        let info=  document.getElementById("info");
        info.style.visibility="hidden";
    
    }


});