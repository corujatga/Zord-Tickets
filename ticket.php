<?php 
$conexao = mysqli_connect("localhost", "root", "zord@2022", "zfood");
$ticketREF = isset($_GET["ref"]) ? addslashes($_GET["ref"]) : null;

$Ticketquery = mysqli_query($conexao, "select * from tickets_register where ref = '$ticketREF'");
$infoTicket = mysqli_fetch_array($Ticketquery);


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">     


      

	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
       
        <title>Ticket - #<?php echo $ticketREF ?></title>

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">

        <!-- Fonts -->
        <link href="../css/gfonts.css" rel="stylesheet">
        
        <!-- Icons -->
        <link href="../argon/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="../argon/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="../argon/css/argon.css?v=1.0.0" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="../custom/css/custom.css" rel="stylesheet">
        <!-- Select2 -->
        <link type="text/css" href="../custom/css/select2.min.css" rel="stylesheet">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="../vendor/jasny/css/jasny-bootstrap.min.css">
        <!-- Flatpickr datepicker -->
        <link rel="stylesheet" href="../vendor/flatpickr/flatpickr.min.css">

         <!-- Font Awesome Icons -->
        <link href="../argonfront/css/font-awesome.css" rel="stylesheet" />

        <!-- Lottie -->
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

        <!-- Range datepicker -->
        <link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css" />


        
        <!-- Custom CSS defined by admin -->
        <link type="text/css" href="../byadminback.css" rel="stylesheet">




    


<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

<script type="text/javascript" src="../@pew/custom-textarea/ckeditor.js"></script>
<script type="text/javascript" src="../js/standard.js"></script>
<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat');
    .modal-dialog-full-width {
        width: 100% !important;
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        max-width:none !important;

    }
