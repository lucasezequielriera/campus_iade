<?php
require "./templates/header.php";
$db->query("SELECT * FROM curso");
$resp = $db->fetchAll();

if (isset($_POST['loadFile'])) {
    $courseName = $_POST['course-name'];
    $directoryName = './cursos/' . $courseName;
    $examDirectory = $directoryName . '/' . 'exams/';
    $target_file = basename($_FILES["file"]["name"]);

    $doctype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($doctype == "php") {   
        $fichero = $_FILES["file"]["tmp_name"];
        move_uploaded_file($_FILES["file"]["tmp_name"],$examDirectory.$target_file);
        $_SESSION['mensaje'] = "Examen cargado con exito!";
        $_SESSION['msg_status'] = 1;     
    } else {
        $_SESSION['mensaje'] = "Error al cargar el examen, revise el formato del archivo a subir.";
        $_SESSION['msg_status'] = 0;
    }    
}

if ($_SESSION['mensaje'] != "") {
  if ($_SESSION['msg_status'] == 1) { ?>
    <div class="alert alert-success text-center"> <?php } else { ?> <div class="alert alert-danger text-center"> <?php } ?>
      <?php echo $_SESSION['mensaje']; ?>
      </div>
    <?php } $_SESSION['mensaje'] = ""; ?>

<div class="container my-3">
    <form action="" method="post" name="form_course">
        <div class="row">
            <div class="col-6 p-0 mb-2">
                <select id="course" name="course" class="form-control" required>
                    <option hidden disabled selected value="">-- Seleccione curso --</option>
                    <?php
                    $db->query("SELECT * FROM curso");
                    $resp = $db->fetchAll();
                    foreach ($resp as $temp) { ?>
                        <option value="<?= $temp['id_curso']; ?>"><?= $temp['nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <!--Primer row -->
    </form>
    <?php if (isset($_POST['course'])) {
        $cursoId = $_POST['course'];
        $db->query("SELECT * 
                    FROM curso 
                    WHERE id_curso = $cursoId 
                    LIMIT 1");
        $curso = $db->fetch();
    ?>
        <div class="row mt-2 ml-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Cargar de examen - <?= $curso['nombre']; ?></h3>
                </div>
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="btn btn-warning" for="my-file-selector">
                            <input type="file" name="file" id="exampleInputFile">
                            <input type="hidden" value="<?= $curso ?>" name="dir_upload">
                        </label>
                        <input type="hidden" name="course-name" value="<?= $curso['nombre']; ?>">

                        <button class="btn btn-danger ml-2" name="loadFile" type="submit">Cargar Examen</button>
                        <h3>Recuerde: El archivo de examen debe guardarse con extension .php</h3>
                        <h3>Puede generar el mismo desde <a href="http://phptutorial.info/scripts/multiple_choice/index.php?howitwords">aqui</a></h3>
                    </div>
                </form>
            </div>
        </div>

    <?php } ?>
</div>

<script>
    $(document).ready(function() {
        $('#course').on('change', function(e) {
            e.preventDefault();
            document.forms['form_course'].submit();
        });
    });
</script>

<?php
require "./templates/footer.php";
?>