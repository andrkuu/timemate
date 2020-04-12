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
        <button type=\"submit\" id=\"logout\" name=\"logout\">Logi välja</button>           
    </form>
    <link rel=\"stylesheet\" href=\"style.css\">
</div>";