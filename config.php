<?php

define('MYSQL_USER','root');
define('MYSQL_PASS','');
define('MYSQL_HOST','localhost');
define('MYSQL_DB','eav');

function getData($path) {
	$output = array();

	if(file_exists($path)) 
	{
		$entities = simplexml_load_file($path);

		foreach($entities->entity as $entity) 
		{
			if((string)$entity['category'] == 'car') 
			{
				$carData = array();
				foreach($entity->attribute as $attribute) 
				{
					$rowData = array();
					$rowData['attribute'] = (string)$attribute['name'];
					$rowData['value'] 	  = (string)$attribute['value'];
					$carData[] = $rowData;
				}
				$output[(string)$entity['sku']] = $carData;
			}
		}
	} 
	else 
	{
		error_log('Unable to load '.$path);		
	}

	return $output;
}