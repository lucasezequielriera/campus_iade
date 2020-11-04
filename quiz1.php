<?php
require "./templates/header.php";
error_reporting(0);

$title = "Modulo 1";
$address = "exams.php";
$randomizequestions = "yes";

$a = array(
    1 => array(
        0 => "Cual es la capital de Finlandia?",
        1 => "Oslo",
        2 => "Nurburgring",
        3 => "Osaka",
        4 => "Helsinki",
        6 => 4
    ),
    2 => array(
        0 => "Cuanto es 2 en binario?",
        1 => "4",
        2 => "004",
        3 => "2201 ",
        4 => "0010",
        5 => "0100",
        6 => 4
    ),
    3 => array(
        0 => "La nueva Yamaha R6 2020 cuenta con quick shifter?",
        1 => "Si",
        2 => "No",
        3 => "Las motos son peligrosas",
        4 => "quick que?",
        5 => "Honda es mejor",
        6 => 1
    ),
    4 => array(
        0 => "Pregunta de ejemplo, correcta, value5",
        1 => "ejemplo respuesta",
        2 => "ejemplo respuesta",
        3 => "ejemplo respuesta",
        4 => "ejemplo respuesta",
        5 => "Correcta",
        6 => 5
    ),
    5 => array(
        0 => "Otra de testeo, correcta value=3",
        1 => "ejemplo respuesta",
        2 => "ejemplo respuesta",
        3 => "Correcta",
        4 => "ejemplo respuesta",
        5 => "ejemplo respuesta",
        6 => 3
    ),
);

$max = 5;

$question = $_POST["question"];

if ($_POST["Randon"] == 0) {
    if ($randomizequestions == "yes") {
        $randval = mt_rand(1, $max);
    } else {
        $randval = 1;
    }
    $randval2 = $randval;
} else {
    $randval = $_POST["Randon"];
    $randval2 = $_POST["Randon"] + $question;
    if ($randval2 > $max) {
        $randval2 = $randval2 - $max;
    }
}

$ok = $_POST["ok"];

if ($question == 0) {
    $question = 0;
    $ok = 0;
    $percentaje = 0;
} else {
    $percentaje = Round(100 * $ok / $question);
}
?>

<SCRIPT LANGUAGE='JavaScript'>
    function Goahead(number) {
        if (document.percentaje.response.value == 0) {
            if (number == <?php print $a[$randval2][6]; ?>) {
                document.percentaje.response.value = 1
                document.percentaje.question.value++
                document.percentaje.ok.value++
            } else {
                document.percentaje.response.value = 1
                document.percentaje.question.value++
            }
        }
    }
</SCRIPT>
</HEAD>

<BODY BGCOLOR=FFFFFF>
    <CENTER>
        <H1><?php print "$title"; ?></H1>
        <TABLE BORDER=0 CELLSPACING=5 WIDTH=500>
            <?php if ($question < $max) { ?>
                <TR>
                    <TD ALIGN=RIGHT>
                        <FORM METHOD=POST NAME="percentaje" ACTION="<?php print $URL; ?>">
                            <BR><input type=submit value="Siguiente >>">
                            <input type=hidden name=response value=0>
                            <input type=hidden name=question value=<?php print $question; ?>>
                            <input type=hidden name=ok value=<?php print $ok; ?>>
                            <input type=hidden name=Randon value=<?php print $randval; ?>>
                            <br><?php print $question + 1; ?> / <?php print $max; ?>
                        </FORM>
                        <HR>
                    </TD>
                </TR>

                <TR>
                    <TD>
                        <FORM METHOD=POST NAME="question" ACTION="">
                            <?php print "<b>" . $a[$randval2][0] . "</b>"; ?>

                            <BR>     <INPUT TYPE=radio NAME="option" VALUE="1" onClick=" Goahead (1);"><?= " ".  $a[$randval2][1]; ?>
                            <BR>     <INPUT TYPE=radio NAME="option" VALUE="2" onClick=" Goahead (2);"><?= " ". $a[$randval2][2]; ?>
                            <?php if ($a[$randval2][3] != "") { ?>
                                <BR>     <INPUT TYPE=radio NAME="option" VALUE="3" onClick=" Goahead (3);"><?= " ". $a[$randval2][3];
                                                                                                        } ?>
                            <?php if ($a[$randval2][4] != "") { ?>
                                <BR>     <INPUT TYPE=radio NAME="option" VALUE="4" onClick=" Goahead (4);"><?= " ". $a[$randval2][4];
                                                                                                        } ?>
                            <?php if ($a[$randval2][5] != "") { ?>
                                <BR>     <INPUT TYPE=radio NAME="option" VALUE="5" onClick=" Goahead (5);"><?= " ". $a[$randval2][5];
                                                                                                        } ?>
                        </FORM>
                    <?php
                } else {
                    ?>
                <TR>
                    <TD ALIGN=Center>
                        El examen ha finalizado.
                        <BR>Porcentaje de respuestas correctas: <?php print $percentaje; ?> %
                        <?php if ($percentaje>60) {
                            $_SESSION[''];
                            echo "Ha pasado el examen."
                        } else { ?>
                            echo "No ha alcanzado la nota suficiente.";
                        <?php } ?>
                        <p><A HREF="<?php print $address; ?>">Volver</a>
                        <?php } ?>
                    </TD>
                </TR>
        </TABLE>
    </CENTER>
</BODY>
</HTML>

<?php
require "./templates/footer.php";
?>