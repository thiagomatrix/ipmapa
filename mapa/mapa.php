<?php
//require_once 'vendor/autoload.php';
use Database\Reader;

// This creates the Reader object, which should be reused across
// lookups.
$reader = new Reader('/GeoLite2-City.mmdb');


$ip = $_SERVER['REMOTE_ADDR'];

// Replace "city" with the appropriate method for your database, e.g.,
// "country".
$record = $reader->city($ip);

print($record->country->isoCode . "\n"); // 'US'
print($record->country->name . "\n"); // 'United States'
print($record->country->names['zh-CN'] . "\n"); // '美国'

print($record->mostSpecificSubdivision->name . "\n"); // 'Minnesota'
print($record->mostSpecificSubdivision->isoCode . "\n"); // 'MN'

print($record->city->name . "\n"); // 'Minneapolis'

print($record->postal->code . "\n"); // '55455'

print($record->location->latitude . "\n"); // 44.9733
print($record->location->longitude . "\n"); // -93.2323