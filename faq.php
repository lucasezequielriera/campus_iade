<?php
include './templates/header.php'
?>

<div class="container faq">
    <h2 class="mt-2">Preguntas Frecuentes</h2>
    <h3 id="1">¿Cómo estudio?</h3>
    <p>
        El material de estudio esta ordenado para que avance desde el primer manual y video hasta el ultimo. Ingresa en <strong>CURSOS</strong> y selecciona el curso que desees estudiar; entra en el modulo correspondiente y mira la clase audiovisual, lee el manual. Si surgen dudas contas con la <strong>asistencia de un profesor</strong> en <strong>CONSULTAS</strong>
    </p>
    <hr>
    <h3 id="2">¿Cómo es el examen?</h3>
    <p>
        El examen es un <strong>multiple-choice</strong> (se te hace una pregunta y se te da una serie de opciones en las cuales tiene que seleccionar la respuesta correcta) , lo podrás hacer la cantidad de veces que sea necesario hasta su aprobación. Con un 70% de las respuestas correctas podrás aprobarlo, <strong>al aprobar se te dispone automáticamente el certificado para que puedas descargarlo.</strong>
    </p>
    <hr>
    <h3 id="3">¿Cuáles son los certificados? ¿Cómo los tramito?</h3>
    <p>
        Además de nuestro Certificado Gratuito de Escuelas IADE que se genera por haber terminado el curso, brindamos dos tipos de certificados profesionales (los cuales se tramitan unavez obtenido el Certificado de Escuelas IADE) , el certificado de Standard Lift, con validez internacional en todo el Mercosur (para ejercer la profesión de forma legal); y el certificado de la Universidad Cristiana Redentora Internacional de Florida [IRCU] con validez en Estados Unidos y Europa (para ejercer la profesión de forma legal)
    </p>
    <br>
    <img src="./img/certificadoiade.png" alt="ejemplo certificado">
    <br>
    <br>
    <p>
        <strong><span>Para tramitar los certificados profesionales debe dirigirse al botón de "Certificados Profesionales" que se genera una vez se lo dá el de Escuelas IADE.</span></strong>
    </p>
    <hr>
    <h3 id="4">¿Cuáles son las Matrículas? ¿Para qué curso son? ¿Cuál curso es apto para cada una?</h3>
    <p>
        Actualmente contamos con 2 tipos de matrícula, la <strong>Matrícula de StandarLift</strong>, es una matrícula privada en la cual estas en un padrón donde te podrán buscar para confirmar tu certificación dentro de Standard Lift

        <strong>BENEFICIOS DE OBTENER CERTIFICACIÓN O MATRÍCULA DE STANDARD LIFT.</strong> (Texto brindado por Standard Lift <a href="https://www.standardlift.com.ar">http://www.standardlift.com.ar/</a> )

        <p>• Podrán desempeñar su empleo de forma PROFESIONAL dentro de un marco legal, en cumplimiento de normativas nacionales e internacionales reconocidas por el Estado y las diferentes aseguradoras.</p>
        <p>• Realizamos un proceso de evaluación y validación de los conocimientos de un trabajador en cualquier rol profesional, lo cual promueve su inserción y promoción, otorgándole ventajas competitivas. Aseguramos que dispone de la competencia mínima, con el aval de una entidad independiente a través de un proceso de certificación adecuado e imparcial. De esta manera mejora las oportunidades de
            empleo, incentiva el desarrollo de habilidades adquiridas y otorga un reconocimiento público de la experiencia laboral.</p>
        <p>• Contribuye a su desarrollo personal y profesional, lo que le da la seguridad de poseer las pautas adecuadas para llevar a cabo su trabajo. En síntesis, mejora su empleabilidad.</p>
        <p>• Trazabilidad, quienes contraten al alumno/a podrán buscar en nuestro portal quienes están certificados (siempre que acepten ser visualizados).</p>

        <strong>ESTA MATRÍCULA ES APLICABLE A CUALQUIERA DE NUESTROS CURSOS</strong>
        <strong>
            ESTA MATRÍCULA ES PROFESIONAL, NO REEMPLAZA A LA MATRÍCULA OFICIAL, POR EJEMPLO <span>EN INSTALACIONES SANITARIAS Y DE GAS, CONSTRUCCION, INSTALACIONES ELÉCTRICAS DOMICILIARIAS.</span> (En estos casos recomendamos ir con el Certificado Profesional de Standard Lift o de la Universidad Cristiana Redentora Internacional de Florida [IRCU] y preguntarle al ENTE REGULADOR de su zona (Ej: Edesur en Bs. As. , Argentina) si aceptan estos certificados para poder acceder al examen de la matrícula y tramitarla con ellos.
        </strong>
        <strong>
            <p>MATRÍCULA DE LA CÁMARA ARGENTINA DE REFRIGERACIÓN</p>
        </strong>

        Esta Matrícula sirve para poder reparar e instalar equipos de Aire Acondicionado con garantía sin quitarle la misma, reparar Heladeras con garantía y lo mas importante se puede ejercer la profesión <strong>EN BLANCO. SE TRAMITA DIRECTAMENTE CON LA CÁMARA ARGENTINA DE REFRIGERACIÓN (CONSÚLTELO A SU ASESOR UNA VEZ TENIENDO EL CERTIFICADO DE IADE)</strong>

    </p>
    <hr>
    <h3 id="5">¿Olvidaste tu contraseña? ¿Quiere cambiarla?</h3>
    <p>
        Por defecto tu contraseña es tu numero de DNI/CÉDULA. Para cambiarla debe dirigirse a su perfil y allí podrá cambiarla.
    </p>
    
</div>

<?php
require "./templates/footer.php";
?>


<script>
    $(document).ready(function() {
        for (i = 1; i < 6; i++) {
            if (window.location.hash == "#" + i) {
                $('html, body').animate({
                    scrollTop: $("#" + i).offset().top
                }, 1000);
            }
        }
    });
</script>