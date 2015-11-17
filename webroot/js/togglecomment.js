jQuery(function() {
    /*
    * Toggle answers on and off.
    */
    $("#showhidequestions").click(function(){
         $("#togglequestions").toggle();
         $("#toggleanswers").toggle();
     });
    
    /*
    * Toggle answers on and off.
    */
    $("#showhideanswers").click(function(){
         $("#togglequestions").toggle();
         $("#toggleanswers").toggle();
     });
    
    /*
    * Alert that user has to log in.
    */
    $(".notlogged").click(function(){
         alert("Skapa en användare och logga in för att ta del av Corgigruppen.");
     });
});
