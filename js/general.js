// Root al archivo utils.php
   if(location.host == 'localhost'){
   var domain = 'http://' + location.host + '/startmeapp/adserver/includes/utils.php';
   var root = 'http://' + location.host + '/startmeapp/adserver/'; 
   }else{
   var domain = 'http://' + location.host + '/includes/utils.php';
   var root = 'http://' + location.host + '/'; 
   }
   
   /////////////////////////////////////////////////
   // FUNCIONES
   /////////////////////////////////////////////////
// Función para altas/bajas/modificaciones de adtext
   function abmAdText(action, id){
   if(action == 1){
   var title = $('#up-adtxt-title_' + id).val();      
   var description = $('#up-adtxt-description_' + id).val();
   var url = $('#up-adtxt-url_' + id).val();
   
   /* Validaciones */
	 if(empty(title)){
	 translate(2, 'INGRESARTITULO');
      return false;   
   }
   
	 if(empty(description)){
	 translate(2, 'INGRESARDESCRIPCION');
      return false;   
   }

	 if(empty(url)){
	 translate(2, 'INGRESARURL');
      return false;   
   }   
   }
   
// Cargar   
   if(action == 1){                         
   $.post(domain, {'function':'abmAdText', action:action, id_adtext:null, title:title, description:description, url:url, id_campaign:id}, function(data, textStatus){
     if(data){
      $.post(domain, {'function':'getAdText', id_adtext:data}, function(data, textStatus){
        if(data){
         $('#adtext_' + id).append(data);
         $('#up-adtxt-title_' + id).val('');      
         $('#up-adtxt-description_' + id).val('');
         $('#up-adtxt-url_' + id).val('');         
        }
      });     
     } 
   });
   }
   
// Eliminar
   if(action == 3){
   var msg = 'Sure to delete adtext?';
   var r = confirm(msg);
   if(r==true){
   $.post(domain, {'function':'abmAdText', action:action, id_adtext:id, title:null, description:null, url:null, id_campaign:null}, function(data, textStatus){
     if(data){
      $('#adtext_' + id).css('display', 'none');
     }      
   });
   }
   }
   }

// Función para altas/bajas/modificaciones de banners
   function abmBanners(action, id){
   if(action == 1){      
	 var fileToUpload = $('#up-banner_' + id).val();
	 var extension = (fileToUpload.substring(fileToUpload.lastIndexOf('.'))).toLowerCase();
      
   /* Validaciones */
   if(empty(fileToUpload)){
	 translate(2, 'SELECCIONARARCHIVO');
      return false;
   }
 
	 if(!empty(fileToUpload)){	 
	  if(extension != '.jpg' ^ extension != '.gif' ^ extension != '.png'){
	  translate(2, 'EXTENSIONESPERMITIDAS');
       return false;
    }
   } 
   
// Cargar                          
   $.post(domain, {'function':'abmBanners', action:action, id_banner:null, id_campaign:id, id_banner_size:0, extension:extension}, function(data, textStatus){     
     if(data){      
      $.ajaxFileUpload({
				url:'includes/ajaxfileupload.php',
				secureuri:false,
				fileElementId:'up-banner_' + id,
				dataType:'JSON',
				data:{id_campaign:id, id_campaign_banner:data},
				success: function (data, status){
					if(!empty(typeof(data.error))){
						if(!empty(data.error)){
							alert(data.error);
						}else{
						  var msg = explode("'", data);
						  var msg = explode("^", msg[3]);
              var file = msg[0];
              var id_banner = msg[1];

              $.post(domain, {'function':'setBanner', file:file, id_banner:id_banner}, function(data, textStatus){
               if(data){
                 $.post(domain, {'function':'getBanner', id_banner:data}, function(data, textStatus){
                  if(data){
                   $('#banners_' + id).append(data);
                   $('#up-banner_' + id).val('');               
                  }
                 });                               
               }else{
                translate(2, 'ERRORTAMANIO');
               } 
              });
                          
            }
					}
				},
				error: function (data, status, e){
					alert(e);
				}
			 }
		  )         
     }      
   });
   }
   
// Eliminar
   if(action == 3){
   var msg = 'Sure to delete banner?';
   var id_campaign = $('#id_campaign_' + id).val();
   var id_banner_size = $('#id_banner_size_' + id).val();
   var extension = $('#extension_' + id).val();
   var r = confirm(msg);
   
   if(r==true){
   $.post(domain, {'function':'abmBanners', action:action, id_banner:id, id_campaign:id_campaign, id_banner_size:id_banner_size, extension:extension}, function(data, textStatus){
     if(data){
      $('#banner_' + id).css('display', 'none');
     }      
   });
   }
   }
   }
      
