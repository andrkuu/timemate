<?php

    if(isset($_POST["logout"])){
        session_unset();
        session_destroy();
        header("Location: ../");
        exit();
    }
    echo "<div id=\"topbar\"><img src=\"../images/tlulogo.png\" id=\"tlu_logo\" alt=\"Tlu logo\"> 
    <div id='client_name'><a href=\"../seaded\" id='client_link'>".$_SESSION["userFirstName"]. " ".$_SESSION["userLastName"]."</a></div>
    
    <div id=\"myLinks\">
    <a id=\"Links\" href=\"#news\">News</a>
    <a id=\"Links\" href=\"#contact\">Contact</a>
  </div>
  <a href=\"javascript:void(0);\" id='img_container' onclick=\"myFunction()\">
    <img id='dropdown_img' src=\"../images/dropdown.png\" alt=\"dropdown\">
  </a>
  
  <script>
    function myFunction() {
      var x = document.getElementById(\"myLinks\");
      var y = document.getElementById(\"client_name\"); 
      var z = document.getElementById(\"tlu_logo\");
      
      if (x.style.display === \"block\") {
        x.style.display = \"none\";
        y.style.display = \"flex\";
        z.style.display = \"flex\";
      } else {
        x.style.display = \"block\";
        y.style.display = \"none\";
        z.style.display = \"none\";
      }
    }
</script>
  
   <form method=\"POST\" action=\"". htmlspecialchars($_SERVER["PHP_SELF"])."\">
        <button type=\"submit\" id=\"logout\" name=\"logout\">
            <img id='logout_img' src=\"../images/logout.png\" alt=\"logout\">
        </button>       
    </form> 
  
   
    <link rel=\"stylesheet\" href=\"../style.css\">
</div>";