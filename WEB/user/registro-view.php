<?php
  if(isset($_POST['user_reg']) && isset($_POST['clave_reg']) && isset($_POST['nom_complete_reg'])){
    $nombre_reg=MysqlQuery::RequestPost('nom_complete_reg');
    $user_reg=MysqlQuery::RequestPost('user_reg');
    $identificacion_reg=MysqlQuery::RequestPost('inputIdentificacion_reg');
    $sexto_reg=MysqlQuery::RequestPost('sexoType');
    $clave_reg=md5(MysqlQuery::RequestPost('clave_reg'));
    $clave_reg2=MysqlQuery::RequestPost('clave_reg');
    $email_reg=MysqlQuery::RequestPost('email_reg');
    $telefono_reg=MysqlQuery::RequestPost('telefono_reg');

    $asunto="Registro de cuenta en Master Manager";
    $cabecera="From: Master Manager <Master Manager@hifenix.com>";
    $mensaje_mail="Hola ".$nombre_reg.", Gracias por registrarte en Master Manager. Los datos de cuenta son los siguientes:\nNombre Completo: ".$nombre_reg."\nNombre de usuario: ".$user_reg."\nClave: ".$clave_reg2."\nEmail: ".$email_reg."\n Página principal: http://www.MasterManager.com/index.php";
    
    if(MysqlQuery::Guardar("usuario", "nombre_completo, nombre_usuario, identificacion_usuario, sexo_usuario, telefono_usuario, email_usuario, clave", "'$nombre_reg', '$user_reg', '$identificacion_reg', '$sexto_reg', '$telefono_reg', '$email_reg', '$clave_reg'")){
      /*----------  Enviar correo con los datos de la cuenta */
          mail($email_reg, $asunto, $mensaje_mail, $cabecera);
      //----------*/
      echo '
        <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="text-center">REGISTRO EXITOSO</h4>
          <p class="text-center">
            Cuenta creada exitosamente, ahora puedes iniciar sesión, ya eres usuario de Master Manager.
          </p>
        </div>
      ';
    }else{
      echo '
        <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="text-center">OCURRIÓ UN ERROR</h4>
          <p class="text-center">
            ERROR AL REGISTRARSE: Por favor intente nuevamente.
          </p>
        </div>
      ';
    }
  }
