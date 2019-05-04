var elementos = [];
var estado = "guardar";

function updateModal(id){
    estado = "actualizar";
    $('#modalform').css('display','block');
    $('#name').val(elementos[id].name);
    $('#last').val(elementos[id].lastname);
    $('#identity').val(elementos[id].document); 
    $('#descrip').val(elementos[id].description);
}

function eliminar(id){
    
    elementos.splice(id,1);
    mostrarTabla();
}

function mostrarTabla(){ 
    var filas = "";   
    $('.control').remove();
    for(var c = 0; c<elementos.length; c++){
        fila = 
            '<tr class="control">'+
                '<td>'+(c+1)+'</td>'+
                '<td>'+elementos[c].name+'</td>'+
                '<td>'+elementos[c].lastname+'</td>'+
                '<td>'+elementos[c].document+'</td>'+
                '<td>'+elementos[c].description+'</td>'+
                '<td><button type="button" id='+c+' onclick="updateModal(this.id)" class="update" >✎</button> | <button type="button" id='+c+' onclick="eliminar(this.id)" class="delete" >✖</button></td>'+
            '</tr>';
        filas+=fila;
    }
    $("#tbcontenido").append(filas);    
}

$(document).ready(function(){
    


    $('#addbtn').click(function(){
        estado = "guardar";
        $('#modalform').css('display','block');
    });

    function cerrarModal(){
        $('#modalform').css('display','none');
    }
    $('#close').click(function(){
        cerrarModal();
    });
    
    window.onclick = function(event) {
        if (event.target == $('#modalform')) {
            modal.style.display = "none";
        }
    }

    $('#closebtn').click(function(){
        cerrarModal();
    });

    $("#searchtxt").keyup(function(){
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($("#tbcontenido tbody tr"), function() {
        if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
        $(this).hide();
        else
        $(this).show();
        });
    });

    $('#clean').click(function(){
        $("#searchtxt").val('');
        mostrarTabla();
    });

    function almacen(nombre, apellido, identidad, descripcion){
        
        let medio = {name:nombre, lastname:apellido, document:identidad, description:descripcion };
        elementos.push(medio);
        JSON.stringify(elementos);
        cerrarModal();
        mostrarTabla();
    }


    function update(id,nombre, apellido, identidad, descripcion){
        elementos[id].name = nombre;
        elementos[id].lastname = apellido;
        elementos[id].document = identidad;
        elementos[id].description = descripcion;
        JSON.stringify(elementos);
        mostrarTabla();
    }


    $('#btnguardar').click(function(){
        
        if($('#name').val()!="" && $('#last').val()!="" && $('#identity').val()!=""&& $('#descrip').val()!=""){
            
            if(estado = "guardar"){
                almacen($('#name').val(), $('#last').val(), $('#identity').val(), $('#descrip').val());
            }else if(estado = "actualizar"){
                update(id,$('#name').val(), $('#last').val(), $('#identity').val(), $('#descrip').val());
            }
            $('#name').val("");
            $('#last').val("");
            $('#identity').val(""); 
            $('#descrip').val("");
            $('#name').css('background-color','white');
            $('#last').css('background-color','white');
            $('#identity').css('background-color','white');
            $('#descrip').css('background-color','white');
        }else{
            if($('#name').val()==""){
                $('#name').css('background-color','red');
                $('#name').keyup(function(){$('#name').css('background-color','white')});
            }
            if($('#last').val()==""){
                $('#last').css('background-color','red');
                $('#last').keyup(function(){$('#name').css('background-color','white')});
            }
            if($('#identity').val()==""){
                $('#identity').css('background-color','red');
                $('#identity').keyup(function(){$('#name').css('background-color','white')});
            }
            if($('#descrip').val()==""){
                $('#descrip').css('background-color','red');
                $('#descrip').keyup(function(){$('#name').css('background-color','white')});

            } 
        }
    });
})




