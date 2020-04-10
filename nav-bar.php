<?php
    session_start();
    echo "<div id=\"topbar\">".$_SESSION["userFirstName"]. " ".$_SESSION["userLastName"]."</div>";


