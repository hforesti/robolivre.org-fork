<?php
// auto-generated by sfDatabaseConfigHandler
// date: 2012/02/10 16:47:55

return array(
'doctrine' => new sfDoctrineDatabase(array (
  'dsn' => 'mysql:host=localhost;dbname=robolivre',
  'username' => 'root',
  'password' => 'macaco',
  'name' => 'doctrine',
)),

'sess_db' => new sfPDODatabase(array (
  'dsn' => 'mysql:host=localhost;dbname=robolivre',
  'username' => 'root',
  'password' => 'macaco',
  'name' => 'sess_db',
)),);
