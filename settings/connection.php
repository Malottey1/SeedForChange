<?php
if (!defined('DBHOST')) define("DBHOST", "localhost");
if (!defined('DBNAME')) define("DBNAME", "seed_for_change");
if (!defined('DBUSER')) define("DBUSER", "root");
if (!defined('DBPASS')) define("DBPASS", "Naakey057@");

// Create connection
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

