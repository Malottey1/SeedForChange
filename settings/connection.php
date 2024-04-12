<?php
if (!defined('DBHOST')) define("DBHOST", "localhost");
if (!defined('DBNAME')) define("DBNAME", "u505497111_ seedforchange");
if (!defined('DBUSER')) define("DBUSER", "u505497111_malcolm1");
if (!defined('DBPASS')) define("DBPASS", "Naakey057@");

// Create connection
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

