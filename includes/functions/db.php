<?php

// credenciales de la base de datos
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');
define('DB_NAME', 'addressbook');
define('DB_PORT', '3307');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT );

// echo $conn->ping();
