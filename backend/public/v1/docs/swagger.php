<?php
header('Content-Type: application/json');
$openapi = require 'doc_setup.php';
echo json_encode($openapi, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
?>