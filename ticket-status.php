<?php
    $conexao = mysqli_connect("localhost", "root", "", "pew_tickets");

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : null;

    switch($acao){
        case "close":
            $tokenREF = isset($_POST["ticket_ref"]) ? $_POST["ticket_ref"] : null;
            if($tokenREF != null){
                mysqli_query($conexao, "update tickets_register set status = 0 where ref = '$tokenREF'");
                echo "true";
            }
            break;
    }