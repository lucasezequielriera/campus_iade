<?php 

$result = array();
$message = isset($_POST['message']) ? $_POST['message'] : null;
$from = isset($_POST['from']) ? $_POST['from'] : null;  //from seria id_persona
$course = isset($_POST['course']) ? $_POST['course'] : null;
/*
id
id_chat
id_persona
id_curso
mensaje
fecha
*/
 
if (!empty($message) && !empty($from)) {
    $sql = "INSERT INTO 'chat' ('mensaje','id_persona') 
            VALUES ('".$message."','".$from."')";
    $result['send_status'] = $db->query($sql); 
}

//Imprimir mensajes
$start = isset ($_GET['start']) ? intval($_GET['start']) : 0;
$db->query("SELECT * FROM 'chat' WHERE 'id' > " . $start);  //borre $items =
    /*while ($row = etch_assoc()){
        $result[] = $row;
    }*/
$result = $db->fetchAll();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

echo json_encode($result);
?> 


