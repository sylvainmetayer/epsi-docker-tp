<?php
$config['db_host'] = 'db';
$config['db_user'] = 'root';
$config['db_password'] = 'root';
$config['db_db'] = 'cp';
$lien = mysqli_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_db']) or die('Erreur de connexion à la BDD');
 ?>
