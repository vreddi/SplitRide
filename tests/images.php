<?php 
require_once('simplehtmldom/simple_html_dom.php');
require_once('url_to_absolute.php');
$url = 'http://www.electrictoolbox.com/php-get-meta-tags-html-file/';
$html = file_get_html($url);
foreach($html->find('img') as $element) {
    echo url_to_absolute($url, $element->src), "\n";
}
?>