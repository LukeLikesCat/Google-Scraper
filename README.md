# Google-Scraper

This app will take data from a website and store it in a database using php curl to connect to a website and XPath querys to take the data from the website's html.


The program is easy to modify by altering the "arrays.php" file.

```
<?php

$web_mod = array(
  ""             //insert website
);

$xpath_query = array(
  array(
    "" => ""    //insert XPath query's
    )
);

$str_mods = array(
  array(
    "" => ""    //regex for replaceing some nonsense from what XPath returns 
  )
);


?>
```
#

Inserting values example:
```
<?php

$web_mod = array(
  "https://example.com"  //website to get data from
);

$xpath_query = array(
  array(
    "links" => "//div//a/@href", //get all href values from links inside div containers
    "titles" => "//h2[id="title"]" //get the text from all h2 nodes with the id "title"
    )
);

$str_mods = array(
  array(
    "links" => '~http://~',   //take off "http://" from each string
    "titles" => '~~'   //take off nothing from the titles
  )
);

?>
```
