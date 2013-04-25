// JavaScript Document
$(document).ready(function(){    
// Ajax loader
   $('#loading').ajaxStart(function(){
  	$('html').addClass('busy');
  	$(this).fadeIn(500);
   });
  
   $('#loading').ajaxStop(function(){
  	$('html').removeClass('busy');
  	$(this).fadeOut(500);
   });
   
// RealTime Clock
   /* Action 1: general
      Action 2: por oportunidad
      Action 3: por campaña */

   var url = window.location.pathname;
   var filename = url.substring(url.lastIndexOf('/')+1);
   var id_rt = $('#id_rt').val();
   
   switch(filename){
   case 'accounts.php':
   case 'analytics.php':
   case 'banners.php':
   case 'campaigns.php':
   case 'conversions.php':
   case 'create.php':
   case 'dashboard.php':
   case 'enviroment.php':
   case 'home.php':
   case 'networks.php':
   case 'operative.php':
   case 'publisher.php':
   case 'publishers.php':     
   case 'segmentation.php':
   case 'upload.php':
    setInterval('getRealTime(\'1\', \'null\', \'300\', \'2\')', 1000);
   break;
   
   case 'opportunities.php':
    setInterval('getRealTime(\'2\', ' + id_rt + ', \'300\', \'2\')', 1000);
   break;
    
   case 'campaign.php':
    setInterval('getRealTime(\'3\', ' + id_rt + ', \'300\', \'2\')', 1000);
   break;
    
   default:break;      
   }

// Autoenter
   $('#email').keypress(function(e){
    if(e.which == '13') {
      getLogin(2);
    }
   });

   $('#password').keypress(function(e){
    if(e.which == '13') {
      getLogin(2);
    }
   });
   
   $('#search-cp').keypress(function(e){
    if(e.which == '13') {
      searchCampaign();
    }
   });
   
// Datepicker
	 $(".date-box").datetimepicker({
    showSecond: false,
		timeFormat: 'hh:mm:ss',
		dateFormat: 'yy-mm-dd'
   });
   
// Datepicker sin hora
   var f = new Date();
   var date = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + (f.getDate() - 1);
   $(".date-box-o").datepicker({dateFormat: 'yy-mm-dd', maxDate: date});
   
   var date = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate();
   $(".date-box-n").datepicker({dateFormat: 'yy-mm-dd', minDate: date});
   
   var date = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate();
   $(".date-box-t").datepicker({dateFormat: 'yy-mm-dd', maxDate: date});

// Modal
	//select all the a tag with name equal to modal
	$('a[name=modal]').click(function(e){
		//Cancel the link behavior
		e.preventDefault();
		
		//Get the A tag
		var id = $(this).attr('href');
		var content = $(this).attr('id');
		var tipo = explode('_', content);
    
    $('html, body').animate({scrollTop:0}, 'slow');
    
		switch(tipo[0]){
    case 'getChangeLog':
      getChangeLog(tipo[1], tipo[2]);
    break;
        
    default:break;
    }

		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$("#mask").fadeTo(25, 0.5);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);

		//transition effect
		$(id).fadeIn(25);  
	});
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});
          	
}); // Cierro el ready