// Función para altas/bajas/modificaciones de campañas
   function abmCampaigns(action, id_campaign){
   if(action == 1){
   var id_opp = $('#opps').val();
   var id_user = $('#id_user').val();      
   var id_cat_product = $('#up-type-prod').val();
   var up_cat_prod1 = $('#up-cat-prod1').val();
   var up_cat_prod2 = $('#up-cat-prod2').val();
   if(!empty(up_cat_prod2)){
   var id_cat_theme = $('#up-cat-prod2').val();
   }else{
   var id_cat_theme = $('#up-cat-prod1').val();
   }
   var model_rate = $('#up-model-prod').val();
   var cpa = $('#up-value-prod').val();
   var urls = $('#up-urls').val();
   }
   
   if(action == 2){
   var name = $('#up-name_' + id_campaign).val();
   var description = $('#up-description_' + id_campaign).val();
   var up_cat_prod1 = $('#up-cat-prod1_' + id_campaign).val();
   var up_cat_prod2 = $('#up-cat-prod2_' + id_campaign).val();
   if(!empty(up_cat_prod2)){
   var id_cat_theme = $('#up-cat-prod2_' + id_campaign).val();
   }else{
   var id_cat_theme = $('#up-cat-prod1_' + id_campaign).val();
   }
   var enviroment = $('input[name="up-enviroment_' + id_campaign + '"]:checked').val();
   }
   
   /* Validaciones */
   if(action == 1){
	 if(empty(urls)){
	 translate(2, 'URLSPEECH');
      return false;   
   }
   }

   if(action == 2){
	 if(empty(name)){
	 translate(2, 'INGRESARNOMBRE');
      return false;   
   }

	 if(empty(description)){
	 translate(2, 'INGRESARDESCRIPCION');
      return false;   
   }
   
	 if(empty(id_cat_theme)){
	 translate(2, 'SELECCIONARCATEGORIA');
      return false;   
   }   
   }
   
// Cargar   
   if(action == 1){                         
   $.post(domain, {'function':'abmCampaigns', action:action, id_opp:id_opp, id_user:id_user, id_cat_product:id_cat_product, id_cat_theme:id_cat_theme, model_rate:model_rate, cpa:cpa, urls:urls, campaigns:null, name:null, description:null, enviroment:1}, function(data, textStatus){
     if(data){
      window.location = root + 'enviroment.php?campaigns=' + data;     
     } 
   });
   }

// Editar   
   if(action == 2){                        
   $.post(domain, {'function':'abmCampaigns', action:action, id_opp:null, id_user:null, id_cat_product:null, id_cat_theme:id_cat_theme, model_rate:null, cpa:null, urls:null, campaigns:id_campaign, name:name, description:description, enviroment:enviroment}, function(data, textStatus){
     if(data){
      translate(2, 'CAMPANIAACTUALIZADA');
      $('#cp_validation_' + id_campaign).removeClass('cp_validation');     
     } 
   });
   }
   
// Eliminar simple
   if(action == 3){
   var msg = 'Sure to delete campaign ' + id_campaign + '?';
   var r = confirm(msg);
   if(r==true){
   $.post(domain, {'function':'abmCampaigns', action:action, id_opp:null, id_user:null, id_cat_product:null, id_cat_theme:null, model_rate:null, cpa:null, urls:null, campaigns:id_campaign, name:null, description:null, enviroment:1}, function(data, textStatus){
     if(data){
      $('#campaign1_' + id_campaign).remove();
      $('#campaign2_' + id_campaign).remove();
      $('#campaign3_' + id_campaign).remove();
      $('#campaign4_' + id_campaign).remove();
     }      
   });
   }
   }
   
// Pasar a enviroment   
   if(action == 4){                         
   window.location = root + 'create.php';
   }
        
   }

// Función para altas/bajas/modificaciones de change log
   /* Action 1: agregar
      Action 3: eliminar
      Action 4: copiar */
   function abmChangeLog(action, id){
   if(action != 4){
   
   var date = $('#cl-date').val();
   var id_tool = $('#networks-tools').val();
   var cpc = $('#cl-cpc').val();
   var model = $('#cl-model').val();
   var rate = $('#cl-rate').val();
   var cap = $('#cl-cap').val();
   var status = $('#cl-status').val();
   var comments = $('#cl-comments').val();
   
   /* Validaciones */
   if(action == 1){
	 if(empty(date)){
	 translate(2, 'SELECCIONARFECHA');
      return false;
   }   
   
	 if(empty(id_tool)){
	 translate(2, 'SELECCIONARTOOL');
      return false;
   }
   
	 if(empty(cpc)){
	 translate(2, 'SELECCIONARCPC');
      return false;
   }

	 if(!checkFloat(cpc)){
	 translate(2, 'SOLONUMEROS');
      return false;
   }
      
	 if(empty(model)){
	 translate(2, 'SELECCIONARMODELO');
      return false;
   }
   
	 if(empty(rate)){
	 translate(2, 'SELECCIONARRATE');
      return false;
   }

	 if(!checkFloat(rate)){
	 translate(2, 'SOLONUMEROS');
      return false;
   }
      
	 if(empty(cap)){
	 translate(2, 'SELECCIONARCAP');
      return false;
   }

	 if(!checkFloat(cap)){
	 translate(2, 'SOLONUMEROS');
      return false;
   }
      
	 if(empty(status)){
	 translate(2, 'SELECCIONARESTADO');
      return false;
   }
   }

// Agregar
   if(action == 1){
   $.post(domain, {'function':'abmChangeLog', action:action, id:id, id_tool:id_tool, cpc:cpc, cap:cap, model:model, rate:rate, status:status, comments:comments, date:date}, function(data, textStatus){
     if(data){
      getChangeLog(1, id);
      getChangeLog(2, id);
     }else{
      translate(2, 'CHANGELOGERROR1');
     }      
   }); 
   }

// Eliminar   
   if(action == 3){
   var msg = 'Sure?';
   var r = confirm(msg);
   if(r==true){
   $.post(domain, {'function':'abmChangeLog', action:action, id:id, id_tool:null, cpc:null, cap:null, model:null, rate:null, status:null, comments:null, date:null}, function(data, textStatus){
     if(data){
      $('#clog_' + id).remove();
     }      
   });
   }
   }
   }else{
   
// Copiar
   var id_campaign = $('#id_campaign').val();
   
   $.post(domain, {'function':'abmChangeLog', action:action, id:id, id_tool:null, cpc:null, cap:null, model:null, rate:null, status:null, comments:null, date:null}, function(data, textStatus){
     if(data){
      getChangeLog(1, id_campaign);
      getChangeLog(2, id_campaign);
     }else{
      translate(2, 'CHANGELOGERROR1');
     }      
   });
   }
   }
   
