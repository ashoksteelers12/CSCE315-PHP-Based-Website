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
   echo "<li class=\"links_li\"><h1 style=\"color:red;\"> Ashok Meyyappan's Tips </h1></li>\n"; //Page title
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
?>

<h3>Debugging Tips</h3>
<ul>
    <li>Test each part one by one instead of the whole code.</li>
    <li>For parsing, test one csv file at a time. Change each csv file to get more scenarios.</li>
    <li>Check error message. Comment out all the future code and fix that part first.</li>
    <li>Don't leave debugging to the end! Start at the beginning for each line!</li>
</ul>
<h3>Regex Expressions Tips</h3>
<ul>
    <li>Test regex for all possible scenarios.</li>
    <li>Think small first. Sometimes the most simplest regex can work for all cases!</li>
    <li>Start testing on the easiest possible input, then gradually get to the harder ones.</li>
</ul>
<h3>Sorting Tips</h3>
<ul>
    <li>When sorting, the usort() function is really helpful. Like Java comparator</li>
    <li>Don't mix up the > and < in the return statement for usort(). You may get the reverse order...unless you want it that way.</li>
    <li>Test out the sort for larger datasets, since it may not work for some values.</li>
</ul>
<h3>Additional Tips</h3>
<p>Ordered lists from wikitext to html can be hard. Here's a good way to approach this.</p>
<pre>
    <code>
        // Set Count Variable
        $count1, $count2, $etc = 0;
        // Increase count for each call of ordered list 
        $count1++; or $count2++; or $etc++;
    </code>
</pre>
<p>Getting the right spacing can be hard. Using tabs for spacing can be annoying. Try this!</p>
<pre>
    <code>
        // Use the div tag's spacing component
        text-indent: 2em;
        // Very useful for indenting wikitext in html if tabs aren't your best friend.
    </code>
</pre>
<h2>The Most Important Tip....<h2>
<h4>Always start coding early if you have a deadline. Deadlines approach faster than expected!</h4>

</div>

</body>

</html>