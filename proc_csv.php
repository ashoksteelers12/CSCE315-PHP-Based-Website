
<?php
function proc_csv ($filename, $delimiter, $quote, $columns_to_show) {
    
    // Separating for desired columns
    $columns = explode(":",$columns_to_show); 

    // Open file
    $file = fopen($filename,"r") or die("Cannot open test.csv"); 

    // Start table
    echo "<table  border=\"1\">\n";
    $count = 1; //helper variable to make top row header

    // Line by line through file
    while ($data = fgets($file)) {

        // Start row
        echo "<tr>\n";
        // Split by delimeter and ignore delimeter in quotes
        $data_cols = preg_split("/(".$quote.$delimiter.$quote.")|(".$quote.$delimiter.")|(".$delimiter.$quote.")/",$data);

        for ($k=0; $k<count($data_cols); ++$k) {
            
            // Getting rid of left-over quotes
            $item = "";
            if (preg_match_all("/".$quote."(.+)/",$data_cols[$k])) {
                $pattern = "/".$quote."(.+)/";
                $replace = "$1";
                $item = preg_replace($pattern,$replace,$data_cols[$k]);
            }
            elseif (preg_match_all("/(.+)".$quote."/",$data_cols[$k])) {
                $pattern = "/(.+)".$quote."/";
                $replace = "$1";
                $item = preg_replace($pattern,$replace,$data_cols[$k]);
            }
            else {
                $item = $data_cols[$k];
            }
            
            // Inserting values into table from csv
            // Output if want all columns
            if (in_array("ALL", $columns)) {
                // Checking if header row
                if ($count == 1) {
                    echo "  <th> ".$item." </th>\n";
                }
                else {
                    echo "  <td> ".$item." </td>\n";    
                }
            }
            // Output only desired columns
            else {
                if (in_array($k+1,$columns)){
                    // Checking if header row
                    if ($count == 1) {
                        echo "  <th> ".$item." </th>\n";
                    }
                    else {
                        echo "  <td> ".$item." </td>\n";
                    }
                }
            }
        }
        // End row
        echo "</tr>\n"; 
        $count++;
    }

    // Close file
    fclose($file);
    // End table
    echo "</table>\n<p/>";
}?>
