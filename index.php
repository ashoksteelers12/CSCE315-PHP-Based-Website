<html>

<!-- HEAD section ............................................................................ -->
<head>
  <title> Ashok Meyyappan's Website </title>
  <link rel="stylesheet" href="main.css">
</head>

<!-- BODY section ............................................................................. -->
<body>
<div class="defaultFont">

<!-- PHP testing area ................................ --> 
<?php

   echo "<center>";
   echo "<ul class=\"links_ul\">\n";
   echo "<li class=\"links_li\"><h1 style=\"color:red;\"> Ashok Meyyappan's Resume </h1></li>\n"; //Page title
   echo "</ul>\n";

   echo "<ul class=\"links_ul\">\n";
   echo "<li class=\"links_li\"><a href=\"index.php\">Home</a></li>\n";
   echo "<li class=\"links_li\"><a href=\"gallery.php\">Gallery</a></li>\n";
   echo "<li class=\"links_li\"><a href=\"blog.php\">Blog</a></li>\n";
   echo "<li class=\"links_li\"><a href=\"tips.php\">Tips</a></li>\n";
   echo "<li class=\"links_li\"><a href=\"resources.php\">Resources</a></li>\n";
   echo "<li class=\"links_li\"><a href=\"search.php\">Search</a></li>\n";
   echo "</ul>\n";

   echo "</center>";
   
   // Test cases for csv and wikitext
   include 'proc_wikitext.php';
   include 'proc_csv.php';
   proc_wikitext("index.wiki");
   proc_csv("experience.csv",",","\"","ALL");
?>

</div>

</body>

</html>