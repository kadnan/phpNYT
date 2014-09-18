<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

/**
 * Example of Class Implementation
 * @author Adnan Siddiqi<kadnan(at)gmail(dot)com>[http://adnansiddiqi.me]
 */
include_once 'Article.php';
use phpNYT\Article;
$k = "xxxxxxx:xxxxxxxx";
$articles = new Article($k);
$articles->sort = "newest";
$articles->keyword = "ISIS";
$articles->start_date = "20140101";
$articles->end_date = "20141201";
$articles->page = 1;
print_r($articles->find());
?>
