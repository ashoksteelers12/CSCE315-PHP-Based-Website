<?php

// Sort by newest date
function date_newest($date1, $date2) { 
    // Set temp values
    $temp1 = $date1['date']; 
    $temp2 = $date2['date']; 
    return $temp1 < $temp2; 
} 
// Sort by oldest date
function date_oldest($date1, $date2) { 
    // Set temp values
    $temp1 = $date1['date']; 
    $temp2 = $date2['date']; 
    return $temp2 < $temp1;
} 
// Sort by largest
function size_largest($size1, $size2) { 
    // Set temp values
    $temp1 = $size1['size']; 
    $temp2 = $size2['size']; 
    return $temp1 < $temp2; 
} 
// Sort by smallest
function size_smallest($size1, $size2) { 
    // Set temp values
    $temp1 = $size1['size']; 
    $temp2 = $size2['size']; 
    return $temp2 < $temp1; 
}

// Primary function
function proc_gallery($image_list_filename, $mode, $sort_mode) {
    
    // Open file
    $file = fopen($image_list_filename,"r") or die("Cannot open test.csv"); 
    
    // Create empty array for images
    $image_values = array();

    // Initialize the needed values
    $filesize = 0; //Size of file
    $filetime = 0; //Modified date of file
    $filename = 0; //Name of file
    $filetext = 0; //Description for file
    
    // Run through the csv
    while ($data = fgets($file)) {
        
        // Split csv with regex
        $data_vals = preg_split("/('.')|(',)|(,')/",$data);

        // Create empty temporary array
        $temp_arr = array();
        
        // Go through each line of values
        for ($k=0; $k<count($data_vals); ++$k) {
            
            // Initialize variable for each value
            $item = "";

            // Check if quote on left
            if (preg_match_all("/'(.+)/",$data_vals[$k])) {
                $pattern = "/'(.+)/";
                $replace = "$1";
                $item = preg_replace($pattern,$replace,$data_vals[$k]); //Take quote out
            }
            // Check if quote on right
            elseif (preg_match_all("/(.+)\"/",$data_vals[$k])) {
                $pattern = "/(.+)'/";
                $replace = "$1";
                $item = preg_replace($pattern,$replace,$data_vals[$k]); //Take quote out
            }
            // If no quote exists
            else {
                $item = $data_vals[$k];
            }

            // Set the file values to variable
            if ($k == 0) {
                $filesize = filesize($item);
                $filetime = filemtime($item);
                $filename = $item;
            }
            // Set the file's description to its variable
            else {
                $filetext = $item;
            }
            
            // Add the values to temporary array
            $temp_arr = array("name"=>$filename, "text"=>$filetext, "date"=>$filetime, "size"=>$filesize);
            
        }

        // Add temporary array to the main images array
        array_push($image_values, $temp_arr);
        
    }

    // Close file
    fclose($file);

    // Initialize sorting variable to help with labeling each sort
    $sort_text = " ";
    // Check the different sort modes
    if ($sort_mode == "date_newest") {
        $sort_text = "Newest"; //Set label
        usort($image_values, 'date_newest'); //Preform sort
    }
    elseif ($sort_mode == "date_oldest") {
        $sort_text = "Oldest"; //Set label
        usort($image_values, 'date_oldest'); //Preform sort
    }
    elseif ($sort_mode == "size_largest") {
        $sort_text = "Largest"; //Set label
        usort($image_values, 'size_largest'); //Preform sort
    }
    elseif ($sort_mode == "size_smallest") {
        $sort_text = "Smallest"; //Set label
        usort($image_values, 'size_smallest'); //Preform sort
    }
    elseif ($sort_mode == "rand") {
        $sort_text = "Random"; //Set label
        shuffle($image_values); //Preform random sort
    }
    // Nothing matches means keep original order
    else {
        $sort_text = "Original"; //Set label
    }

    // Check the different output modes
    if ($mode == "list") {
        // Center the output
        echo "<center>";
        // echo "<h2>" . $sort_text . "</h2><hr>"; //Label the sorting used
        // Loop through the images
        for ($k=0; $k<count($image_values); ++$k) {
            // Output the image with description under 
            echo "<img src=\"" . $image_values[$k]['name'] . "\" alt=\"Image\">";
            echo "<p>" . $image_values[$k]['text'] . "</p><p></p>";
        }
        echo "</center>";
    }
    elseif ($mode == "matrix") {
        // Center the output
        echo "<center>";
        // echo "<h2>" . $sort_text . "</h2><hr>"; //Label the sorting used
        // Loop through the images
        for ($k=0; $k<count($image_values); ++$k) {
            // Check if its start of row
            if ($k%3 == 0) {
                echo "<div class=\"row\">"; //Start main div tag
            }
            echo "<div class=\"column\">"; //Start interior div tag
            // Output the image with description under
            echo "<img src=\"" . $image_values[$k]['name'] . "\" alt=\"Image\">";
            echo "<p>" . $image_values[$k]['text'] . "</p><p></p>";
            echo "</div>"; //Close the interior div tag
            // Check if end of row
            if (($k-2)%3 == 0) {
                echo "</div>"; //Close the main div tag
            }
        }
        echo "</center><p></p>";
    }
    elseif ($mode == "details") {
        // Center the output
        echo "<center>";
        // echo "<h2>" . $sort_text . "</h2><hr>"; //Label the sorting used
        // Loop through the images
        for ($k=0; $k<count($image_values); ++$k) {
            echo "<div class=\"descr\">"; //Start main div tag
            // Add the interior div tags
            echo "<div class=\"descc\">" . $image_values[$k]['name'] . "</div>"; //Output the file name
            echo "<div class=\"descc\">" . $image_values[$k]['text'] . "</div>"; //Output the image description
            echo "<div class=\"descc\">" . date("d M Y H:i:s", $image_values[$k]['date']) . "</div>"; //Output the modified date
            echo "<div class=\"descc\">" . $image_values[$k]['size'] . "</div>"; //Output the file size
            echo "</div>"; //End main div tag
            // Previous code with spacing not incorporated
            /*echo $image_values[$k]['name'] . " " . $image_values[$k]['text'] . " " . date("d M Y H:i:s", $image_values[$k]['date']) . " " .
            $image_values[$k]['size'] . "<p></p>";*/
        }
        echo "</center>";
    }
    else {
        // Output statement if mode not found
        echo "No matching mode!";
    }

    echo "<br><br>"; //Add spacing between sections
  
}
?>