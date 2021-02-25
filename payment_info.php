<?php require "./templates/header.php";
if ($_SESSION['user']['acceso'] > 1) exit;

if (isset($_POST['btnPago'])) {
    $cuotas_pagas = $_POST['cuotas_pagas'];
    $cuotas_pagas++;
    $cantidad_cuotas = $_POST['cantidad_cuotas'];
    $course_id = $db->escape($_POST['course_id']);
    $persona_id = $db->escape($_POST['persona_id']);
    $db->query("SELECT cantidad_modulos FROM curso WHERE id_curso = '$course_id' LIMIT 1");
    $temp = $db->fetch();
    $modulos = $temp['cantidad_modulos'];

    $db->query("SELECT `nivel` FROM `curso_p` WHERE `id_curso` = '$course_id' AND `id_persona` = '$persona_id' LIMIT 1");
    $tempNivel = $db->fetch();
    $sumaModulos = intval($modulos/$cantidad_cuotas);
    $nivel = $tempNivel['nivel'] + $sumaModulos;
    if ($cantidad_cuotas == $cuotas_pagas) {
        $nivel = $nivel + ($modulos-$nivel);
        $db->query("UPDATE `curso_p` SET `cuotas_pagas` = '$cuotas_pagas', `nivel` = '$nivel', `pago` = '1' WHERE `id_curso` = '$course_id' AND `id_persona` = '$persona_id'");
    }
    else
        $db->query("UPDATE `curso_p` SET `cuotas_pagas` = '$cuotas_pagas', `nivel` = '$nivel' WHERE `id_curso` = '$course_id' AND `id_persona` = '$persona_id'");
    ?>
    <h3>Pago registrado!</h3>
    <div><a class="btn btn-success" href="./pendientes.php">Volver</a></div>
<?php exit;
}

if (isset($_POST['search'])) {
    $search = $db->escape($_POST['search']);
    $db->query("SELECT personas.nombre, personas.apellido, personas.dni, personas.id, curso_p.cantidad_cuotas, curso_p.cuotas_pagas, curso_p.valor_cuota, curso.id_curso, curso.nombre AS nombre_curso FROM personas INNER JOIN curso_p ON personas.id = curso_p.id_persona LEFT JOIN curso ON curso.id_curso = curso_p.id_curso WHERE personas.dni = '$search'  LIMIT 1");
    $userValues = $db->fetchAll();

    if (count($userValues) == 0) { ?>
        <h3>No se encontro alumno</h3>
        <div><a class="btn btn-success" href="./pendientes.php">Volver</a></div>
    <?php exit;
    }
    foreach ($userValues as $data) {
        $course_id = $data['id_curso'];
        $persona_id = $data['id'];
        $dni = $data['dni'];
        $fullname = $data['nombre'] . " " . $data['apellido'];
        $cantidad_cuotas = $data['cantidad_cuotas'];
        $valor_cuota = $data['valor_cuota'];
        $cuotas_pagas = $data['cuotas_pagas'];
        $course_name = $data['nombre_curso'];
    }
    } else {
        $course_id = $db->escape($_POST['course_id']);
        $persona_id = $db->escape($_POST['persona_id']);
        $cantidad_cuotas = $db->escape($_POST['cantidad_cuotas']);
        $cuotas_pagas = $db->escape($_POST['cuotas_pagas']);
        $fullname = $db->escape($_POST['fullname']);
        $dni = $db->escape($_POST['dni']);
        $valor_cuota = $db->escape($_POST['valor_cuota']);
        $course_name = $db->escape($_POST['course_name']);
    }
?>

<div class="container">
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fadein active" id="diario">
            <div class="list-group">
                <form action="" method="post" onsubmit="return confirm('¿Esta seguro que desea actualizar el pago?');">
                    <div class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?= $fullname . " - " . $course_name ?></h5>
                        </div>
                        <p class="mb-1"><?= "Documento: " . $dni ?></p>
                        <p>Cuotas pagas: <?= $cuotas_pagas . "/" . $cantidad_cuotas ?></p>
                        <h3>Valor de la cuota: <?= $valor_cuota ?></h3>
                        <button class="btn btn-success" name="btnPago">Registrar pago</button>
                    </div>
                    <input type="hidden" name="course_id" value="<?= $course_id ?>">
                    <input type="hidden" name="persona_id" value="<?= $persona_id ?>">
                    <input type="hidden" name="cantidad_cuotas" value="<?= $cantidad_cuotas ?>">
                    <input type="hidden" name="cuotas_pagas" value="<?= $cuotas_pagas ?>">
                </form>
                <a class="btn btn-danger" href="./pendientes.php">Cancelar</a>
            </div>
        </div>
    </div>
</div>

<?php require "./templates/footer.php";
?>