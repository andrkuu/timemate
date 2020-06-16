<?php

require("functions_user.php");
require("functions_main.php");

$notice = "";


// if login button has been pressed
if(isset($_POST["submit_button"])) {

    $usernameError = null;
    $passwordError = null;

    //username
    if (isset($_POST["username"]) and !empty($_POST["username"])) {
        $surname = test_input($_POST["username"]);
    } else {
        $usernameError = "Palun sisesta perekonnanimi!";
    }

    if (!isset($_POST["password"]) or strlen($_POST["password"]) < 3){
        $passwordError = "Palun sisesta parool, vähemalt 3 märki!";
    }

    if(empty($usernameError) and empty($passwordError)){
        $notice = signIn($_POST["username"], $_POST["password"]);
    } else {
        $notice = "Ei saa sisse logida!";
    }

    //echo $notice;

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="login.css">
    <title>| Login</title>
</head>
<body>

    <div id="banner"><img src="images/tlulogo.png" id="tlu_logo" alt="Tlu logo"></div>

    <div id="login_container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <img src="images/tlu_logo_wide.jpg" id="tlu_logo2" alt="Tlu logo">
            <br><br>
            <input type="text" id="user_name" name="username" placeholder="TLU Kasutajanimi">
            <br><br>
            <input type="password" id="password" name="password" placeholder="TLU Parool">
            <br><br>
            <input type="checkbox" id="remember_me" name="remember" value="remember">
            <label for="remember_me">Mäleta mind</label>
            <br><br>
            <button type="submit" id="submit_button" name="submit_button" >Logi sisse</button>
            <div id="error_message"><?php echo $notice; ?></div>
        </form>
    </div>
    
</body>
</html>