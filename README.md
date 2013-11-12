php-eav-example
===============

This is quick example of how to use the EAV model with PHP and MySQL that I started to describe in my blog post http://www.iwilldomybest.com/2008/08/php-mysql-tip-3/

In our example we use the table 'cars' as a lookup table. You'd normally create these types of lookup tables for any type of bound data. For example in this case we could have a look up table for types of cars, or types of cars made before 1980, all while only having our unique data stored in one table. 

**Files**

example-pump-data.php
--------------
Run this file first if you want to use the example on your dev instance. It will dump some data into your tables to run the save and pulls. 

example-saving-data.php
--------------
With this script I show my example of how to import the example data provided. 

example-pulling-data.php
--------------
Just a single query as an example of how to do a big pull with a subquery. This isn't how you'd "normally" end up getting this info.
