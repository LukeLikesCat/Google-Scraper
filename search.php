<!DOCTYPE html>
<html>
<body>
<?php

    include "arrays.php"; 
    include "construct.php";

    class Start_search extends Search {
        public function start() {
            
            $this->curl; //initializes the curl session
            parent::$data_array[] = array(); //uses the static array from parent class

            //sets options for the curl session
            curl_setopt($this->curl, CURLOPT_URL, $this->web_mods.$this->page); //states the url
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false); //can connect to https
            curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true); //returns the output as a string

            $output = curl_exec($this->curl); //executes the curl session
            $doc = new DOMDocument();
            @$doc->loadHTML($output);
            $xpath = new DOMXpath($doc);
            
            /*Takes the xpath querys from the "arrays.php" file
            and searches the html for the nodes, after that
            each node value is inserted into a static array*/
            foreach($this->xpath_query as $x => $pattern) {
            $html_data = $xpath->query($pattern);
                foreach($html_data as $data) {
                    parent::$data_array[$this->pc][$x][] = preg_replace(
                        $this->str_mods[$x],
                        '', 
                        $data->nodeValue
                    );
                }
            }
            curl_close($this->curl); //closes the curl session
        }
    }
    
    /*calls the class  "Start_search" and fills in the variables that are 
    constructed in the parent class "Search" on the file "construct.php"*/
    foreach($pages as $x => $page) {
        $start_search = new Start_search(
            $web_mod[$_POST["site_params"]], 
            $xpath_query[$_POST["site_params"]], 
            curl_init(), 
            $str_mods[$_POST["site_params"]], 
            $page,
            $x
        );
        $start_search->start();
    }

    //use: print_r(Start_search::$data_array); if you want to see the data before it is stored
 
    //this file is for storing the data in a database
    include_once "StoreData.php";

    /*this echos out a table with the values in the database, currently 
    this table only works for the news search, but I will make this 
    procces dynamic for whichever search option you pick*/
    $db_info = mysqli_query($dbcon, "SELECT * FROM Data_Table1");

    echo "<table border='1'>
    <tr class='head'>
        <th>Title</th>
        <th>Link</th>
        <th>Company</th>
        <th>Snippet</th>
    </tr>";

    while($row = mysqli_fetch_array($db_info)) {
        echo "<tr>";
        echo "<td>".$row['title']."</td>";
        echo "<td>".$row['link']."</td>";
        echo "<td>".$row['company']."</td>";
        echo "<td>".$row['snippet']."</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
    //close off connection to the database.
    mysqli_close($dbcon); 

    
?>
</body>
</html>
