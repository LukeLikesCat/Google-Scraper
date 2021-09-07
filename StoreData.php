<?php

    $svn = "localhost";
    $urn = "root";
    $dbname = "googleresults";

    $dbcon = mysqli_connect($svn, $urn, "", $dbname);

    if (!$dbcon) die("<br><br><samp>CONNECTION ERROR: ". mysqli_connect_error()."</samp><br>");
    else echo "<br><br><samp>CONNECTION SUCCESS</samp><br>";

    class input_data {
        public static $table_query;
        public static $insert_query;
        private $data_array;
        private $dbcon;
       
        public function __construct($data_array, $dbcon)
        {
            $this->data_array = $data_array;
            $this->dbcon = $dbcon;
        }

        public function Create_Table() {
            self::$table_query = "CREATE TABLE Data_table$_POST[site_params] (";
            self::$insert_query = "INSERT INTO Data_table$_POST[site_params] (";
            foreach($this->data_array as $data) {
                foreach($data as $key => $d) {
                    if(key(array_slice($data, -1, 1, true)) == $key) {
                        self::$table_query .= "$key varchar(225))";
                        self::$insert_query .= "$key) VALUES (";
                    }
                    else {
                        self::$table_query .= "$key varchar(225), ";
                        self::$insert_query .= "$key, ";
                    }
                    $values[] = $key;
                }
                if(mysqli_query($this->dbcon, self::$table_query)) echo mysqli_error($this->dbcon);
                echo self::$table_query."<br><br>";

                for($y = 0; $y < count($d); $y++) {
                    foreach($values as $z => $value) {
                        if($z == count($values) - 1) {
                            $keyword[] = "'".htmlspecialchars(ucwords($data[$value][$y]), ENT_QUOTES)."')";
                        } else {
                            $keyword[] = "'".htmlspecialchars(ucwords($data[$value][$y]), ENT_QUOTES)."', ";
                        } 
                    }
                    $insert = self::$insert_query.implode(" ", $keyword);
                    echo $insert."<br><br>";

                    if(mysqli_query($this->dbcon, $insert)) echo mysqli_error($this->dbcon);
                    unset($insert, $keyword);
                }
                break;
            }
        }

        public function Store_Data() {
           foreach($this->data_array as $x => $bruh) {
                foreach($bruh as $key => $b) {
                    for($y = 0; $y < count($b); $y++) {
                        self::$insert_query .= $bruh[0][$y].$bruh[1][$y].$bruh[2][$y].$bruh[3][$y]."<br><br>";
                    }
                    break;
               }
           }
        }
    }

    $yep = new input_data(Start_search::$data_array, $dbcon);
    $yep->Create_Table();
    // $yep->Store_Data();
?>