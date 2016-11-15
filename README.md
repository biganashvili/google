# google
Cool Google Features for SEO
## Require this package with Composer
Install this package through [Composer](https://getcomposer.org/).
Edit your project's `composer.json` file to require
`biganashvili/google`.

Create *composer.json* file:
```js
{
    "name": "yourproject/yourproject",
    "type": "project",
    "require": {
        "biganashvili/google": "~1.1.0"
    }
}
```
And run composer update

**Or** run a command in your command line:

```
composer require biganashvili/google
```
# Usage
```php
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
```
## License

Please see the [LICENSE](LICENSE.md) included in this repository for a full copy of the MIT license,
which this project is licensed under.

## Credits

- [Sergi Biganashvili](https://github.com/biganashvili)
