<?php
require_once('config.php');

$dsn = 'mysql:dbname='.MYSQL_DB.';host='.MYSQL_HOST;

$pdo =  new PDO($dsn,MYSQL_USER,MYSQL_PASS);

// start up our array
$data = getData('data-example.xml');

/**
* Here is how I populated my Database with our example data. 
* In most 'real world' scenarios your database would already have this info and we would just need to properly insert our lookup table info.
* This is not the case in this example.
* 
* This is for informational purposes only, you can safely disregard this if you're not interested.
**/

foreach($data as $entities) {
	foreach($entities as $attributes)
	{
		// this is now our insert into the attributes...
		$sql = "INSERT INTO eav_attributes VALUES (NULL, '{$attributes['attribute']}') ON DUPLICATE KEY UPDATE `attribute_name`='{$attributes['attribute']}'";

		try {
			$res = $pdo->query($sql);
		} catch (Exception $e) {
			echo "Unable to insert entitry, error: ".$e->getMessage();
			continue; // skipping this entity
		}

		$sql = "INSERT INTO `eav_values` VALUES (null, '{$attributes['value']}')  ON DUPLICATE KEY UPDATE `value_name`='{$attributes['value']}'";
		try {
			$res = $pdo->query($sql);
		} catch (Exception $e) {
			echo "Unable to insert entitry, error: ".$e->getMessage();
			continue; // skipping this entity
		}		
	}
}
echo "Done.".PHP_EOL;
?>