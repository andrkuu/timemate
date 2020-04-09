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
  <div id="topbar"></div>
    <div id="inputContainer">
      <label for="class">Aine </label>

      <select id="class">
        <option value="C#">C#</option>
        <option value="java">java</option>
        <option value="python">python</option>
        <option value="interaktsioonidisain">interaktsiooni disain</option>
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
        <a href="statistika.html"><button class="lingid">Statistika</button></a>
        <a href="aine.php"><button class="lingid">Aine</button></a>
        <a href="kalender.html"><button class="lingid">Kalender</button></a>
        <a href="seaded.html"><button class="lingid">Seaded</button></a>
      </div>
  </body>
</html>