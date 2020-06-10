<?php

    if(isset($_POST["logout"])){
        session_unset();
        session_destroy();
        header("Location: ../");
        exit();
    }
    echo "<div id=\"topbar\"><img src=\"../images/tlulogo.png\" id=\"tlu_logo\" alt=\"Tlu logo\"> 
    <div id='client_name'><a href=\"../seaded\" id='client_link'>".$_SESSION["userFirstName"]. " ".$_SESSION["userLastName"]."</a></div>
      <form method=\"POST\" action=\"". htmlspecialchars($_SERVER["PHP_SELF"])."\">
        <button type=\"submit\" id=\"logout\" name=\"logout\">
            <img id='logout_img' src=\"../images/logout.png\" alt=\"logout\">
        </button>       
    </form> 
    
    <div id=\"myLinks\">
    <a id=\"Links\" href=\"../seaded\">Seaded</a>
    <form method=\"POST\" action=\"". htmlspecialchars($_SERVER["PHP_SELF"])."\">
        <button type=\"submit\"  id=\"Linkout\" name=\"logout\">Logi välja</button>       
    </form>
    
  </div>
  <a href=\"javascript:void(0);\" id='img_container' onclick=\"myFunction()\">
    <img class=\"rotate\" id='dropdown_img' src=\"../images/dropdown.png\" alt=\"dropdown\">
  </a>
  
  <script>
    function myFunction() {
      var x = document.getElementById(\"myLinks\");
      var y = document.getElementById(\"client_name\"); 
      var z = document.getElementById(\"tlu_logo\");
      var r = document.getElementById(\"img_container\");
      
      if(x.style.display === \"block\") {
        x.style.display = \"none\";
        y.style.display = \"flex\";
        z.style.display = \"flex\";       
        r.style.transform = \"rotate(360deg)\";

      } else {
        x.style.display = \"block\";
        y.style.display = \"none\";
        z.style.display = \"none\";
        r.style.transform = \"rotate(180deg)\";
      }
    }
    
</script>
   
    <link rel=\"stylesheet\" href=\"../style.css\">
</div>";