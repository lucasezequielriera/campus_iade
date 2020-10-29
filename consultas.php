<?php require "templates/header.php"; ?>
<head>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
                "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        }

        #messages {
            height: 88vh;
            overflow-x: hidden;
            padding: 10px;
            background-color: lightgoldenrodyellow;
        }

        form {
            display: flex;
        }

        input {
            font-size: 1.2rem;
            padding: 10px;
            margin: 10px 5px;
            appearance: none;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #message {
            flex: 2;
        }

        .msg {
            background-color: #dcf8c6;
            padding: 5px 10px;
            border-radius: 5px;
            margin-bottom: 8px;
            width: fit-content;
        }
        .msg p {
            margin: 0;
            font-weight: bold;
        }
        .msg span {
            font-size: 0.7rem;
            margin-left: 15px;
        }
    </style>
</head>
<div class="container-fluid">
    <div class="row">
    <div class="col-3" style="border: solid black 1px;">
        <div class="list-group">
        <?php 
            $db->query("SELECT * 
                        FROM curso 
                        LEFT JOIN curso_p ON curso.id_curso = curso_p.id_curso
                        WHERE curso_p.id_persona = " . $_SESSION['user']['id']);
            $resp = $db->fetchAll(); 

            foreach ($resp as $temp) { ?>
                <button type="button" class="list-group-item" onclick="set(<?=$temp['id_curso'];?>,<?=$_SESSION['user']['id'];?>)">
                <?=$temp['nombre'];?>
                </button> 
            <?php } ?>  <!-- Cierre del foreach -->

        </div>
    </div>
    <div class="col-9" id="messages" style="border: solid black 1px;"></div>    <!--ACA VAN LOS MENSAJES -->
        <div class="col-12" style="border: solid black 1px">
            <div>                                                                   <!-- Boton para el envio del mensaje -->
                <input type="text" id="message" autocomplete="off" autofocus placeholder="Escriba su mensaje" />
                <input id="btnSendMsg" type="button" value="Send" onclick="send()"/>
            </div>
        </div>
    </div>
</div>

<script>
    var start = 0;

        function set(curso,id) {
            sessionStorage.setItem("cc", curso);
            sessionStorage.setItem("ii", id);
            document.location.reload();
        }

        $(document).ready(function load() {
            let course = sessionStorage.getItem("cc");
            let from = sessionStorage.getItem("ii");
            $.get('chat.php?start=' + start + '&course=' + course + '&from=' + from, function (result) {
                    result.forEach(item => {
                        start = item.id;
                        $('#messages').append(renderMessage(item));
                    });
                    $('#messages').animate({scrollTop: $('#messages')[0].scrollHeight});
                setTimeout(() => {load()}, 500);
            });
        });

        function renderMessage(item){
            let time = new Date(item.fecha);
            time = `${time.getHours()}:${time.getMinutes() < 10 ? '0' : ''}${time.getMinutes()}`;
            return `<div class="msg"><p>${item.nombre}</p>${item.mensaje}<span>${time}</span></div>`;
        }

        function send() {
            let course = sessionStorage.getItem("cc");
            $.post('chat_send.php', {
                message: $("#message").val(),
                from: <?=$_SESSION['user']['id'];?>,  
                course: course  
                });
                $("#message").val('');
            return false;
        }

        var input = document.getElementById("message");
        input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("btnSendMsg").click();
        }
        });
    </script>

<?php require "templates/footer.php"; ?>