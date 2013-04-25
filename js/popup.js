function mostrarPop(clase,texto) {
	$("#pop").removeClass();
	$("#pop").addClass(clase);
	$("#pop").html(texto);
	$("#pop").fadeIn();
} //checkHover

$(document).ready(function (){
   //Esconder el popup
   $("#pop").hide();
   
   //Consigue valores de la ventana del navegador
   var w = $(this).width();
   var h = $(this).height();
   
   //Centra el popup   
   w = (w/2)-240;
   h = (h/2)-240;
   $("#pop").css("left",w + "px");
   $("#pop").css("top",h + "px");
    

   //Función para cerrar el popup
   $("#pop").click(function (){
      $(this).fadeOut();
   });
   
   
});