// Función para altas/bajas/modificaciones de campañas (conversiones)
   function abmConversions(action, id_opp){
// Tomo la fecha y usuario
   var date = $('#date').val();
   var id_user = $('#id_user').val();

// Tomo los valores de conversiones   
   var conversions = $("input[name='conversions']").map(function(){
                       return $(this).val();
                     }).get();
                     
// Tomo los valores de campañas y redes   
   var campaigns = $("input[name='campaigns']").map(function(){
                       return $(this).val();
                     }).get();

// Tomo los valores de redes   
   var networks = $("input[name='networks']").map(function(){
                       return $(this).val();
                     }).get();
            
   $.post(domain, {'function':'abmConversions', action:action, id_opp:id_opp, campaigns:campaigns, networks:networks, conversions:conversions, date:date}, function(data, textStatus){
     if(data){
      getOppsReport(2, id_user);     
     }else{
      translate(2, 'ALTASERROR');     
     } 
   });
 
   }

// Función para modificaciones de mensajes
   function abmMessages(action, value, id_message){
   /* Enviar */
   if(action == 1){
   var id_user = $('#users-to').val();
   var message = $('#message-to').val();

   /* Validaciones */
	 if(empty(id_user)){
	 translate(2, 'SELECCIONARDESTINATARIO');
      return false;
   }   
   
	 if(empty(message)){
	 translate(2, 'INGRESARMENSAJE');
      return false;
   }

   $.post(domain, {'function':'abmMessages', action:action, value:message, id_message:id_user}, function(data, textStatus){
    if(data){
     getMessages(2);
    }
   });  
   }
   
   /* Actualizar */
   if(action == 2){
   $.post(domain, {'function':'abmMessages', action:action, value:value, id_message:id_message}, function(data, textStatus){});
   } 
   }
   
// Función para altas/bajas/modificaciones de información de publishers
   function abmPublishersInformation(action, id_publisher){
   var name = $('#pub-name').val();
   var commercial = $('#pub-commercial').val();
   var email = $('#pub-email').val();
   var phone = $('#pub-phone').val();
   var address = $('#pub-address').val();
   var zip = $('#pub-zip').val();
   var id_country = $('#pub-country-get').val();
   var taxid = $('#pub-taxid').val();
   var password = $('#pub-password').val();
   var status = $('#pub-status').val();
   
   /* Actualizar */
   if(action == 2){         
   $.post(domain, {'function':'abmPublishersInformation', action:action, id_publisher:id_publisher, name:name, commercial:commercial, email:email, phone:phone, address:address, zip:zip, id_country:id_country, taxid:taxid, password:password, status:status}, function(data, textStatus){
     if(data){
        $.post(domain, {'function':'getPublisherProfile', action:1, id_publisher:id_publisher}, function(data, textStatus){
         if(data){    
          $('#publisher').html(data);
         }
        });
     }     
   });
   }
 
   }
   
// Función para altas/bajas/modificaciones de modelos de publishers
   function abmPublishersModels(action, id){
   /* Agregar */
   if(action == 1){
   var id_country = $('#pub-country-add').val();
   var model = $('#pub-country-model').val();
   var value = $('#pub-country-value').val();

   /* Validaciones */
	 if(empty(id_country)){
	 translate(2, 'SELECCIONARPAIS');
      return false;
   }   

	 if(empty(model)){
	 translate(2, 'SELECCIONARMODELO');
      return false;
   }

   if(empty(value)){
	 translate(2, 'INGRESARVALORPUBLISHER');
      return false;
   }
             
   $.post(domain, {'function':'abmPublishersModels', action:action, id:id, id_country:id_country, model:model, value:value}, function(data, textStatus){
     if(data){
        $.post(domain, {'function':'getPublisherModels', id_publisher:id}, function(data, textStatus){
         if(data){    
          $('#countries_' + id).html(data);
         }
        });
     }     
   });
   }

   /* Eliminar */
   if(action == 3){
   var msg = 'Sure to delete country for publisher?';
   var r = confirm(msg);
   if(r==true){
   $.post(domain, {'function':'abmPublishersModels', action:action, id:id, id_country:null, model:null, value:null}, function(data, textStatus){
     if(data){
      $('#country_' + id).remove();
     }      
   });
   }
   }
 
   }

// Función para altas/bajas/modificaciones de payments de publishers
   function abmPublishersPayments(action, id_publisher){
   var beneficiary = $('#pub-beneficiary').val();
   var paypal = $('#pub-paypal').val();
   var ben_address = $('#pub-ben-add').val();
   var ben_account = $('#pub-ben-acc').val();
   var ben_bank = $('#pub-ben-bank').val();
   var ben_bank_address = $('#pub-ben-bank-add').val();
   var ben_swift = $('#pub-ben-swift').val();
   var ben_aba = $('#pub-ben-aba').val();
   var ben_intermediary = $('#pub-ben-int').val();
   
   /* Actualizar */
   if(action == 2){         
   $.post(domain, {'function':'abmPublishersPayments', action:action, id_publisher:id_publisher, beneficiary:beneficiary, paypal:paypal, ben_address:ben_address, ben_account:ben_account, ben_bank:ben_bank, ben_bank_address:ben_bank_address, ben_swift:ben_swift, ben_aba:ben_aba, ben_intermediary:ben_intermediary}, function(data, textStatus){
     if(data){
        $.post(domain, {'function':'getPublisherProfile', action:1, id_publisher:id_publisher}, function(data, textStatus){
         if(data){    
          $('#publisher').html(data);
         }
        });
     }     
   });
   }
 
   }
   
