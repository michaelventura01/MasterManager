$(document).ready(function(){
    for(let i=0; i<11; i++){
        if(i===0){
            $("#completar").hide();
        }else{
            $("#completar"+i).hide();
        }
    }
    $("#button").click(function(){
        if($("#txtCargo, #txtNombre, #txtIdentificacion, #txtRol, #txtNombre").val().length === 0){
            $("#completar").show();
        }else{
            $("#completar").hide();
        }
        if($("#txtEstado").val().length === 0){
            $("#completar1").show();
        }else{
            $("#completar1").hide();
        }
        if($("#txtCargo, #txtNombre, #txtIdentificacion, #txtRol, #txtNombre").val().length > 0 && $("#txtEstado").val().length > 0){
            //Acción a realizar cuando todos los campos esten llenos

            /*///////////////////////////////////////////////////////*/
        }else{
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
              
            Toast.fire({
                type: 'warning',
                title: 'Complete Todos los Campos.'
            });
        }
        return false;
    });
    $("#button-form").click(function(){
        if($("#txtNombre").val().length == 0){
            $("#completar").show();
        }else{
            $("#completar").hide();
        }
        if($("#txtCodigoFacultad").val().length == 0){
            $("#completar1").show();
        }else{
            $("#completar1").hide();
        }
        if($("#txtEmail").val().length == 0){
            $("#completar2").show();
        }else{
            $("#completar2").hide();
        }
        if($("#txtEstado").val().length == 0){
            $("#completar3").show();
        }else{
            $("#completar3").hide();
        }
        if($("#txtDireccion").val().length == 0){
            $("#completar4").show();
        }else{
            $("#completar4").hide();
        }
        if($("#txtTelefono").val().length == 0){
            $("#completar5").show();
        }else{
            $("#completar5").hide();
        }
        if($("#txtEnlaceFoto").val().length == 0){
            $("#completar6").show();
        }else{
            $("#completar6").hide();
        }
        if($("#txtCodigoEmpleado").val().length == 0){
            $("#completar7").show();
        }else{
            $("#completar7").hide();
        }
        if($("#txtArea").val().length == 0){
            $("#completar8").show();
        }else{
            $("#completar8").hide();
        }
        if($("#txtCargo").val().length == 0){
            $("#completar9").show();
        }else{
            $("#completar9").hide();
        }
        if($("#txtIdArea").val().length == 0){
            $("#completar10").show();
        }else{
            $("#completar10").hide();
        }

        if($("#txtNombre").val().length > 0 && $("#txtCodigoFacultad").val().length > 0 && $("#txtEmail").val().length > 0 && $("#txtEstado").val().length > 0 && $("#txtDireccion").val().length > 0 && $("#txtTelefono").val().length > 0 &&$("#txtEnlaceFoto").val().length > 0 && $("#txtCodigoEmpleado").val().length > 0 && $("#txtArea").val().length > 0 && $("#txtCargo").val().length > 0 && $("#txtIdArea").val().length > 0){
            //Acción a realizar cuando todos los campos esten llenos

            /*///////////////////////////////////////////////////////*/
        }else{
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
              
            Toast.fire({
                type: 'warning',
                title: 'Complete Todos los Campos.'
            });
        }

        return false;
    });
});