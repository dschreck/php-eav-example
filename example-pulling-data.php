<?php
/**
* In this example I will show you how to pull out a car by name and all of its descriptive data we have on it.
* This will assume that you've ran example-saving-data.php
*
**/

require_once('config.php');

$dsn = 'mysql:dbname='.MYSQL_DB.';host='.MYSQL_HOST;

$pdo =  new PDO($dsn,MYSQL_USER,MYSQL_PASS);


/** 
* Pulling data, this is done bluntly. 
* Normally on your app you'll do smaller queries, like: "get all IDs from car that have the attribute id 5 and value 3"
* This is just done for example purposes.
*/
$searching_for_sku = 'car_XFV002'; // we have a sku of an entity we want to find.

$sql = "
SELECT 
`a`.`attribute_name` as `attribute_name`, 
`v`.`value_name` as `value_name` 
FROM 
`cars` as `car`
JOIN 
	`eav_attributes` as `a` ON (`car`.`attribute_id` = `a`.`attribute_id`)
JOIN `eav_values` as `v` ON (`car`.`value_id` = `v`.`value_id`)
WHERE
	`car`.`entity_id` = (select `e`.`entity_id` from `eav_entities` as `e` where `e`.`entity_name` = :searching_for_sku)";

try {			
	$res = $pdo->prepare($sql);
	$params = array('searching_for_sku'	=> $searching_for_sku);
	$res->execute($params);
	$rows = $res->fetchAll(PDO::FETCH_ASSOC);
	print_r($rows);
} catch (Exception $e) {
	echo "Unable to find car by sku, error: ".$e->getMessage();
}
