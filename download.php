<?php

function listarArchivos($var){
    $path = $var;
    $dir = opendir($path);
    while ($elemento = readdir($dir)){
        if( $elemento != "." && $elemento != ".."){
            // Si es una carpeta
            if( is_dir($path.$elemento) ){
                // Muestro la carpeta
                echo "<a href='$path$elemento'>$elemento</a><br>";
            // Si es un fichero
            } else {
                echo "<br />". $elemento;
            }
        }
    }
}

if (isset($_POST['btnAccion'])) {
    $db = Database::getInstance();
    $param = $_POST['btnAccion'];
    $db->query("SELECT * 
                FROM curso 
                LEFT JOIN curso_p ON curso.id_curso = curso_p.id_curso
                WHERE curso.id_curso = '$param'
                LIMIT 1");
    $resp = $db->fetch();

    $fileName = basename($resp['nombre']);
    $filePath = 'cursos/'.$fileName;
    if(!empty($fileName) && file_exists($filePath)){
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        
        readfile($filePath);
        exit;
    }
}