<?php
// Set up headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
} 

// Include dependency files
include_once('../../config/Database.php');
include_once ('../../models/Author.php');

// Import database, instantiate, and connect
$database = new Database();
$db = $database->connect();

// Flow control for CRUD operations
if ($method === 'GET' && isset($_GET['id'])) {
  require_once('read_single.php');
} else if ($method === 'GET') {
  require_once('read.php');
} else if ($method === 'POST') {
  require_once('create.php');
} else if ($method === 'DELETE') {
  require_once('delete.php');
} else if ($method === 'PUT') {
  require_once('update.php');
}
