<?php

    if(isset($_POST["logout"])){
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
$_SESSION["userFirstName"] = "Robert";
$_SESSION["userLastName"] = "Noor";
    echo "<div id=\"topbar\">".$_SESSION["userFirstName"]. " ".$_SESSION["userLastName"]."
    <form method=\"POST\" action=\"". htmlspecialchars($_SERVER["PHP_SELF"])."\">
        <p><button type=\"submit\" id=\"logout\" name=\"logout\">Logi välja</button></p>           
    </form>
    <img src=\"images/tlulogo.png\" id=\"tlu_logo\" alt=\"Tlu logo\">
</div>";