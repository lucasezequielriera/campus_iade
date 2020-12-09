<?php
require "./templates/header.php";
error_reporting(0);

$title = "Modulo 1";
$address = "exams.php";
$randomizequestions = "yes";

$ruta_examen = $_POST['examen'] . "exam.json";

$strJsonFileContents = file_get_contents($ruta_examen);
$array = json_decode($strJsonFileContents, true);
echo $ruta_examen;
var_dump($array); // print array

$max = 7;

$question = $_POST["question"];

if ($_POST["Random"] == 0) {
    if ($randomizequestions == "yes") {
        $randval = mt_rand(1, $max);
    } else {
        $randval = 1;
    }
    $randval2 = $randval;
} else {
    $randval = $_POST["Random"];
    $randval2 = $_POST["Random"] + $question;
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
                            <input type=hidden name=Random value=<?php print $randval; ?>>
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
                } else { ?>
                <TR>
                    <TD ALIGN=Center>
                        El examen ha finalizado.
                        <BR>Porcentaje de respuestas correctas: <?php print $percentaje; ?> %
                        <?php if ($percentaje>60) {
                            $_SESSION[''];
                            echo "Ha pasado el examen.";
                        } else { 
                            echo "No ha alcanzado la nota suficiente.";
                        } ?>
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