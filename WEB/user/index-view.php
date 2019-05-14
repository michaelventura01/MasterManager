<!--************ Imagen que reemplaza el carousel para dispositivos moviles ********-->
<div id="img-linux-tux" class="container hidden-lg hidden-md hidden-sm">
    <center><img src="img/slide-header.jpg" class="img-responsive img-rounded" alt="Image"></center>
</div>
<!--************************************Carousel******************************-->
<div class="no-padding col-lg-12  col-md-12 col-sm-12 col-xs-12">
    <div id="carousel-example-generic" class="carousel slide">
        <ol class="carousel-indicators" id="carousel02"></ol>
        <div class="carousel-inner" id="carousel45"></div>
        <script>
            $(document).ready(function(){
                function createMenu(option){
                    //$('#carousel-example-generic').html("");
                    for(let i=0; i<option.sliderName.length; i++){
                        var li = document.createElement("li");
                        li.target = "#carousel-example-generic";
                        if(i==0){
                            li.className = "active";
                        }
                        document.getElementById("carousel02").appendChild(li);
                    }
                    for(let i=0; i<option.sliderName.length; i++){
                        var div = document.createElement("div");
                        var img = document.createElement("img");
                        var div1 = document.createElement("div");
                        var text = document.createTextNode(option.sliderName[i]);
                        div.appendChild(text);
                        //alert("img/Slider/uasd" + i.toString() + ".jpg");
                        div.className = "carousel-caption";
                        if(i===0){
                            div1.className = "item active";
                        }else{
                            div1.className = "item";
                        }
                        img.src = "img/Slider/uasd" + i.toString() + ".jpg";
                        div1.appendChild(img);
                        div1.appendChild(div);
                        document.getElementById("carousel45").appendChild(div1);
                    }
                }
                var request = new XMLHttpRequest();
                request.responseType = 'json';
                request.open('GET',"./json/menu.json");
                request.send();
                request.onload = function(){
                    createMenu(request.response);
                }
            })
        </script>
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </div>
</div>
<div class="col-sm-2">&nbsp;</div>
<!--************************************ Fin Carousel******************************-->
<hr class="hidden-xs">

<div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="text-center text-info">Documentación</h1>
    </div>
  </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 thumbnail">
            <h3 class="text-center">Introducción</h3>
            <img  src="img/logoMint.png" class="img-responsive logos_GnuLinux" alt="Image">
                <p>
                    Linux Mint es una distribución del sistema operativo GNU/Linux, basado en la distribución 
                    Ubuntu (que a su vez está basada en Debian). A partir del 7 de septiembre de 2010 también 
                    está disponible una edición basada en Debian.<br>
                    Linux Mint mantiene un inventario actualizado, un sistema operativo estable para el usuario medio, 
                    con un fuerte énfasis en la usabilidad y facilidad de instalación. Es reconocido por ser fácil de usar, 
                    especialmente para los usuarios sin experiencia previa en Linux.<br>
                    Linux Mint se compone de muchos paquetes de software, los cuales se distribuyen la mayor parte bajo una 
                    licencia de software libre. La principal licencia utilizada es la GNU General Public License (GNU GPL) que, 
                    junto con la GNU Lesser General Public License (GNU LGPL), declara explícitamente que los usuarios tienen libertad 
                    para ejecutar, copiar, distribuir, estudiar, cambiar, desarrollar y mejorar el software.
                </p>
                <p class="text-center">
                    <a href="#" class="btn btn-primary btn-sm" role="button">Leer más</a>
                </p>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#carousel-example-generic").carousel({
            interval: 4000,
        });
    });
</script>