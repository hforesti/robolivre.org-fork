<?php
// auto-generated by sfDatabaseConfigHandler
// date: 2012/04/19 17:54:21

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
