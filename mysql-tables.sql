-- entites table
create table `eav_entities` (
	`entity_id` int(11) UNSIGNED NOT NULL auto_increment,
	`entity_name` varchar(50) default NULL,
	PRIMARY KEY (`entity_id`),
	UNIQUE KEY `entity_name` (`entity_name`)
);

-- attributes table
create table `eav_attributes` (
	`attribute_id` int(11) unsigned not null auto_increment,
	`attribute_name` varchar(50) not null,
	primary key (`attribute_id`),
	UNIQUE KEY `attribute_name` (`attribute_name`)
);

-- values table
create table `eav_values` (
	`value_id` int(11) unsigned not null auto_increment,
	`value_name` varchar(50) not null,
	primary key (`value_id`),
	UNIQUE KEY `value_name` (`value_name`)
);

-- lookup table
create table `cars` (
	`entity_id` int(11) unsigned not null,
	`attribute_id` int(11) unsigned not null,
	`value_id` int(11) unsigned not null,
	unique key `entity_attribute_value` (`entity_id`,`attribute_id`, `value_id`)
);

