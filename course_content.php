<?php
include "./templates/header.php";
if ($_SESSION['user']['acceso'] !== 0) exit;
?>
<div class="card-body">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">Videos</h4>
        </div>
        <div class="panel-body">
            <table class="table">
                <tbody>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col col-lg-5 mt-2">
                                <div class="card" style="width: 18rem;">
                                    <ul class="list-group list-group-flush">
                                        <?php
                                        $str = ltrim($_POST['module'], ':');
                                        $handle = fopen($str . "/videos.txt", "r");
                                        if ($handle) {
                                            while (($line = fgets($handle)) !== false) {
                                                $str = str_replace("\r\n", "", $line);
                                                $line = fgets($handle);
                                                $tema = str_replace("\r\n", "", $line); //si hay una linea mas, es el tema del video.
                                        ?>
                                                <li class="list-group-item">
                                                    <span><?= $tema; ?></span>
                                                    <button class="btn btn-info ml-2" onclick="setURLframe('<?= $str ?>')">Ver video</button>
                                                </li>
                                        <?php }
                                            fclose($handle);
                                        } else {
                                            echo "error al cargar el archivo de videos (videos.txt)";
                                        } ?>
                                        <li class="list-group-item">
                                            <form action="./curso.php" method="POST">
                                                <input type="hidden" value="<?= $_POST['curso']; ?>" name="curso">
                                                <button type="submit" class="btn btn-success btn-block">Volver</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col col-lg-6">
                                <iframe id="frame" src="" style="width:100%;height:500px;"></iframe>
                            </div>
                        </div>
                    </div>
                </tbody>
            </table>
        </div>
    </div>


    <script>
        function setURLframe(url) {
            document.getElementById('frame').src = url;
        }
    </script>

    <?php
    include "./templates/footer.php";
    ?>