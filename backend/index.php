<?php 
require 'vendor/autoload.php'; 
Flight::route('/', function(){ 
echo "Hello, FlightPHP!"; 
}); 
Flight::start(); 
?>