// Función para altas/bajas/modificaciones de segmentaciones
   function abmSegmentation(action, campaigns){
// Tomo los valores 
   var id_country = $('#countries').val();
   
   var carriers = document.getElementById('carriers');
    var selCarriers = [];
    for(i=0; i<carriers.length; i++){
        if(carriers.options[i].selected){
            selCarriers.push(carriers.options[i].value);
        }
   }
   
   var os = document.getElementById('os');
    var selOS = [];
    for(i=0; i<carriers.length; i++){
        if(os.options[i].selected){
            selOS.push(os.options[i].value);
        }
   }

   /* Validaciones */
   if(action == 1){
	 if(empty(id_country)){
	 translate(2, 'SELECCIONARPAIS');
      return false;
   }   
   
	 if(empty(count(selCarriers))){
	 translate(2, 'SELECCIONARCARRIER');
      return false;
   }
   
	 if(empty(count(selOS))){
	 translate(2, 'SELECCIONAROS');
      return false;
   }
   }
            
   $.post(domain, {'function':'abmSegmentation', action:action, id_country:id_country, carriers:selCarriers, os:selOS, campaigns:campaigns}, function(data, textStatus){
     if(data){
      window.location = root + 'campaigns.php';     
     } 
   });

   }
   
// Función para validar si es número
   function checkFloat(number){
    if (/^([0-9])*[.,]?[0-9]*$/.test(number))
    return true;
    else
    return false;
   }

      
// Función par acomparar si una fecha es mayor que otra
   function compare_dates(fecha, fecha2){
        var xMonth = fecha.substring(5, 7);
        var xDay = fecha.substring(8, 10);
        var xYear = fecha.substring(0, 4);
        var yMonth = fecha2.substring(5, 7);
        var yDay = fecha2.substring(8, 10);
        var yYear = fecha2.substring(0, 4);
        
        if (xYear > yYear){
            return(true)
        }else{
          if (xYear == yYear){ 
            if (xMonth > yMonth){
                return(true)
            }else{ 
              if (xMonth == yMonth){
                if (xDay > yDay)
                  return(true);
                else
                  return(false);
              }
              else
                return(false);
            }
          }else
            return(false);
        }
   } 

// Función para Copy to clipboard
   function copyToClipboard(text) {
     window.prompt ("Copy to clipboard: Ctrl+C, Enter", text);
   }

// Función para exportar a excel
   /* Action 1: reporte oportunidades y campañas
      Action 2: inventario campañas */
	 function export2Excel(){
   var date_start = $('#date-start').val();
   var date_end = $('#date-end').val();
   var id_network = $('#networks').val();
   var id_user = $('#users').val(); 
	 
   window.location = root + 'includes/export2excel.php?date_start=' + date_start + '&date_end=' + date_end + '&id_network=' + id_network + '&id_user=' + id_user;
	 }

// Función para obtener inventario de campañas por oportunidad
   function getCampaigns(action){
   var status = $('#status').val();
   var id_client = $('#clients').val();
   var id_opp = $('#opps').val();
   
   /* Validaciones */
	 if(empty(id_client)){
	 translate(2, 'SELECCIONARCLIENTE');
      return false;
   }
   
	 if(empty(id_opp)){
	 translate(2, 'SELECCIONAROPORTUNIDAD');
      return false;
   }
      
   $.post(domain, {'function':'getCampaigns', action:action, id_user:0, id_network:0, id_client:id_client, id_opp:id_opp, status:status, date_start:null, date_end:null}, function(data, textStatus){
    if(data){
      $('#inventory').html(data); 
    }     
   });
   }
   
// Función para obtener lista de oportunidades/clientes
   /* Action 1: para reporte de campañas
      Action 2: para cargar conversiones
      Action 3: para lista de campañas */
   function getCampaignsReport(action, id_user, id_opp){
   if(action == 1){
   var date_start = $('#date-start').val();
   var date_end = $('#date-end').val();
   var id_network = $('#networks').val();
   }
   if(action == 2){
   var date = $('#date').val();
   } 
   if(action == 3){
   var date_start = $('#date-start').val();
   var date_end = $('#date-end').val();
   var status = $('#status').val();
   }
      
   if(action == 1){          
   $.post(domain, {'function':'getCampaignsReport', action:1, id_user:id_user, id_opp:id_opp, id_network:id_network, date_start:date_start, date_end:date_end}, function(data, textStatus){
     if(data){
      $('.campaigns:not(#campaigns_' + id_opp + ')').slideUp(450);
      $('#campaigns_' + id_opp).html(data).toggle(500);
      }     
   });   
   }
   
   if(action == 2){
   $.post(domain, {'function':'setConversionsCampaigns', id_user:id_user, id_opp:id_opp, date:date}, function(data, textStatus){
     if(data){
      $('.campaigns:not(#campaigns_' + id_opp + ')').slideUp(450);
      $('#campaigns_' + id_opp).html(data).toggle(500);
      }     
   });     
   }
   
   if(action == 3){          
   $.post(domain, {'function':'getCampaignsInventory', action:1, id_user:id_user, id_opp:id_opp, status:status, date_start:date_start, date_end:date_end}, function(data, textStatus){
     if(data){
      $('.campaigns:not(#campaigns_' + id_opp + ')').slideUp(450);
      $('#campaigns_' + id_opp).html(data).toggle(500);
      }     
   });   
   }
   }
      
// Función para obtener change log
   /* Action 1: en pantalla campaña
      Action 2: en modal */
   function getChangeLog(action, id_campaign){
   var date_start = $('#date-start').val();
   var date_end = $('#date-end').val();

   $.post(domain, {'function':'getChangeLog', action:action, id_user:null, id_campaign:id_campaign, date_start:date_start, date_end:date_end}, function(data, textStatus){
    if(data){
      if(action == 1){
      $('#result').html(data);
      }else{
      $('#changelog').html(data);
      }
    }     
   });
   }   

// Función para obtener lista de carriers
   function getComboCarriers(){
   var id_country = $('#countries').val();
     
   $.post(domain, {'function':'getComboCarriers', id_country:id_country}, function(data, textStatus){
     if(data){
      $('#sl-carriers').html(data);
      }     
   });
   }
   
