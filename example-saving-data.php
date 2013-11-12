<?php
/**
* In this example I will show you how to accept the data-example.xml file, and then use it to populate a lookup table
* This will assume that you've ran example-pump-data.php
*
**/
require_once('config.php');

$dsn = 'mysql:dbname='.MYSQL_DB.';host='.MYSQL_HOST;

$pdo =  new PDO($dsn,MYSQL_USER,MYSQL_PASS);

// start up our array
$data = getData('data-example.xml');

foreach($data as $sku => $entities) {
	$sql = "INSERT INTO eav_entities VALUES (null, 'car_{$sku}')";
	try {
		$res = $pdo->query($sql);
		$newEntityID = $pdo->lastInsertId();			
	} catch (Exception $e) {
		echo "Unable to insert into eav_entities, error: ".$e->getMessage();
		continue; // skipping this entity
	}
	$attributesToFind 	= array();
	$valuesToFind		= array();

	foreach($entities as $attributes)
	{
		// start inserting our values.
		$sql = "insert into cars (entity_id, attribute_id, value_id) 
				select 
					:entity_id as `entity_id`,
					`a`.`attribute_id` as `attribute_id`, 
					`v`.`value_id` as `value_id` 
				FROM 
					`eav_attributes` as `a`, 
					`eav_values` as `v` 
				WHERE 
					`a`.`attribute_name` = :attribute_name and `v`.`value_name` = :attribute_value";
		try {			
			$res = $pdo->prepare($sql);
			$params = array(
				'entity_id'			=>	$newEntityID,
				'attribute_name' 	=>	$attributes['attribute'],
				'attribute_value' 	=> 	$attributes['value']
				);
			$res->execute($params);
		} catch (Exception $e) {
			echo "Unable to insert car, error: ".$e->getMessage();
		}
	}
}

echo "Done.".PHP_EOL;

?>