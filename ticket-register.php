<?php
    $conexao = mysqli_connect("localhost", "root", "", "pew_tickets");

    $departamento = isset($_POST["departamento"]) ? addslashes($_POST["departamento"]) : "Outros";
    $assunto = isset($_POST["assunto"]) ? addslashes($_POST["assunto"]) : null;
    $prioridade = isset($_POST["prioridade"]) ? addslashes($_POST["prioridade"]) : null;
    $mensagem = isset($_POST["mensagem"]) ? addslashes($_POST["mensagem"]) : null;

    $ticketRef = "TCK".substr(md5(uniqid()), 0, 8);
    $dataAtual = date("Y-m-d h:i:s");
    $dirImagens = "ticket_images/";

    $idUsuario = 1;
    $nomeCliente = "Rogerio Mendes";

    function get_last_insert_id(){
        global $conexao;
        
        $qLastID = mysqli_query($conexao, "select last_insert_id()");
        $infoLastID = mysqli_fetch_array($qLastID);
        return $infoLastID["last_insert_id()"];
    }

    mysqli_query($conexao, "insert into tickets_register (ref, id_cliente, topic, priority, department, data_controle, status) values ('$ticketRef', '$idUsuario', '$assunto', '$prioridade', '$departamento', '$dataAtual', 1)");

    $ticketID = get_last_insert_id();

    mysqli_query($conexao, "insert into tickets_messages (ticket_id, name, message, type, data_controle) values ('$ticketID', '$nomeCliente', '$mensagem', 0, '$dataAtual')");

    $messageID = get_last_insert_id();

    if(isset($_FILES["imagens"])){
        foreach($_FILES["imagens"]["tmp_name"] as $index => $tmp_name){
            if($tmp_name != ""){
                $file_name = $_FILES["imagens"]["name"][$index];
                $file_tmp = $_FILES["imagens"]["tmp_name"][$index];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $final_name = md5(time().$index).".".$file_ext;
                move_uploaded_file($file_tmp, $dirImagens.$final_name);

                mysqli_query($conexao, "insert into tickets_images (ticket_id, message_id, image) values ('$ticketID', '$messageID', '$final_name')");
            }
        }
    }

    echo "<script>window.location.href = 'ticket.php?ref=$ticketRef';</script>";