.modal-xl{max-width:800px}
@media (min-width:1200px){.modal-xl{max-width:1140px}}

    .modal-content-full-width  {
        height: auto !important;
        min-height: 100% !important;
        border-radius: 0 !important;
        background-color: #ececec !important 
    }

    .modal-header-full-width  {
        border-bottom: 1px solid #9ea2a2 !important;
    }

    .modal-footer-full-width  {
        border-top: 1px solid #9ea2a2 !important;
    }    .display-ticket{
        width: 95%;
        margin: 0 auto;
        padding: 20px 0px 20px 0px;
        display: flex;
        flex-flow: row wrap;
        align-items: baseline;
    }
    .display-ticket .ticket-info{
        width: calc(30% - 2px);
        border: 0px solid #ccc;
        background-color: white;
        border-radius: 5px;
    }
    .display-ticket .ticket-info .title{
        margin: 0px;
        padding: 10px;
        background-color: #eee;
        border-radius: 5px;
    }
    .display-ticket .ticket-info .box-info{
        padding: 10px;   
    }
    .display-ticket .ticket-info .box-info .subtitle{
        margin: 0px;
    }
        .display-ticket .ticket-info .bottom-controlls{
        padding: 10px;
        display: flex;
        flex-flow: row wrap;
        justify-content: space-around;
    }
    .display-ticket .ticket-info .bottom-controlls .controll-button{
        padding: 5px 10px 5px 10px;
        border-radius: 4px;
        background-color: #ddd;
        text-align: center;
        margin: 10px;
        font-size: 14px;
        color: #fff;
        cursor: pointer;
    }
    .display-ticket .ticket-info .bottom-controlls .green{
        background-color: #05a031;
    }
    .display-ticket .ticket-info .bottom-controlls .green:hover{
        background-color: #007521;
    }
    .display-ticket .ticket-info .bottom-controlls .red{
        background-color: #da4444;
    }
    .display-ticket .ticket-info .bottom-controlls .red:hover{
        background-color: #c02929;   
    }
    .display-ticket .ticket-info .bottom-controlls .disabled{
        cursor: not-allowed;
    }
    .display-ticket .ticket-content{
        width: calc(70% - 20px);
        padding: 10px;
        overflow: hidden;
    }
    .display-ticket .ticket-content .message-field .message-button{
        position: relative;
        background-color: #eee;
        padding: 0px 15px 0px 15px;
        border-radius: 5px;
        height: 45px;
        line-height: 45px;
        cursor: pointer;
    }
    .display-ticket .ticket-content .message-field .message-button:active .button-icon{
        background-color: #ccc;
    }
    .display-ticket .ticket-content .message-field .message-button .button-icon{
        position: absolute;
        right: 0px;
        top: 0px;
        height: 45px;
        width: 45px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ddd;
        border-radius: 5px;
        cursor: pointer;
    }
    .display-ticket .ticket-content .message-field .message-button .minus-icon{
        visibility: hidden;
    }
    .display-ticket .ticket-content .message-field .ticket-message{
        position: relative;
        right: 100%;
        transition: .4s;
        display: none;
        text-align: right;
    }
    .display-ticket .ticket-content .message-field .submit-button{
        background-color: #6abd45;
        color: #fff;
        border: none;
        padding: 10px 15px 10px 15px;
        border-radius: 3px;
        cursor: pointer;
    }
    .display-ticket .ticket-content .message-field .show-message-area{
        right: 0;
    }
    .display-ticket .ticket-content .messages-display .box-message{
        margin: 15px 0px 15px 0px;
        border: 0px solid #ccc;
        border-radius: 5px;
    }
    .display-ticket .ticket-content .messages-display .box-message .top-info{
        height: 40px;
        line-height: 20px;
        background-color: #f6f6f6;
        padding: 10px;
    }
    .display-ticket .ticket-content .messages-display .box-message .top-info .icon{
        width: 30px;
        margin-right: 10px;
        font-size: 34px;
        float: left;
        text-align: center;
    }
    .display-ticket .ticket-content .messages-display .box-message .top-info .name-field{
        width: auto;
        float: left;
        font-weight: normal;
    }
    .display-ticket .ticket-content .messages-display .box-message .top-info .name-field .name{
        font-weight: bold;
    }
    .display-ticket .ticket-content .messages-display .box-message .top-info .date{   
        text-align: right;
    }
    .display-ticket .ticket-content .messages-display .message-body{
        clear: both;
        padding: 10px;
    }
    .display-ticket .ticket-content .messages-display .display-images{
        display: flex;
        flex-flow: row wrap;
        padding: 10px;
    }
    .display-ticket .ticket-content .messages-display .display-images .title{
        width: 100%;
        margin: 0px 0px 5px 0px;
    }
    .display-ticket .ticket-content .messages-display .display-images img{
        height: 100%;
        margin-right: 10px;
        cursor: pointer;
    }
    .display-ticket .ticket-content .messages-display .display-images img:hover{
        opacity: .9;
    }
    .warning{
        background-color: #d68989;
        padding: 10px;
        border-radius: 3px;
        margin: 10px 0px 10px 0px;
        color: #fff;
    }
    .ticket-images-zoom{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        transition: .3s;
        z-index: 200;
        overflow: hidden;
        overflow-y: scroll;
        visibility: hidden;
        text-align: center;
    }
    .ticket-images-zoom img{
        max-width: calc(100% - 80px);
        margin: 50px 0px 50px 0px;
    }
    .ticket-images-zoom .close-button{
        position: fixed;
        top: 25px;
        right: 30px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }
    .ticket-images-zoom .close-button:hover{
        background-color: #fff;   
    }
