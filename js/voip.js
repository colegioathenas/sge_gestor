/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    $("#msg").dialog({modal: true, autoOpen: false,width: 500} );
    
  
    function updateTime() {
        $.ajax({
                url: '../Util/asterisk_verifica.php',

                data: {  },

                success: function(html){
                    
                      if (html   !== ""){
                          $("#msg").html(html); 
                        $("#msg").dialog("open");
                      }
                }

              });
    }
  
    updateTime();
    setInterval(updateTime, 2000); // 5 * 1000 miliseconds
});