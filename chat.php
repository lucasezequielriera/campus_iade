<?php 
require "globals/database.php";
$db = Database::getInstance();

//Imprimir mensajes
$course = isset($_GET['course']) ? intval($_GET['course']) : 0 ;
$from = isset($_GET['from']) ? intval($_GET['from']) : 0;
$start = isset ($_GET['start']) ? intval($_GET['start']) : 0;

//Traigo los datos del chat, curso y persona.
$db->query("SELECT c.id, c.fecha, c.mensaje, p.nombre
            FROM chat c
            LEFT JOIN personas p
            ON c.id_persona = p.id
            where c.id>$start AND c.id_chat = $from AND c.id_curso = $course");
            
$result = $db->fetchAll();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

echo json_encode($result);
?> 


