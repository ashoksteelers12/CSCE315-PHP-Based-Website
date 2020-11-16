<?php
function proc_wikitext ($filename) {
    
    // Open file requested 
    $filename = fopen($filename, "r") or die("Cannot open");

    // Helper variables for ordered list
    $count1 = $count2 = $count3 = $count4 = $count5 = $count6 = $count7 = 1;

    // Line by line through file
    while($data = fgets($filename)) {
        
        // Bold and Italics - Finished
        $line = $data;
        // Bold and italics
        if (preg_match_all("/\'\'\'\'\'(.+)\'\'\'\'\'/m",$data) == 1) {
            $both_pattern = "/\'\'\'\'\'(.+)\'\'\'\'\'/m";
            $both_replace = "<b><i>$1</i></b>";
            $line = preg_replace($both_pattern,$both_replace,$data);
        }
        // Bold
        if (preg_match_all("/\'\'\'(.+)\'\'\'/m",$data) == 1) {
            // Check if it hasn't been changed into one of the other 2
            if ($line == $data) {
                $bold_pattern = "/\'\'\'(.+)\'\'\'/m";
                $bold_replace = "<b>$1</b>";
                $line = preg_replace($bold_pattern,$bold_replace,$data);    
            }
        }
        // Italics
        if (preg_match_all("/\'\'(.+)\'\'/m",$data) == 1) {
            // Check if it hasn't been changed into one of the other 2
            if ($line == $data) {
                $ital_pattern = "/\'\'(.+)\'\'/m";
                $ital_replace = "<i>$1</i>";
                $line = preg_replace($ital_pattern,$ital_replace,$data);    
            }
        }

        // Coloring Text - Finished
        $color_text = ""; //Temporary variable
        if (preg_match_all("/.*{{color\|(.*)\|(.*)}}.*/",$line)) {
            $color_text = $line; 
            $color_pattern = "/{{color\|(.*)\|(.*)}}/";
            $color_replace = "<span style=\"color:$1;\">$2</span>";
            $line = preg_replace($color_pattern,$color_replace,$color_text);
        }

        // Highlighting Text - Finished
        $hl_text = ""; //Temporary Variable
        if (preg_match_all("/.*{{Font color\|\|(.*)\|(.*)}}.*/",$line)) {
            $hl_text = $line; 
            $hl_pattern = "/{{Font color\|\|(.*)\|(.*)}}/";
            $hl_replace = "<span style=\"background-color:$1\">$2</span>";
            $line = preg_replace($hl_pattern,$hl_replace,$hl_text);
        }
        
        // Links - Finished
        $link_line = ""; //Temporary variable
        if (preg_match_all("/http:\/\/www\.(.*)/",$line)) {
            $link_line = $line;
            // Named links
            if (preg_match_all("/\[http:\/\/www\.(.*)\ (.*)\]/",$line)) {
                $link_pattern = "/\[http:\/\/www\.(.*)\ (.*)\]/";
                $link_replace = "<a href=\"http://www.$1\">$2</a>";  
                $line = preg_replace($link_pattern,$link_replace,$link_line);
            }
            // Bare url
            else {
                $link_pattern1 = "/http:\/\/www\.(.*)/";
                $link_replace1 = "<a href=\"http://www.$1\">http://www.$1</a>";   
                $line = preg_replace($link_pattern1,$link_replace1,$link_line);
            }
        }
        
        // Images - Finished
        $img_line = ""; //Temporary variable
        if (preg_match_all("/\[{2}File:(.*)\]{2}/",$line)) {
            $img_line = $line;
            // Single picture
            if (preg_match_all("/.*\[{2}File:.*\..*\|?px=.*\]{2}.*/",$line)) {
                $img_pattern = "/\[{2}File:(.*)\|px=(.*)\]{2}/";
                $img_replace = "<img src=\"$1\" alt=\"Image\" style=\"width:$2px;height:$2px;\">";
                $line = preg_replace($img_pattern,$img_replace,$img_line);
            }
            // Single picture with size
            else {
                $img_pattern = "/\[{2}File:(.*)\]{2}/";
                $img_replace = "<img src=\"$1\" alt=\"Image\">";
                $line = preg_replace($img_pattern,$img_replace,$img_line);
            }
        }
        
        // Heading - Finished
        if (preg_match_all("/^=.+=/",$line) == 1) {
            $header_val = preg_match_all("/=/",$line) / 2; //Finding the header #
            $header_content = preg_split("/={".$header_val."}/",$line); //Splitting out the '='
            echo "<h".$header_val.">" . $header_content[1] . "</h".$header_val.">\n";
            // Adding horizontal rule for 1st 2 headers
            if ($header_val == 1 or $header_val == 2) {
                echo "<hr>";
            }
        }
        
        // Horizontal Rule - Finished
        elseif (preg_match_all("/----/",$line) == 1) {
            // Checking if correct format
            if (preg_match_all("/^(----)/",$line) == 1) {
                $hr_content = preg_split("/----/",$line);
                echo "<hr>";
                echo $hr_content[1] . "\n"; //Add text after the line if any
            }
            // Not correct format doesn't add the horizontal rule
            else {
                echo $line;
            }
        }
        
        // Line Breaks (and Paragraphs) - Finished
        // Checking empty line
        elseif (trim($line) == '') {
            echo "<p></p>"; //Adding break (<br> too big of break)
        }
        
        // Indent Text - Finished
        elseif (preg_match_all("/^(:+)/",$line) == 1) {
            $indents = preg_split("/:/",$line); //Separating line by indent symbol
            $num_indents = count($indents) - 1; //Counting # of indents
            echo "<p></p><div style=\"text-indent: ". $num_indents ."em;\">";
            echo $indents[$num_indents] . "</div><p></p>"; //Output text after indents
        } 
        
        // Blockquote - Finished
        // Check for quote start
        elseif (preg_match_all("/^{{2}\ *Quote/",$line)) {
            echo "<p></p>"; //Add space for following text
        }
        // Check for the text value 
        elseif (preg_match_all("/\|\ *text\ *=\ *(.*)/",$line)) {
            $text = $line; //Temporary value
            $line = preg_replace("/\|\ *text\ *=\ *(.*)/","<p></p><div style=\"text-indent: 3em;\">$1</div>",$text);
            echo $line;
        }
        // Check for the author value
        elseif (preg_match_all("/\|\ *author\ *=\ *(.*)/",$line)) {
            $author = $line; //Temporary value
            $line = preg_replace("/\|\ *author\ *=\ *(.*)/","<p></p><div style=\"text-indent: 4em;\">-$1</div>",$author);
            echo $line;
        }
        // Find end of blockquote
        elseif (preg_match_all("/}{2}?/",$line)) {
            echo "<p></p>"; //Add space after blockquote finishes
        }
        
        // Unordered Lists - Finished
        elseif (preg_match_all("/^(\*+)/",$line) == 1) {
            $ul = preg_split("/\*/",$line); //Splitting line
            $num_ul = count($ul) - 1; //Finding 'level' of unordered line
            // Check if a beginning element
            if ($num_ul == 1) {
                echo "<ul><li>" . $ul[$num_ul] . "</li></ul>\n"; 
            }
            // Later elements
            else {
                echo "<div style=\"text-indent: ". $num_ul ."em;\"><ul>\n"; //Indent based on level
                echo "<li>" . $ul[$num_ul] . "</li></div></ul>\n";    
            }
        }
        
        // Ordered Lists - Finished
        elseif(preg_match_all("/^(#+)/",$line) == 1) {
            $olist = $line; //Temporary variable
            // Check if a level 7
            if (preg_match_all("/#{7}\ *(.*)/",$line)) {
                $line = preg_replace("/#{7}\ *(.*)/","<p></p><div style=\"text-indent: 7em;\">".$count7.".$1</div>",$olist);
                echo $line;
                $count7++; //Add to level 7 counter
            }
            // Check if a level 6
            elseif (preg_match_all("/#{6}\ *(.*)/",$line)) {
                $line = preg_replace("/#{6}\ *(.*)/","<p></p><div style=\"text-indent: 6em;\">".$count6.".$1</div>",$olist);
                echo $line;
                $count6++; //Add to level 6 counter
            }
            // Check if a level 5
            elseif (preg_match_all("/#{5}\ *(.*)/",$line)) {
                $line = preg_replace("/#{5}\ *(.*)/","<p></p><div style=\"text-indent: 5em;\">".$count5.".$1</div>",$olist);
                echo $line;
                $count5++; //Add to level 5 counter
            }
            // Check if a level 4
            elseif (preg_match_all("/#{4}\ *(.*)/",$line)) {
                $line = preg_replace("/#{4}\ *(.*)/","<p></p><div style=\"text-indent: 4em;\">".$count4.".$1</div>",$olist);
                echo $line;
                $count4++; //Add to level 4 counter
            }
            // Check if a level 3
            elseif(preg_match_all("/#{3}\ *(.*)/",$line)) {
                $line = preg_replace("/#{3}\ *(.*)/","<p></p><div style=\"text-indent: 3em;\">".$count3.".$1</div>",$olist);
                echo $line;
                $count3++; //Add to level 3 counter
            }
            // Check if a level 2
            elseif(preg_match_all("/#{2}\ *(.*)/",$line)) {
                $line = preg_replace("/#{2}\ *(.*)/","<p></p><div style=\"text-indent: 2em;\">".$count2.".$1</div>",$olist);
                echo $line;
                $count2++; //Add to level 2 counter
            }
            // Check if a level 1
            elseif(preg_match_all("/#{1}\ *(.*)/",$line)) {               
                $line = preg_replace("/#{1}\ *(.*)/","<p></p><div style=\"text-indent: 1em;\">".$count1.".$1</div>",$olist);
                echo $line;
                $count1++; //Add to level 1 counter
            }
            // Output normal text if not one of the levels
            else {
                echo $line;
            }
        }
        
        // Description Lists - Finished
        // Check if a one line term definition
        elseif(preg_match_all("/^;\ *(.*)\ */",$line)) {
            $des = $line; //Temporary variable
            // Check if there is a term with a definition
            if (preg_match_all("/;\ *(.*)\ *:\ *(.*)/",$des)) {
                $line = preg_replace("/;\ *(.*)\ *:\ *(.*)/","<b>$1</b><p></p><div style=\"text-indent: 1em;\">$2</div>",$des);
                echo $line;
            }
            // Term without definition
            else {
                $line = preg_replace("/;\ *(.*)\ */","<b>$1</b>",$des);
                echo $line;
            }
        }
        // Check if a multiple line term definition
        elseif(preg_match_all("/^:/",$line)) {
            $def = $line; //Temporary variable
            $line = preg_replace("/:\ *(.*)/","<p></p><div style=\"text-indent: 1em;\">$1</div>",$def);
            echo $line;
        } 
        
        // Other
        // Output text if none if statements met
        // This also outputs the bold, italics, etc. which didn't echo before
        else {
            echo $line . "\n";
        }
        
    }
    // Close file
    fclose($filename);
    
}
?>