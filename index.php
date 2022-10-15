
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<script type="text/javascript" src="@pew/custom-textarea/ckeditor.js"></script>
<script type="text/javascript" src="standard.js"></script>
<div class="card card-profile shadow">
    <div class="card-header">
 <div class="col-4">
        <h5 class="h3 mb-0">{{__("Ticket zord")}}</h5>
 </div>
 </div>
    <div class="card-body">

 <div class="col-4 ">
<button type="button" data-toggle="modal" data-target="#exampleModal"  class="btn btn-sm btn-success"><i class="fa fa-ticket mr-2"></i> Novo Ticket</button>
    </div>
</br>
<table class="table table-hover">
 <thead>
   <?php $id =" $restorant->id";?>
    <tr>
        <td scope="col">Refer&ecirc;ncia</td>
        <td scope="col">Assunto</td>
        <td scope="col">Departamento</td>
      <!--<td scope="col">Enviado</td>-->
        <td scope="col">Prioridade</td>
        <td scope="col">Status</td>
        <td scope="col">Ver</td>
    </tr>
</thead>
    <tbody>
    <?php
        require_once "@pew/@classe-system-functions.php";
        $conexao = mysqli_connect("localhost", "root", "", "pew_tickets");
    
        $condicao = "true";
        $contar = mysqli_query($conexao, "select count(id) as total from tickets_register where  $condicao");
        $contagem = mysqli_fetch_assoc($contar);
        if($contagem['total'] > 0){
            $query = mysqli_query($conexao, "select * from tickets_register where id_cliente= $restorant->id and $condicao");
            while($infoTicket = mysqli_fetch_array($query)){
                $dataCompleta = $infoTicket["data_controle"];
                $dataAno = substr($dataCompleta, 0, 10);
                $dataAno = $pew_functions->inverter_data($dataAno);
                $dataHorario = substr($dataCompleta, 11);

                switch($infoTicket["priority"]){
                    case 1:
                        $prioridade = "M&eacute;dia";
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
                
                echo "<tr class='ticket-line'>";
                    echo "<td>#{$infoTicket['ref']}</td>";
                    echo "<td>{$infoTicket['topic']}</td>";
                    echo "<td>{$infoTicket['department']}</td>";
                    echo "<td>$dataAno</td>";
                    echo "<td>$prioridade</td>";
                    echo "<td>$status</td>";
                    echo "<td align=center><a href='../../ticket.php?ref={$infoTicket['ref']}' class='btn btn-sm btn-success'><i class='fas fa-eye'></i></a></td>";
                echo "</tr>";


            }
        }else{
            echo "<tr><td colspan=7><font style='color: #666;'>Nenhum ticket foi registrado.</font></td></tr>";
        }
    ?>
    </tbody>
</table>

  </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Adicionar Ticket</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      

<script>
    $(document).ready(function(){
        CKEDITOR.replace("sendTicketTxtArea");
        
        var enviandoForm = false;
        $("#jsFormSendTicket").off().on("submit", function(event){
            event.preventDefault(); 
            if(!enviandoForm){
                enviandoForm = true;
                var form = $(this);
                var assunto = $("#jsTopicTicket").val();
                var descricao = CKEDITOR.instances["sendTicketTxtArea"].getData();

                function validar(){
                    if(assunto.length < 5){
                        mensagemAlerta("O campo assunto deve conter no mÃ­nimo 5 caracteres", $("#jsTopicTicket"));
                        return false;
                    }
                    if($(descricao).text().length < 20){
                        mensagemAlerta("O campo descriÃ§Ã£o deve conter no mÃ­nimo 20 caracteres");
                        return false;
                    }
                    return true;
                }

                if(validar()){
                    form.unbind("submit").submit();
                }else{
                    enviandoForm = false;
                }
            }
            
        });
    });
</script>
<?php require_once "js/interatividade.php"; ?>

<div class="container-ticket">
    <h2>Como podemos lhe ajudar?</h2>
    <form action="../../js/ticket-register.php" method="post" id="jsFormSendTicket" enctype="multipart/form-data">
        <label>
            Departamento
 
         <select name="departamento" id="departamento" class="noselecttwo form-control{{ $errors->has('deliveryAreas') ? ' is-invalid' : '' }}" >
            <option  value="0">Selecionar Departamento</option>
             <option>Entregas</option>
                <option>Trocas e DevoluÃ§Ãµes</option>
                <option>Financeiro</option>
                <option>ServiÃ§os</option>
                <option>Outros</option>
          </select>

             </label>
        <label>
            Prioridade
         <select name="prioridade" id="prioridade" class="noselecttwo form-control{{ $errors->has('deliveryAreas') ? ' is-invalid' : '' }}" >
            <option  value="0">Selecionar Prioridade</option>
                <option value="0">Normal</option>
                <option value="1">MÃ©dia</option>
                <option value="2">Urgente</option>
          </select>

        </label>

        <input type="hidden" name="id"  placeholder="Assunto" id="id" value="{{$restorant->id}}">

        <label>
            <input type="text" name="assunto" class="form-control" placeholder="Assunto" id="jsTopicTicket">
        </label>
        <textarea id="sendTicketTxtArea" name="mensagem" required></textarea>
        <label>
            Imagens:
            <input type="file" accept="image/*" name="imagens[]" multiple>
        </label>
       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </form>
    <br><br>
    
</div>
      </div>
      
    </div>
  </div>
</div>

 






