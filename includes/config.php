<?php
ob_start(); //Turn on output buffering
session_start();

date_default_timezone_set("America/Vancouver");

try {
  $con = new PDO("mysql:dbname=netflix-clone;host=localhost", "root", "");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
  exit("Connection failed: " . $e->getMessage());
}
