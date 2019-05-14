<?php 
if(isset($_SESSION['nombre']) && isset($_SESSION['tipo'])){
  if(isset($_POST['name_ticket']) && isset($_POST['email_ticket'])){
    /*Este codigo nos servira para generar un numero diferente para cada ticket*/
    $codigo = ""; 
    $longitud = 2; 
    for ($i=1; $i<=$longitud; $i++){ 
      $numero = rand(0,9); 
      $codigo .= $numero; 
    } 
    $num=Mysql::consulta("SELECT * FROM ticket");
    $numero_filas = mysqli_num_rows($num);

    $numero_filas_total=$numero_filas+1;
    $id_ticket="TK".$codigo."N".$numero_filas_total;
    /*Fin codigo numero de ticket*/
    $nombre_ticket=  MysqlQuery::RequestPost('name_ticket');
    $email_ticket= MysqlQuery::RequestPost('email_ticket');
    $departamento_ticket= MysqlQuery::RequestPost('documentType');
    $asunto_ticket= MysqlQuery::RequestPost('asunto_ticket');
    $mensaje_ticket=  MysqlQuery::RequestPost('mensaje_ticket');
    $anexo_ticket=  MysqlQuery::RequestPost('Anexo_ticket');
    $estado_ticket="Pendiente";
    $cabecera="From: Master Manager <MasterManager@hifenix.com>";
    $mensaje_mail="Su solicitud fue creada con exito!. Su ID ticket es: ".$id_ticket;
    $mensaje_mail=wordwrap($mensaje_mail, 70, "\r\n");
    if(MysqlQuery::Guardar("ticket", "nombre_usuario, email_usuario, documentType, asunto, anexo, mensaje, estado_ticket, serie", "'$nombre_ticket', '$email_ticket', '$departamento_ticket', '$asunto_ticket', '$anexo_ticket', '$mensaje_ticket', '$estado_ticket','$id_ticket'")){
      //----------  Enviar correo con los datos del ticket
      if(mail($email_ticket, $asunto_ticket, $mensaje_mail, $cabecera)){
        echo 'enviado';
      }else{
        echo 'error';
      }
      echo '
        <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="text-center">TICKET CREADO</h4>
          <p class="text-center">
            Ticket creado con exito '.$_SESSION['nombre'].'<br>El TICKET ID es: <strong>'.$id_ticket.'</strong>
          </p>
        </div>
      ';
    }else{
      echo '
        <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="text-center">OCURRIÓ UN ERROR</h4>
          <p class="text-center">
            No hemos podido crear el ticket. Por favor intente nuevamente.
          </p>
        </div>
      ';
    }
  }
?>
  <div class="container">
    <div class="row well">
      <div class="col-sm-3">
        <img src="img/ticket.png" class="img-responsive" alt="Image">
      </div>
      <div class="col-sm-9 lead">
        <h2 class="text-info">¿Cómo crear una nueva Solicitud?</h2>
        <p>Para abrir una nueva solicitud deberá de llenar todos los campos de el siguiente formulario. Usted podra verificar el estado de su solicitud mediante el <strong>Ticket ID</strong> que se le proporcionara a usted cuando llene y nos envie el siguiente formulario.</p>
      </div>
    </div><!--fin row 1-->
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title text-center"><strong><i class="fa fa-ticket"></i>&nbsp;&nbsp;&nbsp;Solicitud</strong></h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-4 text-center">
                <br><br><br>
                <img src="img/write_email.png" alt=""><br><br>
                <p class="text-primary text-justify">Por favor llene todos los datos de este formulario para abrir su solicitud. El <strong>Ticket ID</strong> será enviado a la dirección de correo electronico proporcionada en este formulario.</p>
              </div>
              <div class="col-sm-8">
                <form class="form-horizontal" role="form" action="" method="POST">
                  <fieldset>
                  <div class="form-group">
                    <label  class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                      <div class='input-group'>
                        <input type="text" class="form-control" placeholder="Nombre" required="" pattern="[a-zA-Z ]{1,30}" name="name_ticket" title="Nombre Apellido">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <div class='input-group'>
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email_ticket" required="" title="Ejemplo@dominio.com">
                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                      </div> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-sm-2 control-label">Tipo de Documento</label>
                    <div class="col-sm-10">
                      <div class='input-group' id="documentType">
                        <script>
                          $(document).ready(function(){
                            $('#documentType').html('');
                            var request = new XMLHttpRequest();
                            request.responseType = 'json';
                            request.open('GET',"./json/crearsolicitud.json");
                            request.send();
                            request.onload = function(){
                              var select = document.createElement("select");
                              select.className = "form-control";
                              select.name = "documentType";
                              for(let i=0; i<request.response.documentTipe.length; i++){
                                var option = document.createElement("option");
                                var text = document.createTextNode(request.response.documentTipe[i]);
                                option.value = request.response.documentTipe[i];
                                option.appendChild(text);
                                select.appendChild(option);
                              }
                              document.getElementById("documentType").appendChild(select);
                              var span = document.createElement("span");
                              var i = document.createElement("i");
                              span.className = "input-group-addon";
                              i.className = "fa fa-users";
                              span.appendChild(i);
                              document.getElementById("documentType").appendChild(span);
                            }
                          })
                        </script>
                      </div> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-sm-2 control-label">Asunto</label>
                    <div class="col-sm-10">
                      <div class='input-group'>
                        <input type="text" class="form-control" placeholder="Asunto" name="asunto_ticket" required="">
                        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
                      </div> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-sm-2 control-label">Anexo</label>
                    <div class="col-sm-10">
                      <div class='input-group'>
                        <input type="text" class="form-control" placeholder="Anexo" name="Anexo_ticket" required="">
                        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
                      </div> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-sm-2 control-label">Descripción</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="3" placeholder="Escriba una breve descripción" name="mensaje_ticket" required=""></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-info"  disable>Enviar</button>
                    </div>
                  </div>
                  </fieldset> 
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
}else{
?>
  <div class="container">
    <div class="row">
        <div class="col-sm-4">
          <img src="./img/Stop.png" alt="Image" class="img-responsive"/>
        </div>
        <div class="col-sm-7 text-center">
          <h1 class="text-danger">Lo sentimos esta página es solamente para usuarios registrados en Master Manager</h1>
          <h3 class="text-info">Inicia sesión para poder acceder</h3>
        </div>
        <div class="col-sm-1">&nbsp;</div>
    </div>
  </div>
<?php
}
?>
<script type="text/javascript">
  $(document).ready(function(){
      $("#fechainput").datepicker();
  });
</script>