<?php 
require "globals/database.php";
$db = Database::getInstance();
/*

$message = isset($_POST['message']) ? $_POST['message'] : null;
$from = isset($_POST['from']) ? $_POST['from'] : null;  //from seria id_persona
$course = isset($_POST['course']) ? $_POST['course'] : null;

id
id_chat
id_persona
id_curso
mensaje
fecha

 
if (!empty($message) && !empty($from)) {
    $sql = "INSERT INTO 'chat' ('mensaje','id_persona') 
            VALUES ('".$message."','".$from."')";
    $result['send_status'] = $db->query($sql); 
}

*/

//Imprimir mensajes
$course = isset($_GET['course']) ? intval($_GET['course']) : 0 ;
$from = isset($_GET['from']) ? intval($_GET['from']) : 0;
$start = isset ($_GET['start']) ? intval($_GET['start']) : 0;

$db->query("SELECT * FROM chat WHERE id>$start AND id_curso=$course AND id_chat=$from");
$result = $db->fetchAll();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

echo json_encode($result);
?> 


