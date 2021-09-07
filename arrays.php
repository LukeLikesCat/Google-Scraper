<?php 

/*you can add whatever website you want here, the Post request is just for specifying the google search query.*/
$web_mod = array(
    "https://www.google.com/search?q=".$_POST["search"]."&tbm=vid",
    "https://www.google.com/search?q=".$_POST["search"]."&tbm=nws",
    "https://www.google.com/search?q=".$_POST["search"]."&tbm=shop"
);

/*searches the html for the nodes with the data I want.
The keys in the "str_mods" array and this array are labels
of the data that is being taken.*/
$xpath_query = array(
    array(
        'title' => '//h3[@class="zBAuLc"]//div[@class="BNeawe vvjwJb AP7Wnd"]',
        'link' => '//div[@class="ZINbbc xpd O9g5cc uUPGi"]/div[1]//@href'
    ),

    array(
        'title' => '//h3[@class="zBAuLc"]', 
        'link' => '//div[@class="ZINbbc xpd O9g5cc uUPGi"]/div[1]//@href',
        'company' => '//div[@class="BNeawe UPmit AP7Wnd"]',
        'snippet' => '//div[@class="BNeawe s3v9rd AP7Wnd"]/div'),

    array(
        'title' => '//div[@class="rgHvZc"]/a',
        'link' => '//div[@class="rgHvZc"]/a//@href',
        'price' => '//span[@class="HRLxBb"]',
        'company' => '//div[@class="dD8iuc"]'
    )
   
);

/*uses regular expresions to take off the extra stuff 
from the xpath string that I dont want.*/
$str_mods = array(
    array(
        'title' => '~~',
        'link' => '~(?:/url\?q=)|(?:(?:%|&s)[\s\S]*?)$~'
    ),

    array(
        'title' => '~~', 
        'link' => '~(?:/url\?q=)|(?:(?:%|&s)[\s\S]*?)$~',
        'company' => '~~',
        'snippet' => '~(?:\d[\s\S]*?ago\s·\s)~'
    ),

    array(
        'title' => '~~',
        'link' => '~(?:/url\?q=)|(?:(?:%|&s)[\s\S]*?)$~',
        'price' => '~~',
        'company' => '~(?:\$[\s\S]*?from\s)~'
    )

);

/*takes the number of pages that I want to take from and 
turns it into the url format*/
$pages = array("");

$pp = $_POST["page_num"] - 1;

for($x = 1; $x <= $pp; $x++) {
    $pages[] = "&start=".$x."0";
}

?>
