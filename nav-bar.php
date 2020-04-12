<?php
    session_start();

    echo "<div id=\"topbar\">".$_SESSION["userFirstName"]. " ".$_SESSION["userLastName"]."
    <img src=\"images/tlulogo.png\" id=\"tlu_logo\" alt=\"Tlu logo\">
</div>";