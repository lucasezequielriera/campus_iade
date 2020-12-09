<?php
if (isset($_POST['course_folder'])) {
    $dir = $_POST['course_folder'];
    $zip_file = $_POST['course_name'] . ' ' . $_POST['module_number'] . '.rar' ;

    $rootPath = realpath($dir);

    $zip = new ZipArchive();
    $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    /** @var SplFileInfo[] $files */
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootPath),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
         //aca poner el skip si el archivo es "videos.txt"


         
        if (!$file->isDir()) {
            if ($file !== "videos.txt") {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
    }
    $zip->close();

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($zip_file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($zip_file));
    readfile($zip_file);
}
?>