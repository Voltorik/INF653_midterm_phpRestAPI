<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
} 

// Import database, instantiate, and connect
include_once('../../config/Database.php');
$database = new Database();
$db = $database->connect();

include_once('../../models/Quote.php');
include_once('../../models/Author.php');
include_once('../../models/Category.php');

if ($method === 'POST') {
  require_once('create.php');
} else if ($method === 'GET' && isset($_GET['id'])) {
  require_once('read_single.php');
}
