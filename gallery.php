<html>

<!-- HEAD section ............................................................................ -->
<head>
  <title> Ashok Meyyappan's Website </title>
  <link rel="stylesheet" href="image.css">
</head>

<!-- BODY section ............................................................................. -->
<body>
<div class="defaultFont">

<!-- PHP testing area ................................ --> 
<?php

   echo "<center>";
   echo "<ul class=\"links_ul\">\n";
   echo "<li class=\"links_li\"><h1 style=\"color:red;\"> Ashok Meyyappan's Gallery </h1></li>\n"; //Page title
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
   
   include 'proc_gallery.php';
   proc_gallery("gallery_test.csv", "list", "orig");

   // Test cases for interactive gallery - taken out for final submission
   /*
   // echo "<center><h1 style=\"color:green;\"> Matrix </h1><hr>\n";
   proc_gallery("gallery_test.csv", "matrix", "date_newest");
   proc_gallery("gallery_test.csv", "matrix", "date_oldest");
   proc_gallery("gallery_test.csv", "matrix", "size_largest");
   proc_gallery("gallery_test.csv", "matrix", "size_smallest");
   proc_gallery("gallery_test.csv", "matrix", "rand");
   proc_gallery("gallery_test.csv", "matrix", "orig");

   // echo "<center><h1 style=\"color:green;\"> Details </h1><hr>\n";
   proc_gallery("gallery_test.csv", "details", "date_newest");
   proc_gallery("gallery_test.csv", "details", "date_oldest");
   proc_gallery("gallery_test.csv", "details", "size_largest");
   proc_gallery("gallery_test.csv", "details", "size_smallest");
   proc_gallery("gallery_test.csv", "details", "rand");
   proc_gallery("gallery_test.csv", "details", "orig");

   // echo "<center><h1 style=\"color:green;\"> List </h1><hr>\n"; 
   proc_gallery("gallery_test.csv", "list", "date_newest");
   proc_gallery("gallery_test.csv", "list", "date_oldest");
   proc_gallery("gallery_test.csv", "list", "size_largest");
   proc_gallery("gallery_test.csv", "list", "size_smallest");
   proc_gallery("gallery_test.csv", "list", "rand");
   proc_gallery("gallery_test.csv", "list", "orig");
   */
   
?>

</div> 

</body>

</html>