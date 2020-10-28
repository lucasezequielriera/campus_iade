<?php require "templates/header.php"; ?>

<div class="container-fluid">
    <div class="row">
    <div class="col-3" style="border: solid black 1px;">
    <li class="nav-item dropdown">  <!-- Listado de los cursos disponibles -->
        <a class="nav-link dropdown-toggle" href="curso.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Mis cursos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <?php 
            $db->query("SELECT * 
                        FROM curso 
                        LEFT JOIN curso_p ON curso.id_curso = curso_p.id_curso
                        WHERE curso_p.id_persona = " . $_SESSION['user']['id']);
            $resp = $db->fetchAll(); 

            foreach ($resp as $temp) { ?>
                <button type="button" class="dropdown-item" onclick="preload(<?=$temp['id_curso'];?>,<?=$_SESSION['user']['id'];?>)">
                <?=$temp['nombre'];?>
                </button> 
                <div class="dropdown-divider"></div>
            <?php } ?>  <!-- Cierre del foreach -->

        </div>
    </li> <!-- Cierre de listado de cursos -->
    </div>
    <div class="col-9" id="messages" style="border: solid black 1px;">MENSAJES</div>    <!--ACA VAN LOS MENSAJES -->
        <div class="col-12" style="border: solid black 1px">
            <form id="form" action="">                                                                          <!-- Boton para el envio del mensaje -->
                <input type="text" id="message" autocomplete="off" autofocus placeholder="Escriba su mensaje" />
                <input type="submit" value="Send" />
            </form>
        </div>
    </div>
</div>

<script>
    var start = 0;

        $("#form").submit(function (e) {
            $.post(url, {
                message: $("#message").val(),
                from: from,  //hidratar aca
                course: course                       //FALTA ENVIAR EL ID DE LA MATERIA SELECCIONADA.
                });
                $("#message").val('');
            return false;
        })

        function preload(curso, id) {            
            var from = id,
                course = curso,
                url = "chat.php";
            load(); 
        }

        function load() {
            $.get(url + '?start=' + start, function (result) {
                if (result.items){
                    result.items.forEach(item => {
                        start = item.id;
                        $('#messages').append(renderMessage(item));
                    });
                    $('#messages').animate({scrollTop: $('#messages')[0].scrollHeight});
                };
                load();
            });
        }

        function renderMessage(item){
            let time = new Date(item.created);
            time = `${time.getHours()}:${time.getMinutes() < 10 ? '0' : ''}${time.getMinutes()}`;
            return `<div class="msg"><p>${item.from}</p>${item.message}<span>${time}</span></div>`;
        }
    </script>

<?php require "templates/footer.php"; ?>