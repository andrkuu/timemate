<?php
session_start();
include("../functions_subject.php");
include("../functions_main.php");

if(!isset($_SESSION["id"])){
    header("Location: ../");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" href="../images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css">
      <link rel="stylesheet" href="tools.css">
    <title>Ajalugu</title>
      <script src="../jquery.js"></script>
    <script>

        function deleteReporting(b){
            console.log(b.id);
            let idToDelete = b.id.split("delete_activity")[1];
            console.log("Delete"+b.id.split("delete_activity")[1]);

            $.ajax({

                type: "POST",

                url: "deleteActivity.php",

                data: {id:idToDelete},

                success : function(data){

                    if (data.code === "200"){
                        //succsess

                    } else {

                        //fail

                    }
                    loadReportings();

                }

            });




        }

        function loadReportings(){

            console.log("load");
            $.post('getPreviousActivities.php', {},
                function(data) {
                    $('#content_box').html(data);
                }
            );

        }

        loadReportings();

    </script>


  </head>
  <body>
    <?php include('../nav-bar.php'); ?>

    <div class="links">
        <a href="../statistika/" class="page" ><span class="link_names">Statistika</span><img src="../images/statistics.png" alt="statistics" class="link_icons" id="first_icon"></a>
        <a href="../aine/" class="page"> <span class="link_names">Aine</span><img src="../images/add.png" alt="statistics" class="link_icons" id="second_icon"></a>
        <a href="../kalender/" class="page" ><span class="link_names">Kalender</span><img src="../images/calendar.png" alt="statistics" class="link_icons" id="third_icon"></a>
        <a href="../seaded/" class="page" id="chosen" id="tools"><span class="link_names">Ajalugu</span><img src="../images/history.png" alt="statistics" class="link_icons" id="fourth_icon"></a>
    </div>

        <div id="history">
            <div id="history_header">Sinu eelmised sisestused</div>
            <div id="content_box">
                <?php
                /*
                if (isMobileDevice()){
                        echo getPreviousActivities(intval($_SESSION["id"]),3);
                    }
                else{
                        echo getPreviousActivities(intval($_SESSION["id"]),7);
                    }
                    */
                ?>
            </div>
            <a id="back_button" href="../aine/">Tagasi</a>
        </div>




    
  </body>
</html>