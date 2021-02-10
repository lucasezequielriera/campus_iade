<?php require "./templates/header.php";
if ($_SESSION['user']['acceso'] > 1) exit;


if (isset($_POST['btnPago'])) {
    $cuotas_pagas = $_POST['cuotas_pagas'];
    $cuotas_pagas++;
    $cantidad_cuotas = $_POST['cantidad_cuotas'];
    $course_id = $db->escape($_POST['course_id']);
    $persona_id = $db->escape($_POST['persona_id']);
    if ($cantidad_cuotas == $cuotas_pagas)
        $db->query("UPDATE `curso_p` SET `cuotas_pagas` = '$cuotas_pagas', `pago` = '1' WHERE `id_curso` = '$course_id' AND `id_persona` = '$persona_id'");
    else 
        $db->query("UPDATE `curso_p` SET `cuotas_pagas` = '$cuotas_pagas' WHERE `id_curso` = '$course_id' AND `id_persona` = '$persona_id'");

    echo "Pago registrado!";
    ?> <a class="btn btn-success" href="./pendientes.php">Volver</a>
<?php exit;
}

$course_id = $_POST['course_id'];
$persona_id = $_POST['persona_id'];
$dni = $_POST['dni'];
$fullname = $_POST['fullname'];
$cantidad_cuotas = $_POST['cantidad_cuotas'];
$valor_cuota = $_POST['valor_cuota'];
$cuotas_pagas = $_POST['cuotas_pagas'];
$course_name = $_POST['course_name'];
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