// Función para obtener lista de oportunidades
   function getComboCategories(action){
   var id_category = $('#up-cat-prod1').val();
     
   $.post(domain, {'function':'getComboCategories', action:action, id_category:id_category}, function(data, textStatus){
     if(data){
      $('#cat-prod2').html(data);
      }     
   });
   }

// Función para obtener lista de oportunidades
   function getComboCategoriesEdit(action, id_campaign){
   var id_category = $('#up-cat-prod1_' + id_campaign).val();
     
   $.post(domain, {'function':'getComboCategoriesEdit', action:action, id_category:id_category, id_campaign:id_campaign}, function(data, textStatus){
     if(data){
      $('#cat-prod2_' + id_campaign).html(data);
      }     
   });
   }
   
// Función para obtener lista de oportunidades
   function getComboOpps(action, id_opp){
   var id_client = $('#clients').val();
        
   $.post(domain, {'function':'getComboOpps', action:action, id_opp:id_opp, id_client:id_client}, function(data, textStatus){
     if(data){
      $('#up-opps').html(data);
      }     
   });
   }
      
// Función para obtener lista de oportunidades/clientes
   function getComboTools(){
   var id_network = $('#cl-networks').val();
        
   $.post(domain, {'function':'getComboNetworksTools', id_network:id_network}, function(data, textStatus){
     if(data){
      $('#cl-tools').html(data);
      }     
   });
   }

// Función para obtener lista de carriers
   function getConversionsAS(action, id){     
   var date_start = $('#date-start').val();
   var date_end = $('#date-end').val();

   $.post(domain, {'function':'getConversionsAS', action:action, id:id, date_start:date_start, date_end:date_end}, function(data, textStatus){
     if(data){
      alert('Conversions AdServer: ' + data);
     }else{
      alert('No available records');
     }     
   });
   }
   
// Función para obtener log de carga de conversiones
   function getConversionsReport(action, id_user){
   var date = $('#date-log').val();
        
   $.post(domain, {'function':'getConversionsReport', action:action, id_user:id_user, date:date}, function(data, textStatus){
    if(data){
      $('#conversions-log').html(data);
    }     
   });
   }
   
// Función para obtener forecast
   function getForecast(action, status, id_campaign){
   if(action == 1){
   var status = $('#fc-status').val();
   var contribution = cpc = cpa = cap = null;
   }else{
   var contribution = !empty($('#fc-cont').val()) ? $('#fc-cont').val() : null;
   var cpc = !empty($('#fc-cpc').val()) ? $('#fc-cpc').val() : null;
   var cpa = !empty($('#fc-cpa').val()) ? $('#fc-cpa').val() : null;
   var cap = !empty($('#fc-cap').val()) ? $('#fc-cap').val() : null;
   }

   /* Validaciones */    
   if(action == 2){
	 if(status == 1 | status == 5){
	  if(empty(contribution)){
	   translate(2, 'INGRESARCONTRIBUCION');
       return false;
    }
   }
   
	 if(status == 3 | status == 4){
	  if(empty(cpc)){
	   translate(2, 'INGRESARCPC');
       return false;
    }
   } 
   
	 if(status == 5){
	  if(empty(cpa)){
	   translate(2, 'INGRESARCPA');
       return false;
    }
   }
   
	 if(status == 2 | status == 3 | status == 4){
	  if(empty(cap)){
	   translate(2, 'INGRESARCAP');
       return false;
    }
   }  
   }
  
   $.post(domain, {'function':'getForecast', action:action, status:status, id_campaign:id_campaign, contribution:contribution, cpc:cpc, cpa:cpa, cap:cap}, function(data, textStatus){
    if(data){
      if(action == 1){
      $('#forecast').html(data);
      }else{
      $('#fc-results').html(data);
      } 
    }     
   });

   } 

// Función para obtener gráficas para account manager
   function getGraphAM(action, id_user){
   var date_start = $('#date-start').val();
   var date_end = $('#date-end').val(); 
   
   /* Validaciones */
	 if(empty(date_start)){
	 translate(2, 'INGRESARFECHACOMIENZO');
      return false;
   }   

	 if(empty(date_end)){
	 translate(2, 'INGRESARFECHAFIN');
      return false;
   }

   if(compare_dates(date_start, date_end)){
	 translate(2, 'FECHAMAYOR');
      return false;
   }
   
   $.post(domain, {'function':'getGraphAM', action:action, id_user:id_user, date_start:date_start, date_end:date_end}, function(data, textStatus){
    if(data){
      $('#accounts').html(data);
    }     
   });

   $.post(domain, {'function':'getReportAM', action:3, id_user:null, id_opps:null, id_network:0, performance:null, revenue:null, spend:null, date_start:date_start, date_end:date_end}, function(data, textStatus){
    if(data){
      $('#account-manager').html(data);
    }     
   });
   }
        
// Función para obtener gráficas por campañas
   function getGraphCampaigns(action, id_campaign){
   var date_start = $('#date-start').val();
   var date_end = $('#date-end').val();
   var id_user = $('#id_user').val();
   var id_network = $('#networks').val(); 
   
   /* Validaciones */
	 if(empty(date_start)){
	 translate(2, 'INGRESARFECHACOMIENZO');
      return false;
   }   

	 if(empty(date_end)){
	 translate(2, 'INGRESARFECHAFIN');
      return false;
   }

   if(compare_dates(date_start, date_end)){
	 translate(2, 'FECHAMAYOR');
      return false;
   }
   
   if(action == 1){              
   window.open(root + 'campaign.php?id_campaign=' + id_campaign + '&date_start=' + date_start + '&date_end=' + date_end + '&id_network=' + id_network);
   }else{

   $.post(domain, {'function':'getGraphCampaigns', id_user:id_user, id_campaign:id_campaign, id_network:id_network, date_start:date_start, date_end:date_end}, function(data, textStatus){
    if(data){
      $('#reports').html(data);
      getChangeLog(1, id_campaign); 
    }     
   });
 
   }
   }

