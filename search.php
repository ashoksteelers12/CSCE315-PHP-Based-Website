<html>

<head>
  <LINK REL=StyleSheet HREF="simple.css" TYPE="text/css" MEDIA=screen>
</head>

<body>

<center>
    <h1>Search Page</h1>
    <a href="index.php">Back Home</a>
</center>

<p/>

<?php
function search($url, $string) {
    # check if $url is valid URL, not malicious code, then fetch and print
    if (filter_var($url,FILTER_VALIDATE_URL)) {
        echo "<pre class=\"code\">\n";
        # PHP system call to get html from URL
        $html = file_get_contents($url);  
        # Repalce HTML tags
        # $html = preg_replace("/</","[",$html);
        # $html = preg_replace("/>/","]",$html);

        if (strpos($html,$string) != false) {
            $html = preg_replace("/".$string."/","<mark>".$string."</mark>",$html);
        }

        $html = preg_replace("/<<mark>".$string."<\/mark>>/","<".$string.">",$html);
        $html = preg_replace("/<\/<mark>".$string."<\/mark>>/","</".$string.">",$html);
        $html = preg_replace("/=\"(.*)<mark>".$string."<\/mark>(.*)\"/","=\"$1".$string."$2\"",$html);
        $html = preg_replace("/<(.*)<mark>".$string."<\/mark>=/","<$1".$string."=",$html);
        $html = preg_replace("/<title>(.*)<mark>".$string."<\/mark>(.*)<\/title>/","<title>$1".$string."$2</title>",$html);
        $html = preg_replace("/<!--(.*)<mark>".$string."<\/mark>(.*)-->/","<!--$1".$string."$2-->",$html);


        echo "$html\n";
        echo "</pre>\n";
    } 
    else {
        echo "<pre class=\"code\">\n";
        echo "<pre>Warning: [$url] is empty or not a valid URL.</pre>\n";
        echo "</pre>\n";
    }
}
?>

<p/>

<center>
    <form action="search.php" method="get">
    Enter Search Keyword: <input type="text" name="keyword">
    Enter Highlight URL: <input type="text" name="url">
    <input type="Submit">
    </form>
</center>

<?php
    echo "<center><h3> Link to Actual Page </h3></center>\n";

    if (strpos($_GET["url"],"index")) {
        echo "<center><p><a href=\"index.php\">http://ashok-meyyappan.42web.io/index.php?highlight=search%20".$_GET["keyword"]."</a></p></center>";
    }
    else if (strpos($_GET["url"],"gallery")) {
        echo "<center><p><a href=\"gallery.php\">http://ashok-meyyappan.42web.io/gallery.php?highlight=search%20".$_GET["keyword"]."</a></p></center>";
    }
    else if (strpos($_GET["url"],"blog")) {
        echo "<center><p><a href=\"blog.php\">http://ashok-meyyappan.42web.io/blog.php?highlight=search%20".$_GET["keyword"]."</a></p></center>";
    }
    else if (strpos($_GET["url"],"tips")) {
        echo "<center><p><a href=\"tips.php\">http://ashok-meyyappan.42web.io/tips.php?highlight=search%20".$_GET["keyword"]."</a></p></center>";
    }
    else if (strpos($_GET["url"],"resources")) {
        echo "<center><p><a href=\"resources.php\">http://ashok-meyyappan.42web.io/resources.php?highlight=search%20".$_GET["keyword"]."</a></p></center>";
    }
    else if (strpos($_GET["url"],"search")) {
        echo "<center><p><a href=\"search.php\">http://ashok-meyyappan.42web.io/search.php?highlight=search%20".$_GET["keyword"]."</a></p></center>";
    }
    else if (strpos($_GET["url"],"ashok-meyyappan")) {
        echo "<center><p><a href=\"index.php\">http://ashok-meyyappan.42web.io/?highlight=search%20".$_GET["keyword"]."</a></p></center>";
    }
    else {
        echo "<center><p>Not one of the page links.</p></center>";
    }
    # Test function call
    echo "<center><h3>Highlighted Page Below</h3></center>\n";
    search($_GET["url"], $_GET["keyword"]);
?>

</body>
</html>