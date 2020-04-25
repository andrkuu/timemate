<?php

    if(isset($_POST["logout"])){
        session_unset();
        session_destroy();
        header("Location: ../");
        exit();
    }
    echo "<div id=\"topbar\"><img src=\"../images/tlulogo.png\" id=\"tlu_logo\" alt=\"Tlu logo\"> 
    <div id='client_name'>".$_SESSION["userFirstName"]. " ".$_SESSION["userLastName"]."</div>
    <form method=\"POST\" action=\"". htmlspecialchars($_SERVER["PHP_SELF"])."\">
        <button type=\"submit\" id=\"logout\" name=\"logout\">
            <img id='logout_img' src=\"../images/logout.png\" alt=\"logout\">
        </button>       
    </form>
    <link rel=\"stylesheet\" href=\"../style.css\">
</div>";