<html>

<!-- HEAD section ............................................................................ -->
<head>
  <title> Ashok Meyyappan's Website </title>

  <!-- javascript functions -->
  <script>
  function randText() {
      let randomBits = ["hello world", "random thoughts", "pinky and the brain"];
      document.getElementById("demo").innerHTML = randomBits[Math.floor(Math.random()*3)];
  }
  </script>

  <!-- style -->
 
  <style>
    div.defaultFont {
        font-family: Helvetica, Arial, sans-serif;
    }
    
    div.secondaryFont {
        font-family: serif;
    }

    h3 {
        color: blue;
    }
    <!-- link href="default.css" rel="stylesheet" type="text/css -->
  </style>

  

</head>

<!-- BODY section ............................................................................. -->
<body>
<div class="defaultFont">

<!-- PHP testing area ................................ --> 
<?php

   echo "<h1 style=\"color:red;\"> Ashok Meyyappan </h1>\n";
   
   include 'proc_csv.php';
   include 'proc_wikitext.php';
   echo "<h1 style=\"color:green;\"> CSV File Processor </h1><hr>";
   proc_csv("test.csv",",","\"", "1:3:4:7");
   proc_csv("test.csv",",","\"", "ALL");
   echo "<h1 style=\"color:green;\"> Simplified Wikitext </h1><hr>";
   proc_wikitext("test.wiki");
?>

<!-- Java script testing area ............................... -->

<!-- HTML form input handling .......................... -->

</div> <!-- end of big div -->

</body>

</html>