// Función para obtener gráficas y funciones de performance de carga de conversiones
   function getGraphConversions(action, id_user){
   var date = $('#date').val();
        
   $.post(domain, {'function':'getGraphConversions', action:action, id_user:id_user, date:date}, function(data, textStatus){
    if(data){
      $('#conversions').html(data);
    }     
   });
   }
      
// Función para obtener gráficas para redes
   function getGraphNetworks(action, id_network){
   var date_start = $('#date-start').val();
   var date_end = $('#date-end').val(); 
   
   /* Validaciones */
	 if(empty(date_start)){
	 translate(2, 'INGRESARFECHACOMIENZO');
      return false;
   }   

	 if(empty(date_end)){
	 translate(2, 'INGRESARFECHAFIN');
      return false;
   }

   if(compare_dates(date_start, date_end)){
	 translate(2, 'FECHAMAYOR');
      return false;
   }
   
   $.post(domain, {'function':'getGraphNetworks', action:action, id_network:id_network, date_start:date_start, date_end:date_end}, function(data, textStatus){
    if(data){
      $('#networks').html(data);
    }     
   });
   }

// Función para obtener gráficas y funciones para análisis operativo
   function getGraphOperative(){
   var date_start = $('#date-start').val();
   var date_end = $('#date-end').val();
        
   $.post(domain, {'function':'getGraphOperative', date_start:date_start, date_end:date_end}, function(data, textStatus){
    if(data){
      $('#operative').html(data);
    }     
   });
   }
         
// Función para obtener gráficas por oportunidades
   function getGraphOpps(action, id_opp){
   var date_start = $('#date-start').val();
   var date_end = $('#date-end').val();
   var id_user = $('#id_user').val();
   var id_network = $('#networks').val(); 
   
   /* Validaciones */
	 if(empty(date_start)){
	 translate(2, 'INGRESARFECHACOMIENZO');
      return false;
   }   

	 if(empty(date_end)){
	 translate(2, 'INGRESARFECHAFIN');
      return false;
   }

   if(compare_dates(date_start, date_end)){
	 translate(2, 'FECHAMAYOR');
      return false;
   }
   
   if(action == 1){
   $('#campaigns_' + id_opp).toggle(500);              
   window.open(root + 'opportunities.php?id_opp=' + id_opp + '&date_start=' + date_start + '&date_end=' + date_end + '&id_network=' + id_network);
   }else{

   $.post(domain, {'function':'getGraphOpps', id_user:id_user, id_opp:id_opp, id_network:id_network, date_start:date_start, date_end:date_end}, function(data, textStatus){
    if(data){
      $('#reports').html(data); 
    }     
   });

   }
   }
   
// Función para obtener usuarios
   /* Action 1: datos de un usuario particular por su id
      Action 2: datos de un usuario particular para el login
      Action 3: todos los usuarios */
   function getLogin(action){
   var email = $('#email').val();
   var password = $('#password').val();
   
   /* Validaciones */
	 if(empty(email)){
	 translate(2, 'LOGINUSUARIOPLACEHOLDER');
      return false;
   }   
   
	 if(empty(password)){
	 translate(2, 'LOGINPASSPLACEHOLDER');
      return false;
   }
      
   $.post(domain, {'function':'getLogin', action:action, id_user:null, email:email, password:password}, function(data, textStatus){
     if(data){
      window.location = root + 'home.php';
      }else{
      translate(2, 'LOGINERROR');
      }      
   });
   }  

// Función para obtener mensajes
   /* Action 1: Inbox
      Action 2: Send */
   function getMessages(action){
   var date = $('#msg-date').val();
   var status = $('#msg-status').val();
   var id_user = $('#msg-user').val();
   var id_sender = $('#users').val();   
   if($("#msg-date-no").is(':checked')){  
    var date_no = 1;
   }else{  
    var date_no = 0;
   }
            
   $.post(domain, {'function':'getMessages', action:action, id_user:id_user, date:date, status:status, id_sender:id_sender, date_no:date_no}, function(data, textStatus){
     if(data){
      $('#messages').html(data);
       if(date_no == 1){
        $(".date-box-t").datepicker('disable'); 
       }else{  
        $(".date-box-t").datepicker('enable');
       }
     }       
   });   
   }
   
// Función para obtener lista de oportunidades/clientes
   /* Action 1: reporte por account manager
      Action 2: reporte para conversiones
      Action 3: reporte general */
   function getOppsReport(action, id_user){
   if(action == 1 | action == 3){
   var date_start = $('#date-start').val();
   var date_end = $('#date-end').val();
   var id_network = $('#networks').val();
   if(action == 3) var id_user = $('#users').val();  
   }else{
   var date = $('#date').val();
   }
   
   /* Validaciones */
   if(action == 1 | action == 3){
	 if(empty(date_start)){
	 translate(2, 'INGRESARFECHACOMIENZO');
      return false;
   }   

	 if(empty(date_end)){
	 translate(2, 'INGRESARFECHAFIN');
      return false;
   }

   if(compare_dates(date_start, date_end)){
	 translate(2, 'FECHAMAYOR');
      return false;
   }

   }else{
   
	 if(empty(date)){
	 translate(2, 'INGRESARFECHA');
      return false;
   } 
      
   }
   
   if(action == 1 | action == 3){
   $.post(domain, {'function':'getOppsReport', action:action, id_user:id_user, id_opps:null, id_network:id_network, date_start:date_start, date_end:date_end}, function(data, textStatus){
     if(data){
      $('#reports').html(data);
      }     
   });
  
   $.post(domain, {'function':'getGraphOverall', id_user:id_user, id_network:id_network, date_start:date_start, date_end:date_end}, function(data, textStatus){
     if(data){
      $('#graph-overall').html(data); 
     }     
   });
   
   }else{
   
   $.post(domain, {'function':'setConversions', action:1, id_user:id_user, id_opps:null, date:date}, function(data, textStatus){
     if(data){
      $('#reports').html(data);
      }     
   });
      
   }
                    
   }  
   
