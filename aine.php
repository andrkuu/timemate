<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Aine</title>
  </head>
  <body>
    <?php include('nav-bar.php'); ?>
    <div id="inputContainer">
      <label for="class">Aine </label>

      <select id="class">
        <option value="C#">C#</option>
        <option value="java">java</option>
        <option value="python">python</option>
        <option value="interaktsioonidisain">interaktsiooni disainid</option>
      </select>
      <br />

      <label for="type">Tüüp </label>

      <select id="type">
        <option value="rühm">rühmatöö</option>
        <option value="iseseisev">iseseisev töö</option>
        <option value="kodune">kodune töö</option>
      </select>
      <br />

      <label for="kulu">Kulu </label>
      <input type="time" id="kulu" name="time" />
      <input type="button" value="sisesta" id="button" />
    </div>

    <div class="links">
        <a href="statistika.php" class="lingid"> Statistika</a>
        <a href="aine.php" class="selectedLink" >Aine</a>
        <a href="kalender.php" class="lingid">Kalender</a>
        <a href="seaded.php" class="lingid"> Seaded</a>
    </div>
  </body>
</html>
