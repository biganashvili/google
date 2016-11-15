# google
Cool Google Features for SEO

<?php
require '/../vendor/autoload.php';
use \Biganashvili\Google\GoogleSearch;
use \GuzzleHttp\Client;
$client=New Client();
$googleSearch=new GoogleSearch($client);
$bulck_array=array(
  'Tourneau',
  'Watches',
  'Watch Store',
  'Watche Store Online'
);
$results=array();
for($i=0; $i<count($bulck_array); $i++) {
  $results[$bulck_array[$i]]=$googleSearch->getSearchResultsCount($bulck_array[$i]);
}
arsort($results);
$counter=1;
echo "<table border='1' cellpadding='2' style='border-collapse: collapse;'>";
foreach ($results as $key => $value) {
  echo "<tr><td>".$counter++."</td><td>".$key."</td><td>".$value."</td></tr>";
}
echo "</table>";

?>