// Función para obtener lista de publishers
   function getPublishersReport(action, id_publisher){
   if(action == 1){
   var date_start = $('#date-start').val();
   var date_end = $('#date-end').val();
   var id_country = $('#countries').val();

   /* Validaciones */
	 if(empty(date_start)){
	 translate(2, 'INGRESARFECHACOMIENZO');  
      return false;
   }   

	 if(empty(date_end)){
	 translate(2, 'INGRESARFECHAFIN');
      return false;
   }

   if(compare_dates(date_start, date_end)){
	 translate(2, 'FECHAMAYOR');
      return false;
   }
             
   $.post(domain, {'function':'getGraphOverallPublishers', id_country:id_country, date_start:date_start, date_end:date_end}, function(data, textStatus){
     if(data){
      $('#graph-overall').html(data);
     }     
   });
   
   $.post(domain, {'function':'getPublishersReport', action:action, id_publisher:id_publisher, id_country:id_country, date_start:date_start, date_end:date_end}, function(data, textStatus){
     if(data){
      $('#reports').html(data);
     }     
   });   
   }

   }

// Función para obtener lista de publishers
   function getPublisherProfile(id_publisher){ 
   window.open(root + 'publisher.php?id_publisher=' + id_publisher);
   }
   
// Función para obtener lista de oportunidades/clientes
   function getSlotsReport(action, id_publisher){
   if(action == 1){
   var date_start = $('#date-start').val();
   var date_end = $('#date-end').val();
   var id_country = $('#countries').val();

   /* Validaciones */
	 if(empty(date_start)){
	 translate(2, 'INGRESARFECHACOMIENZO');
      return false;
   }   

	 if(empty(date_end)){
	 translate(2, 'INGRESARFECHAFIN');
      return false;
   }

   if(compare_dates(date_start, date_end)){
	 translate(2, 'FECHAMAYOR');
      return false;
   }
             
   $.post(domain, {'function':'getSlotsReport', action:action, id_publisher:id_publisher, id_country:id_country, date_start:date_start, date_end:date_end}, function(data, textStatus){
     if(data){
      $('.publishers:not(#publishers_' + id_publisher + ')').slideUp(450);
      $('#publishers_' + id_publisher).html(data).toggle(500);
      }     
   });   
   }

   }
   
// Función para RealTime
   /* Action 1: general
      Action 2: por oportunidad
      Action 3: por campaña */
   function getRealTime(action, id, value, src){
   var count = $('#realtime-seconds').text();

   if(src == 1){
    $.post(domain, {'function':'getRealTime', action:action, id:id, value:value}, function(data, textStatus){
    if(data){
      $('#realtime').html(data);
      }     
    });   
   }else{
    if(count > 0){
     var count = count - 1;
     $('#realtime-seconds').html(count);
    }else{
     $.post(domain, {'function':'getRealTime', action:action, id:id, value:value}, function(data, textStatus){
      if(data){
       $('#realtime').html(data);
        abmTimestamp();
       }     
     });
     }
    }       
   }

   function abmTimestamp(){
    $.post(domain, {'function':'abmTimestamp'}, function(data, textStatus){});
   }
   
// Función para obtener lista de oportunidades/clientes
   function getReportAM(){
   var date_start = $('#date-start').val();
   var date_end = $('#date-end').val();
   var id_user = $('#users').val();
   var performance = $('#am-performance').val();
        
   $.post(domain, {'function':'getReportAM', action:3, id_user:id_user, id_opps:null, id_network:0, performance:performance, date_start:date_start, date_end:date_end}, function(data, textStatus){
    if(data){
      $('#account-manager').html(data);
    }     
   });
   }
   
// Función para obtener lista de oportunidades/clientes
   function getReportAMCampaign(action, id_user, id_opp){
   var date_start = $('#date-start').val();
   var date_end = $('#date-end').val();
   var performance = $('#am-performance').val();
            
   $.post(domain, {'function':'getReportAMCampaign', action:action, id_user:id_user, id_opp:id_opp, id_network:0, performance:performance, date_start:date_start, date_end:date_end}, function(data, textStatus){
     if(data){
      $('.campaigns:not(#campaigns_' + id_opp + ')').slideUp(450);
      $('#campaigns_' + id_opp).html(data).toggle(500);
      }     
   });   
   }

// Función para cargar textarea de urls
   function getUploadSteps(action){
   if(action == 1) var id_opp = $('#opps').val();
   if(action == 2){
   var id_type = $('#up-type-prod').val();
   var id_cat1 = $('#up-cat-prod1').val();
   var id_cat2 = $('#up-cat-prod2').val();
   var id_model = $('#up-model-prod').val();
   var id_value = $('#up-value-prod').val();
   }

   /* Validaciones */ 
   if(action == 1){  
   if(empty(id_opp)){
	 translate(2, 'SELECCIONARCLIENTE');
      return false;
   }
   }
   
   if(action == 2){  
   if(empty(id_value)){
	 translate(2, 'INGRESARVALOR');
      return false;
   }
   }

   if(action == 1){
   $('.data').fadeIn('slow');
   }
   
   if(action == 2){
   $('.urls').fadeIn('slow');
   }
   }

