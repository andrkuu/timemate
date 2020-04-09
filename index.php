<?php

require("functions_user.php");
require("functions_main.php");

if(isset($_POST["submit_button"])){

    echo "test";
$nameError = null;
$surnameError = null;
$birthMonthError = null;
$birthYearError = null;
$birthDayError = null;
$birthDateError = null;
$genderError = null;
$emailError = null;
$passwordError = null;
$confirmpasswordError = null;

//kui on uue kasutaja loomise nuppu vajutatud
if(isset($_POST["submitUserData"])) {


    //username
    if (isset($_POST["username"]) and !empty($_POST["username"])) {
        $surname = test_input($_POST["username"]);
    } else {
        $surnameError = "Palun sisesta perekonnanimi!";
    }

    //password
    if (isset($_POST["password"]) and !empty($_POST["surName"])) {
        $surname = test_input($_POST["surName"]);
    } else {
        $surnameError = "Palun sisesta perekonnanimi!";
    }



}

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>

    <div id="panner"><img src="images/tlulogo.png" id="tlu_logo" alt="Tlu logo"></div>

    <div id="login_container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <img src="images/tlu_logo_wide.jpg" id="tlu_logo2" alt="Tlu logo">
            <br><br>
            <input type="text" id="user_name" name="username" placeholder="ÕIS-i kasutajanimi">
            <br><br>
            <input type="password" id="password" name="password" placeholder="ÕIS-i parool">
            <br><br>
            <input type="checkbox" id="remember_me" name="remember" value="remember">
            <label for="remember_me">Mäleta mind</label>
            <br><br>
            <button type="submit" id="submit_button" name="submit_button" >Logi sisse</button>
        </form>
    </div>
    
</body>
</html>