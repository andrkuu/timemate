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
        <form action="/aine.php">
            <img src="images/tlu_logo_wide.jpg" id="tlu_logo2" alt="Tlu logo">
            <br><br>
            <input type="text" id="user_name" name="password" placeholder="ÕIS-i kasutajanimi">
            <br><br>
            <input type="password" id="password" name="password" placeholder="ÕIS-i parool">
            <br><br>
            <input type="checkbox" id="remember_me" name="remember" value="remember">
            <label for="remember_me">Mäleta mind</label>
            <br><br>
            <button type="button" id="submit_button" onclick="alert('Sul on 0 uut teavitust')">Logi sisse</button>
        </form>
    </div>
    
</body>
</html>