// Buscador de campañas
   function searchCampaign(){
   var id_campaign = $('#search-cp').val();
   var date_start = $('#date-start').val();
   var date_end = $('#date-end').val();
   
   /* Validaciones */
   var f = new Date();
   var today = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + (f.getDate() - 1);
   
   if(empty(date_start)) var date_start = today;
   if(empty(date_end)) var date_end = today; 

   $.post(domain, {'function':'getCampaignsValidation', id_campaign:id_campaign}, function(data, textStatus){
    if(data){
     window.open(root + 'campaign.php?id_campaign=' + id_campaign + '&date_start=' + date_start + '&date_end=' + date_end + '&id_network=0');
    }else{
     translate(2, 'ERRORCAMPANIA');
    }     
   });

   }
   
// Función cerrar carga enviroment
   function setBanners(action, campaigns){
   if(action == 1){
   window.location = root + 'segmentation.php?campaigns=' + campaigns;
   }
   }
         
// Función para cargar altas residuales
   function setCampaignsLost(id_opp, id_user){
   var date = $('#date').val();
   var id_campaign = $('#campaigns').val();
   var id_network = $('#networks').val();
   var conversions = $('#conv_lost_' + id_opp).val();
   
   /* Validaciones */
	 if(empty(id_campaign)){
	 translate(2, 'SELECCIONARCAMPANIA');
      return false;
   }   

	 if(empty(id_network)){
	 translate(2, 'SELECCIONARRED');
      return false;
   }                         

	 if(empty(conversions)){
	 translate(2, 'CARGARCONVERSIONES');
      return false;
   } 

   $.post(domain, {'function':'abmCampaignsReport', action:1, id_campaign:id_campaign, id_network:id_network, conversions:conversions, clics:null, impressions:null, spent:null, date:date}, function(data, textStatus){
    if(data){
     getCampaignsReport(2, id_user, id_opp);
    }else{
     translate(2, 'CARGARCONVERSIONESERROR');
    }     
   });
                 
   }
   
// Función para cargar multioperadores
   function setCampaignsValue(action, id_campaign, value, date){
   $.post(domain, {'function':'abmCampaignsValue', action:2, id_campaign:id_campaign, value:value, date:date});
   }
   
// Función para cargar multioperadores
   /* Action 1: abre la ventana de carga
      Action 2: carga datos
      Action 3: cierra ventana */
   function setConversionsMO(action, id_campaign, id_network){
   var date = $('#date').val();
   
   if(action == 1){
    $('#mo-' + id_campaign).css('display', 'block').fadeIn('slow');
   }   
   
   if(action == 2){
   var conv1 = $('#conv1-' + id_campaign).val();
   var conv2 = $('#conv2-' + id_campaign).val();
   var conv3 = $('#conv3-' + id_campaign).val();
   var value1 = $('#value1-' + id_campaign).val();
   var value2 = $('#value2-' + id_campaign).val();
   var value3 = $('#value3-' + id_campaign).val();
   
   var conversions = parseInt(conv1) + parseInt(conv2) + parseInt(conv3);
   
   $.post(domain, {'function':'getConversionsValueAvg', conv1:conv1, conv2:conv2, conv3:conv3, value1:value1, value2:value2, value3:value3}, function(data, textStatus){
    if(data){
     $('#conv_' + id_campaign + '_' + id_network).val(conversions);
     setCampaignsValue(1, id_campaign, data, date);
     setConversionsMO(3, id_campaign, id_network);
    }     
   });

   }
   
   if(action == 3){
    $('#mo-' + id_campaign).fadeOut('fast', function(){
     $('#mo-' + id_campaign).css('display', 'none');
    });
   }
               
   }

// Función cerrar carga enviroment
   function setEnviroment(action, campaigns){
   if(action == 1){
   var allInputs = $(".cp_validation");

   /* Validaciones */
	 if(allInputs.length > 0){
	 translate(2, 'VALIDACAMPANIA');
      return false;
   } 
   
   window.location = root + 'banners.php?campaigns=' + campaigns;
   }else{
   window.location = root + 'campaigns.php';
   }
   }

// Función para hacer slideToggle
   function showDate(){
    if($("#msg-date-no").is(':checked')){  
     $(".date-box-t").datepicker('disable');
     $("#msg-date-no").val(0);  
    }else{  
     $(".date-box-t").datepicker('enable');
     $("#msg-date-no").val(1);  
    }
   }
      
// Función para hacer slideToggle
   function slideToggle(div){
   $('#' + div).slideToggle(250);
   }
                             
// Función para traducir textos en JavaScript
   /* Action 1: devuelve sólo el texto
      Action 2: devuelve en un alert */
   function translate(action, text){
   const value = text;   
   $.post(domain, {'function':'translate', text:value}, function(data, textStatus){
    if(action == 1){
    return data;
    }else{    
    alert(data);
    }
   });             
   }
   
// Función para hacer el upload de .xls de conversiones
   function uploadFile(){      
	 var date = $('#date').val();
	 var fileToUpload = $('#fileToUpload').val();
	 var extension = (fileToUpload.substring(fileToUpload.lastIndexOf('.'))).toLowerCase();
	 
	 /* Validaciones */
	 if(empty(date) == 1){
	 alert('SELECCIONARFECHA');
      return false;
   }

   if(empty(fileToUpload)){
		alert('SELECCIONARARCHIVO');
    return false;
   }
 
	 if(!empty(fileToUpload)){	 
	  if(extension != '.xls'){
	  alert('SOLOXLS');
       return false;
    }
   } 

	  $.ajaxFileUpload({
				url: '../includes/ajaxfileupload.php',
				secureuri: false,
				fileElementId: 'fileToUpload',
				dataType: 'JSON',
				success: function (data, status){
					if(typeof(data.error) != 'undefined'){
						if(data.error != ''){
							alert(data.error);
						}else{
              $.post(domain, {'function':'processXLS', date:date}, function(data, textStatus){
               if(data){
                 alert(data.msg);
               }
              });
						}
					}
				},
				error: function(data, status, e){
					alert(e);
				}
			});	
      
   }    