</style>
<script>
    $(document).ready(function(){
        CKEDITOR.replace("ticketTxtArea");
        var displayTicket = $(".display-ticket");
        displayTicket.each(function(){
            var mainDisplay = $(this);
            var ticketInfo = mainDisplay.children(".ticket-info");
            var bottomControlls = ticketInfo.children(".bottom-controlls");
            var ticketContent = mainDisplay.children(".ticket-content");
            var messageField = ticketContent.children(".message-field");
            var messageButton = messageField.children(".message-button");
            var ticketMessage = messageField.children(".ticket-message");
            var messagesDisplay = ticketContent.children(".messages-display");
            var messageBoxes = messagesDisplay.children(".box-message");
            
            function toggle(){
                if(ticketMessage.hasClass("show-message-area")){
                    messageButton.children(".plus-icon").css("visibility", "visible");
                    messageButton.children(".minus-icon").css("visibility", "hidden");
                    ticketMessage.removeClass("show-message-area");
                    setTimeout(function(){
                        ticketMessage.css("display", "none");
                    }, 400);
                }else{
                    messageButton.children(".plus-icon").css("visibility", "hidden");
                    messageButton.children(".minus-icon").css("visibility", "visible");
                    ticketMessage.css("display", "block");
                    setTimeout(function(){
                        ticketMessage.addClass("show-message-area");
                    }, 100);
                }
            }
            
            messageButton.off().on("click", function(){
                toggle();
            });
            
            bottomControlls.children(".controlls-button").each(function(){
                var button = $(this);
                var action = button.attr("js-action");
                var enabled = button.hasClass("disabled") ? false : true;
                if(enabled){
                    button.off().on("click", function(){
                        switch(action){
                            case "fechar":
                                function fechar(){
                                    var ticketREF = $("#ticketREF").val();
                                    $.ajax({
                                        type: "POST",
                                        url: "ticket-status.php",
                                        data: {ticket_ref: ticketREF, acao: "close"},
                                        error: function(){
                                            mensagemAlerta("Ocorreu um erro ao fechar o ticket.");  
                                        },
                                        success: function(response){
                                            console.log(response);
                                            if(response == "true"){
                                                window.location.href = "https://zfood.menu/restaurants/<?php echo $ticketrestorant ?>/edit";
                                            }else{
                                                mensagemAlerta("Ocorreu um erro ao fechar o ticket.");  
                                            }
                                        }
                                    });
                                }
                                mensagemConfirma("VocÃª tem certeza que deseja fechar este ticket?", fechar);
                                break;
                            case "responder":
                                toggle();
                                break;
                        }
                    });
                }
            });
            
            var zoomOpen = false;
            function toggle_image_zoom(newSRC = null){
                var zoomDisplay = $(".ticket-images-zoom");
                var imageField = zoomDisplay.children("img");
                if(!zoomOpen){
                    zoomOpen = true;
                    imageField.prop("src", newSRC);
                    zoomDisplay.css({
                        visibility: "visible",
                        opacity: "1"
                    });
                }else{
                    var delay = 300;
                    zoomDisplay.css({
                        visibility: "hidden",
                        opacity: "0"
                    });
                    setTimeout(function(){
                        zoomOpen = false;
                    }, delay);
                }
            }
            
            $(".js-close-zoom").off().on("click", function(){
                toggle_image_zoom();
            });
            
            messageBoxes.each(function(){
                var messageBox = $(this); 
                var imagesDisplay = messageBox.children(".display-images");
                var images = imagesDisplay.children("img");
                images.each(function(){
                    var image = $(this);
                    var src = image.prop("src");
                    image.off().on("click", function(){
                        toggle_image_zoom(src);
                    });
                });
            });
            
        });
    });
</script>
</head>
    <body>
<div class="container">
<div class="card card-profile shadow">
    <div class="card-header">
<div class="row">
 <div class="col-4">
        <h5 class="h3 mb-0"><i class="fas fa-ticket-alt"></i> Ticket - #<?php echo $ticketREF ?></h5>
 </div>
<div class="col-8 text-lg-right">
<a href='https://zfood.menu/restaurants/' class='btn btn-success'><i class='fa fa-mail-reply-all'></i> Voltar</a>
 </div>
 </div>
 </div>
    <div class="card-body">

<?php

$showTicket = false;


$queryTotal = mysqli_query($conexao, "select count(id) as total from tickets_register where ref = '$ticketREF'");
$infoTotal = mysqli_fetch_array($queryTotal);
$showTicket = $ticketREF != null && $infoTotal["total"] > 0 ? true : false;

