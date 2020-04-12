<?php

    if(isset($_POST["logout"])){
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
$_SESSION["userFirstName"] = "Robert";
$_SESSION["userLastName"] = "Noor";
    echo "<div id=\"topbar\"><img src=\"images/tlulogo.png\" id=\"tlu_logo\" alt=\"Tlu logo\"> 
    <div id='client_name'>".$_SESSION["userFirstName"]. " ".$_SESSION["userLastName"]."</div>
    <form method=\"POST\" action=\"". htmlspecialchars($_SERVER["PHP_SELF"])."\">
        <div type=\"submit\" id=\"logout\" name=\"logout\">
            <img id='logout_img' src=\"images/logout.png\" alt=\"logout\">
        </div>           
    </form>
    <link rel=\"stylesheet\" href=\"style.css\">
</div>";