<!DOCTYPE html>
<html>
<body>
<?php

    include "arrays.php";
    include "construct.php";

    class Start_search extends Search {
        public function start() {
            
            $this->curl;
            parent::$data_array[] = array();

            curl_setopt($this->curl, CURLOPT_URL, $this->web_mods.$this->page);
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

            $output = curl_exec($this->curl);
            $doc = new DOMDocument();
            @$doc->loadHTML($output);
            $xpath = new DOMXpath($doc);

            // echo $output;

            foreach($this->xpath_query as $x => $pattern) {
            $html_data = $xpath->query($pattern);
                foreach($html_data as $data) {
                    // echo $data->nodeValue."<br>";
                    parent::$data_array[$this->pc][$x][] = preg_replace(
                        $this->str_mods[$x],
                        '', 
                        $data->nodeValue
                    );
                }
            }
            curl_close($this->curl);
        }
    }

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

    // print_r(Start_search::$data_array);
    // echo "<br><br><br>";

    include_once "StoreData.php";

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
    mysqli_close($dbcon);

    
?>
</body>
</html>