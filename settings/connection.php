<?php
define("DBHOST", "localhost");
define("DBNAME", "seed_for_change");
define("DBUSER", "root");
define("DBPASS", "Naakey057@");

// Create connection
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