if($showTicket){
    
    require_once "../@pew/@classe-system-functions.php";
    
    $query = mysqli_query($conexao, "select * from tickets_register where ref = '$ticketREF'");
    $infoTicket = mysqli_fetch_array($query);
    $messages = array();
    
    $dataCompleta = $infoTicket["data_controle"];
    $dataAno = substr($dataCompleta, 0, 10);
    $dataAno = $pew_functions->inverter_data($dataAno);
    $dataHorario = substr($dataCompleta, 11);
    
    switch($infoTicket["priority"]){
        case 1:
            $prioridade = "MÃ©dia";
            break;
        case 2:
            $prioridade = "Urgente";
            break;
        default:
            $prioridade = "Normal";
    }
    
    switch($infoTicket["status"]){
        case 0:
            $status = "Fechado";
            break;
        case 2:
            $status = "Aguardando resposta do cliente";
            break;
        default:
            $status = "Aguardando resposta do atendente";
            break;
    }
    
    $queryMessages = mysqli_query($conexao, "select * from tickets_messages where ticket_id = '{$infoTicket["id"]}' order by id desc");
    while($infoMessage = mysqli_fetch_array($queryMessages)){
        array_push($messages, $infoMessage);
    }
    
    require_once "../js/interatividade.php";
    
?>
<div class="ticket-images-zoom"><div class='close-button js-close-zoom'><i class="fas fa-times"></i></div><img></div>
<div class="display-ticket ">
    <div class="ticket-info shadow">
        <h3 class="title">InformaÃ§Ãµes do ticket</h3>
        <div class="box-info">
            #<?= $infoTicket['ref'] ?> - <?= $infoTicket['topic'] ?>
        </div>
        <div class="box-info alter-color">
            <h4 class="subtitle">Departamento</h4>
            <?= $infoTicket['department'] ?>
        </div>
        <div class="box-info">
            <h4 class="subtitle">Enviado</h4>
            <?= $dataAno ?> (<?= $dataHorario ?>)
        </div>
        <div class="box-info alter-color">
            <h4 class="subtitle">Prioridade</h4>
            <?= $prioridade ?>
        </div>
        <div class="box-info alter-color">
            <h4 class="subtitle">Status</h4>
            <?= $status ?>
        </div>
        <div class="bottom-controlls">
            <div class="controlls-button btn btn-sm btn-success" js-action='responder'><i class="fas fa-pen"></i> Responder</div>
            <?php
            $buttonClass = $infoTicket["status"] == 0 ? "disabled" : "red";
            ?>
            <div class="controlls-button btn btn-sm btn-danger <?= $buttonClass; ?>" js-action='fechar'><i class="fas fa-times"></i> Fechar</div>
        </div>
    </div>
    <div class="ticket-content ">
        <div class="message-field ">
            <div class="message-button ">
                <i class="fas fa-pen"></i> Responder 
                <div class='button-icon plus-icon'><i class="fas fa-plus font-icon"></i></div>
                <div class='button-icon minus-icon'><i class="fas fa-minus font-icon"></i></div>
            </div>
          
            <?php
            if($infoTicket["status"] == 0){
                echo "<div class='warning'>Este ticket estÃ¡ fechado. Responda-o para ativa-lo novamente.</div>";
            }    
            ?>
        </div>
        <div class="messages-display ">
            <?php
            foreach($messages as $message){
            ?>
            <div class="box-message ">
           <div class="card card-profile ">

                <div class="top-info">
                    <div class="icon"><i class="fas fa-user"></i></div>
                    <div class="name-field">
                        <div class="name"><?= $message["name"]; ?></div>
                        <?php
                        switch($message["type"]){
                            case 1:
                                $type = "Atendente";
                                break;
                            default:
                                $type = "Cliente";
                        }
                        ?>
                        <div class="subinfo"><?= $type; ?></div>
                    </div>
                    <div class="date">
                    <?php
                        $dataMensagem = substr($message["data_controle"], 0, 10);
                        $dataMensagem = $pew_functions->inverter_data($dataMensagem);
                        $dataHorario  = substr($message["data_controle"], 11);
                        echo $dataMensagem . " (" . $dataHorario . ")";
                    ?>
                    </div>
                </div>
                <article class="message-body"><?= $message["message"]; ?></article>
                <?php
                    $condicao = "message_id = '{$message["id"]}'";
                    $contar = mysqli_query($conexao, "select count(id) as total from tickets_images where $condicao");
                    $contagem = mysqli_fetch_assoc($contar);
                    $dirImagens = "ticket_images/";
                    if($contagem['total'] > 0){
                        echo "<div class='display-images'>";
                        echo "<h4 class='title'>Anexos:</h4>";
                        $queryImagens = mysqli_query($conexao, "select image from tickets_images where $condicao");
                        while($infoImagens = mysqli_fetch_array($queryImagens)){
                            echo "<img src='$dirImagens{$infoImagens["image"]}'>";
                        }
                        echo "</div>";
                    }
                    
                ?>
            </div>
  </div> 
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
}else{
    echo "<h3 align=center>Nenhum resultado foi encontrado</h3>";
   }
?>
 </div>
  </div>
</div>
<script>
$(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' Imagens Selecionadas' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
  });
  
});
</script>
 </body>
</html>