?>
<div class="container">
  <div class="row">
    <div class="col-sm-8">
      <div class="panel panel-success">
        <div class="panel-heading text-center"><strong>Para poder registrarte debes de llenar todos los campos de este formulario</strong></div>
        <div class="panel-body">
          <form role="form" action="" method="POST">
            <div class="form-group">
              <label><i class="fa fa-male"></i>&nbsp;Nombre completo</label>
              <input type="text" class="form-control" name="nom_complete_reg" placeholder="Nombre completo" required="" pattern="[a-zA-Z ]{1,40}" title="Nombre Apellido" maxlength="40">
            </div>
            <div class="form-group has-success has-feedback">
              <label class="control-label"><i class="fa fa-user"></i>&nbsp;Nombre de usuario</label>
              <input type="text" id="input_user" class="form-control" name="user_reg" placeholder="Nombre de usuario" required="" pattern="[a-zA-Z0-9]{1,15}" title="Maximo 15 caracteres" maxlength="20">
              <div id="com_form"></div>
            </div>
            <div class="form-group">
              <label><i class="fa fa-id-card"></i>&nbsp;Cédula de Identidad</label>
              <input type="text" class="form-control" id="ident" name="inputIdentificacion_reg" placeholder="Identificación" required="" pattern="[0-9-]{1,13}" oninput="onActionPress()" title="ejemplo: 000-0000000-0" maxlength="13">
              <script>
                var cont = 2;
                function onActionPress(){
                  if($('#ident').val().length>cont&&$('#ident').val().length<12){
                    $('#ident').val($('#ident').val()+'-');
                    cont = 10;
                  }
                  if($('#ident').val().length<2){
                    cont = 2;
                  }
                  if($('#ident').val().length===13){
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'bottom-start',
                      showConfirmButton: false,
                      timer: 3000
                    });
                    if(!validateCedula(deleteGion($('#ident').val()))){
                      Toast.fire({
                        type: 'error',
                        title: 'Cédula Inválida!'
                      });
                      $('#ident').val('');
                    }else{
                      Toast.fire({
                        type: 'success',
                        title: 'Cédula Válida'
                      });
                    }
                  }
                }
                function deleteGion(value){
                  var acum="";
                  for(let i=0; i<value.length; i++){
                    if(value.charAt(i)!='-'){
                      acum += value.charAt(i);
                    }
                  }
                  return acum;
                }
                function validateCedula(cedula){
                  var total = new Array(10);
                  var Total = 0;
                  var cont = 1;
                  for(let i=0; i<total.length; i++){
                      if(cont === 1){
                          total[i] = parseInt(cedula.charAt(i)) * cont;
                          cont=2;
                      }else{
                          total[i] = parseInt(cedula.charAt(i)) * cont;
                          cont=1;
                      }
                  }
                  for(let i=0; i<total.length; i++){
                      if(total[i].toString().length === 2){
                          total[i] = parseInt(total[i].toString().charAt(0)) + parseInt(total[i].toString().charAt(1));
                      }
                      Total += parseInt(total[i]);
                  }
                  Total *= 9;
                  return validate(Total, cedula);
                }

                function validate(sumatoria, cedula){
                    var cant = parseInt(cedula.toString().charAt(cedula.length - 1));
                    if(parseInt(sumatoria.toString().charAt(sumatoria.toString().length - 1)) == cant){
                        return true;
                    }else{
                        return false;
                    }
                }
              </script>
            </div>
            <div class="form-group">
              <label><i class="fa fa-key"></i>&nbsp;Contraseña</label>
              <input type="password" class="form-control" name="clave_reg" placeholder="Contraseña" required="">
            </div>
            <div class="form-group">
              <label><i class="fa fa-envelope"></i>&nbsp;Email</label>
              <input type="email" class="form-control"  name="email_reg"  placeholder="Escriba su email" required="">
            </div>
            <div class="form-group">
              <label><i class="fa fa-phone"></i>&nbsp;Teléfono</label>
              <input type="text" class="form-control"  name="telefono_reg"  placeholder="Escriba su número teléfonico" required="">
            </div>
            <div class="form-group">
              <label><i class="fa fa-venus-mars"></i>&nbsp;Sexo</label>
              <br>
              <div id="sexoType">
              <script>
                $(document).ready(function(){
                  $('#sexoType').html('');
                  var request = new XMLHttpRequest();
                  request.responseType = 'json';
                  request.open('GET',"./json/sexoType.json");
                  request.send();
                  request.onload = function(){
                    var select = document.createElement("select");
                    select.className = "form-control";
                    select.name = "sexoType";
                    for(let i=0; i<request.response.sexoType.length; i++){
                      var option = document.createElement("option");
                      var text = document.createTextNode(request.response.sexoType[i]);
                      option.value = request.response.sexoType[i];
                      option.appendChild(text);
                      select.appendChild(option);
                    }
                    document.getElementById("sexoType").appendChild(select);
                  }
                })
              </script>
              </div>
            </div>
            <button type="submit" class="btn btn-danger">Crear cuenta</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-sm-4 text-center hidden-xs">
      <img src="img/users.png" style="width: 80%;margin-left:20%;" class="img-responsive" alt="Image">
      <h2 class="text-primary">Creación de Usuarios</h2>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
      $("#input_user").keyup(function(){
          $.ajax({
            url:"./process/val.php?id="+$(this).val(),
            success:function(data){
              $("#com_form").html(data);
            }
          });
      });
  });
</script>