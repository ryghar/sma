<?php
   header("Content-Type: text/html;charset=utf-8"); 
   date_default_timezone_set('America/Buenos_Aires');
   
// Incluyo archivos
   include_once('funciones.php');
   include_once('constantes.php');
   include_once('class.DB.php');
   include_once('class.users.php');
   include_once('class.countries.php');
   include_once('class.campaigns.php');
   include_once('class.networks.php');
   include_once('class.graphs.php');
   include_once('class.publishers.php'); 
   
// Instancio las clases      
   $DBase = new DBase();
   $Users = new User($DBase);
   $Country = new Country($DBase);
   $Campaign = new Campaign($DBase);
   $Network = new Network($DBase);
   $Graphs = new Graphs($DBase);
   $Publisher = new Publisher($DBase);
   
   $function = isset($_POST['function']) ? $_POST['function'] : null;

// Interface de funciones vía Ajax/jQuery
   switch($function){
   case 'abmAdText':                                                                
    echo $Campaign->abmAdText($_POST['action'], $_POST['id_adtext'], $_POST['title'], $_POST['description'], $_POST['url'], $_POST['id_campaign']);
   break;

   case 'abmBanners':                                                                
    echo $Campaign->abmBanners($_POST['action'], $_POST['id_banner'], $_POST['id_campaign'], $_POST['id_banner_size'], $_POST['extension']);
   break;
      
   case 'abmCampaigns':                                                                
    echo $Campaign->abmCampaigns($_POST['action'], $_POST['id_opp'], $_POST['id_user'], $_POST['id_cat_product'], $_POST['id_cat_theme'], $_POST['model_rate'], $_POST['cpa'], $_POST['urls'], $_POST['campaigns'], $_POST['name'], $_POST['description'], $_POST['enviroment']);
   break;   

   case 'abmCampaignsReport':                                                                
    echo $Campaign->abmCampaignsReport($_POST['action'], $_POST['id_campaign'], $_POST['id_network'], $_POST['conversions'], $_POST['clics'], $_POST['impressions'], $_POST['spent'], $_POST['date']);
   break;
   
   case 'abmCampaignsValue':                                                                
    echo $Campaign->abmCampaignsValue($_POST['action'], $_POST['id_campaign'], $_POST['value'], $_POST['date']);
   break;

   case 'abmChangeLog':                                                                
    echo $Campaign->abmChangeLog($_POST['action'], $_POST['id'], $_POST['id_tool'], $_POST['cpc'], $_POST['cap'], $_POST['model'], $_POST['rate'], $_POST['status'], $_POST['comments'], $_POST['date']);
   break;
   
   case 'abmConversions':                                                                
    echo $Campaign->abmConversions($_POST['action'], $_POST['id_opp'], $_POST['campaigns'], $_POST['networks'], $_POST['conversions'], $_POST['date']);
   break;

   case 'abmMessages':                                                                
    echo $Users->abmMessages($_POST['action'], $_POST['value'], $_POST['id_message']);
   break;
   
   case 'abmPublishersInformation':                                                                
    echo $Publisher->abmPublishersInformation($_POST['action'], $_POST['id_publisher'], $_POST['name'], $_POST['commercial'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['zip'], $_POST['id_country'], $_POST['taxid'], $_POST['password'], $_POST['status']);
   break;

   case 'abmPublishersModels':                                                                
    echo $Publisher->abmPublishersModels($_POST['action'], $_POST['id'], $_POST['id_country'], $_POST['model'], $_POST['value']);
   break;

   case 'abmPublishersPayments':                                                                
    echo $Publisher->abmPublishersPayments($_POST['action'], $_POST['id_publisher'], $_POST['beneficiary'], $_POST['paypal'], $_POST['ben_address'], $_POST['ben_account'], $_POST['ben_bank'], $_POST['ben_bank_address'], $_POST['ben_swift'], $_POST['ben_aba'], $_POST['ben_intermediary']);
   break;

   case 'abmSegmentation':                                                                
    echo $Campaign->abmSegmentation($_POST['action'], $_POST['id_country'], $_POST['carriers'], $_POST['os'], $_POST['campaigns']);
   break;

   case 'abmTimestamp':                                                                
    echo $Users->abmTimestamp();
   break;
      
   case 'getAdText':                                                                
    echo getAdText($_POST['id_adtext']);
   break;
   
   case 'getBanner':                                                                
    echo getBanner($_POST['id_banner']);
   break;
   
   case 'getCampaigns':                                                                
    echo getCampaigns($_POST['action'], $_POST['id_user'], $_POST['id_network'], $_POST['id_client'], $_POST['id_opp'], $_POST['status'], $_POST['date_start'], $_POST['date_end']);
   break;
   
   case 'getCampaignsInventory':                                                                
    echo getCampaignsInventory($_POST['action'], $_POST['id_user'], $_POST['id_opp'], $_POST['status'], $_POST['date_start'], $_POST['date_end']);
   break;
             
   case 'getCampaignsReport':                                                                
    echo getCampaignsReport($_POST['action'], $_POST['id_user'], $_POST['id_opp'], $_POST['id_network'], $_POST['date_start'], $_POST['date_end']);
   break;  

   case 'getCampaignsValidation':                                                                
    echo getCampaignsValidation($_POST['id_campaign']);
   break;
   
   case 'getChangeLog':                                                                
    echo getChangeLog($_POST['action'], $_POST['id_user'], $_POST['id_campaign'], $_POST['date_start'], $_POST['date_end']);
   break;

   case 'getComboCategories':                                                                
    echo getComboCategories($_POST['action'], $_POST['id_category']);
   break;  

   case 'getComboCategoriesEdit':                                                                
    echo getComboCategoriesEdit($_POST['action'], $_POST['id_category'], $_POST['id_campaign']);
   break;  

   case 'getComboCarriers':                                                                
    echo getComboCarriers($_POST['id_country']);
   break;

   case 'getComboCountries':                                                                
    echo getComboCountries($_POST['action'], $_POST['id_country']);
   break;
            
   case 'getComboNetworksTools':                                                                
    echo getComboNetworksTools($_POST['id_network']);
   break;

   case 'getComboOpps':                                                                
    echo getComboOpps($_POST['action'], $_POST['id_opp'], $_POST['id_client']);
   break;   

   case 'getConversionsAS':                                                                
    echo $Campaign->getConversionsAS($_POST['action'], $_POST['id'], $_POST['date_start'], $_POST['date_end']);
   break;
      
   case 'getConversionsReport':                                                                
    echo getConversionsReport($_POST['action'], $_POST['id_user'], $_POST['date']);
   break;
   
   case 'getConversionsValueAvg':                                                                
    echo getConversionsValueAvg($_POST['conv1'], $_POST['conv2'], $_POST['conv3'], $_POST['value1'], $_POST['value2'], $_POST['value3']);
   break;
                                       
   case 'getForecast':                                                                
    echo getForecast($_POST['action'], $_POST['status'], $_POST['id_campaign'], $_POST['contribution'], $_POST['cpc'], $_POST['cpa'], $_POST['cap']);
   break;
  
   case 'getGraphAM':                                                                
    echo getGraphAM($_POST['action'], $_POST['id_user'], $_POST['date_start'], $_POST['date_end']);
   break;
   
   case 'getGraphCampaigns':                                                                
    echo getGraphCampaigns($_POST['id_user'], $_POST['id_campaign'], $_POST['id_network'], $_POST['date_start'], $_POST['date_end']);
   break;

   case 'getGraphConversions':                                                                
    echo getGraphConversions($_POST['action'], $_POST['id_user'], $_POST['date']);
   break;
   
   case 'getGraphNetworks':                                                                
    echo getGraphNetworks($_POST['action'], $_POST['id_network'], $_POST['date_start'], $_POST['date_end']);
   break;
      
   case 'getGraphOverall':                                                                
    echo getGraphOverall($_POST['id_user'], $_POST['id_network'], $_POST['date_start'], $_POST['date_end']);
   break;

   case 'getGraphOperative':                                                                
    echo getGraphOperative($_POST['date_start'], $_POST['date_end']);
   break;
      
   case 'getGraphOpps':                                                                
    echo getGraphOpps($_POST['id_user'], $_POST['id_opp'], $_POST['id_network'], $_POST['date_start'], $_POST['date_end']);
   break;

   case 'getGraphOverallPublishers':                                                                
    echo getGraphOverallPublishers($_POST['id_country'], $_POST['date_start'], $_POST['date_end']);
   break;
   
   case 'getLogin':                                                                
    echo getLogin($_POST['action'], $_POST['id_user'], $_POST['email'], $_POST['password']);
   break;

   case 'getMessages':                                                                
    echo getMessages($_POST['action'], $_POST['id_user'], $_POST['date'], $_POST['status'], $_POST['id_sender'], $_POST['date_no']);
   break;
   
   case 'getOppsReport':                                                                
    echo getOppsReport($_POST['action'], $_POST['id_user'], $_POST['id_opps'], $_POST['id_network'], $_POST['date_start'], $_POST['date_end']);
   break;

   case 'getPublisherModels':                                                                
    echo getPublisherModels($_POST['id_publisher']);
   break;

   case 'getPublishersReport':                                                                
    echo getPublishersReport($_POST['action'], $_POST['id_publisher'], $_POST['id_country'], $_POST['date_start'], $_POST['date_end']);
   break;
   
   case 'getRealTime':                                                                
    echo getRealTime($_POST['action'], $_POST['id'], $_POST['value']);
   break;

   case 'getSlotsReport':                                                                
    echo getSlotsReport($_POST['action'], $_POST['id_publisher'], $_POST['id_country'], $_POST['date_start'], $_POST['date_end']);
   break;
   
   case 'getReportAM':                                                                
    echo getReportAM($_POST['action'], $_POST['id_user'], $_POST['id_opps'], $_POST['id_network'], $_POST['performance'], $_POST['date_start'], $_POST['date_end']);
   break;

   case 'getReportAMCampaign':                                                                
    echo getReportAMCampaign($_POST['action'], $_POST['id_user'], $_POST['id_opp'], $_POST['id_network'], $_POST['performance'], $_POST['date_start'], $_POST['date_end']);
   break;

   case 'setBanner':                                                                
    echo setBanner($_POST['file'], $_POST['id_banner']);
   break;
   
   case 'setConversions':                                                                
    echo setConversions($_POST['action'], $_POST['id_user'], $_POST['id_opps'], $_POST['date']);
   break;

   case 'setConversionsCampaigns':                                                                
    echo setConversionsCampaigns($_POST['id_user'], $_POST['id_opp'], $_POST['date']);
   break;
            
   case 'translate':                                                                
    echo translate($_POST['text']);
   break;
                 	 
   default:break;		
   }

  /////////////////////////////////////////////////
  // FUNCIONES
  /////////////////////////////////////////////////
// Función para obtener adtext
   function getAdText($id_adtext=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;
   
// Tomo los datos
   $adtext = $Campaign->getAdText($id_adtext);
      
   while($row = mysql_fetch_array($adtext)){
   $html.= '<div id="adtext_'.$row['id_adtext'].'" class="adtext">';
   $html.= '<a href="#" class="adtext-close" alt="'.ELIMINAR.'" title="'.ELIMINAR.'" onclick="abmAdText(\'3\', \''.$id_adtext.'\');">(<b>X</b>)</a>';
   $html.= '<b>'.acute($row['title']).'</b>';
   $html.= '<br />'.acute($row['description']);
   $html.= '<br /><small class="txt-url">'.acute($row['url']).'</small>';
   $html.= '</div>';
   }
      
   return $html;
   }

// Función para obtener banner
   function getBanner($id_banner=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;
   
// Tomo los datos
   $banner = $Campaign->getBanner($id_banner);
      
   while($row = mysql_fetch_array($banner)){
   $html.= '<div id="banner_'.$row['id_campaign_banner'].'" class="banner">';

// Sólo para borrar
   $html.= '<input type="hidden" id="id_campaign_'.$row['id_campaign_banner'].'" value="'.$row['id_campaign'].'" />';
   $html.= '<input type="hidden" id="id_banner_size_'.$row['id_campaign_banner'].'" value="'.$row['id_banner_size'].'" />';
   $html.= '<input type="hidden" id="extension_'.$row['id_campaign_banner'].'" value="'.$row['extension'].'" />';   
   
   $html.= '<a href="#" class="banner-close" alt="'.ELIMINAR.'" title="'.ELIMINAR.'" onclick="abmBanners(\'3\', \''.$row['id_campaign_banner'].'\'); return false;">(<b>X</b>)</a>';
   $html.= '<img src="'.ROOT.'/files/'.$row['id_campaign'].'/'.$row['id_campaign_banner'].'_'.$row['id_banner_size'].$row['extension'].'" />';
   $html.= '</div>';
   }
      
   return $html;
   }
      
// Función para obtener lista de oportunidades/clientes
   /* Action 1: reporte por account manager
      Action 2: reporte general */
   function getCampaigns($action, $id_user=null, $id_network=0, $id_client=0, $id_opp=0, $status=2, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Users;

   $html = null;
      
// Tomo los datos
   if($action == 2){
   $id_user = !empty($id_user) ? $id_user : null;
   $date_start = is_null($date_start) ? $Campaign->getDate(60) : $date_start;
   $date_end = is_null($date_end) ? $Campaign->getDate(1) : $date_end;
   $opps = $Campaign->getOpps(4, $id_opp); // $Campaign->getOppsReport($id_user, 0, $date_start, $date_end)
   $qty = $Campaign->cantidadItems($opps);
   }
   $colspan = 6;

// Título 
   if($action == 1){
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr>';
   $html.= '<td colspan="4" class="section-title">'.INVENTARIOCAMPANIAS.'</td>';
   $html.= '<td colspan="2" align="right"><a href="'.ROOT.'/create.php" class="bt-gral">'.AGREGARCAMPANIA.'</a></td>';
   $html.= '</tr>';
      
// Funciones
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="2">';
   $html.= '<input type="hidden" id="date-start" value="'.$date_start.'" />';
   $html.= '<input type="hidden" id="date-end" value="'.$date_end.'" />';
   $html.= FINANCE.' '.getComboClients(2, $id_client).'</td>';
   $html.= '<td>'.OPORTUNIDAD.' <div id="up-opps" class="combo">'.getComboOpps(1, $id_opp).'</div></td>';
   $html.= '<td colspan="3">';
   $html.= ESTADO.' <select id="status">';
   for($i=2; $i>=0; $i--){
   switch($i){
   case 1: $txt = ACTIVA; break;
   case 2: $txt = TODAS; break;
   default: $txt = PAUSADA; break;
   }
   $html.= '<option value="'.$i.'" ';
   if($status == $i) $html.= 'selected';
   $html.= '>'.$txt.'</option>';
   }
   $html.= '</select>';
   $html.= '<input type="button" class="input-button" onclick="getCampaigns(\'2\'); return false;" value="'.SELECCIONAR.'" />';
   $html.= '</td>';
   $html.= '</tr>';
   $html.= '</table>';
   }
   
// Encabezados
   $html.= '<div id="inventory">';
   if($action == 2){
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr class="report-header">';
   $html.= '<th class="report-left">'.CLIENTES.'</th>';
   $html.= '<th>'.CAMPANIAS.'</th>';
   $html.= '<th>'.MODELO.'</th>';
   $html.= '<th>Rate</th>';
   $html.= '<th>'.ESTADO.'</th>';
   $html.= '<th>'.ACCIONES.'</th>';   
   $html.= '</tr>';      
      
   if($qty > 0){
   $count = 0;     
   while($row = mysql_fetch_array($opps)){
   if($row['campaigns'] > 0){
   $Campaign->getOppsReportDetail($id_user, $row['id_opportunity'], $id_network, $date_start, $date_end);
        
   $html.= '<tr class="report-body-50" alt="'.acute($row['opp']).' ('.acute($row['client']).')" title="'.acute($row['opp']).' ('.acute($row['client']).')" onclick="getCampaignsReport(\'3\', \''.$id_user.'\', \''.$row['id_opportunity'].'\'); return false;">';
   $html.= '<td class="report-left-50"><b>'.acute(limit_chars($row['opp'], 25)).'</b><br /><small>('.$row['id_opportunity'].') '.acute($row['client']).'</small></td>';
   $paused = $Campaign->getTotal() - $Campaign->getActivas();   
   $html.= '<td title="'.ACTIVAS.' ('.$Campaign->getActivas().') - '.PAUSADAS.' ('.$paused.')" alt="'.ACTIVAS.' ('.$Campaign->getActivas().') - '.PAUSADAS.' ('.$paused.')">'.$Campaign->getTotal().'</td>';
   $html.= '<td>&nbsp;</td>';
   $html.= '<td>&nbsp;</td>';
   $html.= '<td>&nbsp;</td>';
   $html.= '<td>&nbsp;</td>';
   $html.= '</tr>';
   $html.= '<tr><td colspan="'.$colspan.'">';
   $html.= '<div id="campaigns_'.$row['id_opportunity'].'" class="campaigns"></div>';
   $html.= '</td></tr>';     
   $count++;
   }
   }

   }else{
   
   $html.= '<tr><td colspan="'.$colspan.'" align="center" height="50px"><b>'.NOINFO.'</b></td></tr>';
   }
   $html.= '</table>';   
   }
   
   if($action == 1){
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr><td colspan="'.$colspan.'" align="center" height="150px"><b>'.SELECCIONCAMPANIAS.'</b></td></tr>';
   $html.= '</table>';
   }
   $html.= '</div>';
   
   $html.= reloadDOM();
   
   return $html;
   }

// Función para obtener lista de oportunidades/clientes
   function getCampaignsInventory($action, $id_user=null, $id_opp=null, $status=2, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

// Tomo los datos
   $id_user = isset($id_user) ? $id_user : null;
   $campaigns = $Campaign->getCampaignsInventory(2, null, $id_opp);
   $qty = $Campaign->cantidadItems($campaigns);
   $colspan= 6;
   
   $html = null;
   
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   
   if($qty > 0){
   while($row = mysql_fetch_array($campaigns)){
   $campaign_status = $Campaign->getCampaignStatus($row['id_campaign']);
    if($status == 2 or $campaign_status == $status){
    $url = ROOT.'/track/?cid='.$row['id_opportunity'].'&nid=0&oid=0&cpid='.$row['id_campaign'];   
    $html.= '<tr class="report-body-50 report-campaigns">';
    $html.= '<td class="report-left">'.acute($row['campaign']).'<br /><small>('.$row['id_campaign'].')</small></td>';
    $html.= '<td>1</td>';  
    $html.= '<td>'.getModelRate($row['model_rate']).'</td>';
    $html.= '<td>'.precio($row['cpa']).'</td>';
    $html.= '<td>'.getCampaignStatus($campaign_status).'</td>';
    $html.= '<td align="right">';
    $html.= '<input type="button" value="R" class="report-bt-small" onclick="copyToClipboard(\''.$url.'\'); return false;" alt="Redirect URL" title="Redirect URL" />';
    $html.= '<input type="button" value="O" class="report-bt-small" onclick="copyToClipboard(\''.$row['url'].'\'); return false;" alt="Client URL" title="Client URL" />';
    $html.= '<input type="checkbox" />';    
    $html.= '</td>';
    $html.= '</tr>';
    }
   }   
   }else{
   $html.= '<tr><td colspan="'.$colspan.'" valign="middle" height="50px"><b>'.NOINFO.'</b></td></tr>';
   }
   $html.= '</table>';
   
   return $html;
   }
      
// Función para obtener lista de oportunidades/clientes
   function getCampaignsReport($action, $id_user=null, $id_opp=null, $id_network=null, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

// Tomo los datos
   $id_user = isset($id_user) ? $id_user : $_SESSION['s_id_user'];
   $campaigns = $Campaign->getCampaignsReport($id_user, $id_opp, $id_network, $date_start, $date_end);
   $qty = $Campaign->cantidadItems($campaigns);
   $colspan= 13;
   
   $html = null;
   
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   
   if($qty > 0){
   while($row = mysql_fetch_array($campaigns)){
    
   $Campaign->getCampaignsReportDetail($id_user, $row['id_campaign'], $id_network, $date_start, $date_end);
   // Calculos
   if($Campaign->getClics() != 0){
   $cr = $Campaign->getConversions()/$Campaign->getClics()*100;
   $ecpc = $Campaign->getSpent()/$Campaign->getClics();
   }else{
   $cr = 0;
   $ecpc = 0;
   }
   if($Campaign->getConversions() != 0){
   $ecpa = $Campaign->getSpent()/$Campaign->getConversions();
   }else{
   $ecpa = 0;
   }
   $contribution_money = $Campaign->getRevenue() - $Campaign->getSpent();   
   if($Campaign->getRevenue() != 0){    
   $contribution = $contribution_money/$Campaign->getRevenue()*100;
   }else{
   $contribution = 0;
   }
   if(!empty($row['tool'])) $tool = acute($row['tool']); else $tool = '<span class="txt-alert">'.UNDEFINED.'</span>';
       
   $html.= '<tr class="report-body report-campaigns" alt="'.acute($row['campaign']).' ('.$row['id_campaign'].')" title="'.acute($row['campaign']).' ('.$row['id_campaign'].')">';
   $html.= '<td class="report-left txt-tools">'.acute(limit_chars($row['campaign'], 25));
   $html.= '<br /><small>('.$row['id_campaign'].')';
   $html.= '<br />'.$tool.'</small></td>';   
   $html.= '<td>'.number($Campaign->getImpressions(), false).'</td>';
   $html.= '<td>'.number($Campaign->getClics(), false).'</td>';
   $html.= '<td>'.precio($Campaign->getSpent()).'</td>';
   $html.= '<td>'.number($Campaign->getConversions(), false).'</td>';
   $html.= '<td>'.percent($cr).'</td>';
   $html.= '<td>'.precio($ecpc, true, 3).'</td>';
   $html.= '<td>'.precio($ecpa, true, 3).'</td>';
   $html.= '<td>'.precio($Campaign->getCpa()).'</td>';
   $html.= '<td>'.precio($Campaign->getRevenue()).'</td>';
   $html.= '<td>'.percent($contribution).'</td>';
   $html.= '<td>'.precio($contribution_money).'</td>';
   $html.= '<td align="right">';
   $html.= getCampaignHealth($contribution);
   $html.= '<a href="#dialog" name="modal" id="getChangeLog_1_'.$row['id_campaign'].'">
            <img src="'.ROOT.'/images/83-calendar.png" alt="Change Log '.acute($row['campaign']).'" title="Change Log '.acute($row['campaign']).'" /></a>';
   $html.= '<a href="#" onclick="getConversionsAS(\'2\', \''.$row['id_campaign'].'\'); return false;">
            <img src="'.ROOT.'/images/16-line-chart.png" alt="'.VERCONVAS.' '.acute($row['campaign']).'" title="'.VERCONVAS.' '.acute($row['campaign']).'" /></a>';
   $html.= '<a href="#" onclick="getGraphCampaigns(\'1\', \''.$row['id_campaign'].'\'); return false;" >
             <img src="'.ROOT.'/images/17-bar-chart.png" alt="'.VERREPORTEDETALLE.' '.acute($row['campaign']).'" title="'.VERREPORTEDETALLE.' '.acute($row['campaign']).'" /></a>';
   $html.= '</td>';
   $html.= '</tr>';
   }   
   }else{
   $html.= '<tr><td colspan="'.$colspan.'" valign="middle" height="50px"><b>'.NOINFO.'</b></td></tr>';
   }
   $html.= '</table>';
   
   $html.= reloadDOM();
   
   return $html;
   }

// Función para determinar el estado de una campaña
   function getCampaignHealth($contribution){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;

   if($contribution >= 35){
    $html.= '<div class="report-alert1" alt="'.BUENO.'" title="'.BUENO.'"></div>';
   }elseif($contribution >= 20 && $contribution < 35){
    $html.= '<div class="report-alert2" alt="'.REGULAR.'" title="'.REGULAR.'"></div>';
   }elseif($contribution >= 5 && $contribution < 20){
    $html.= '<div class="report-alert3" alt="'.ALERTA.'" title="'.ALERTA.'"></div>';
   }else{
    $html.= '<div class="report-alert4" alt="'.MALO.'" title="'.MALO.'"></div>';
   }
   
   return $html;   
   }

// Función para validar si existe una campaña
   function getCampaignsValidation($id_campaign){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;
   
   $campaign = $Campaign->getCampaignsValidation($id_campaign);
   $qty = $Campaign->cantidadItems($campaign);

   if($qty > 0)
    return true;
   else
    return false;   
   }
   
// Función para obtener actividad de una campaña
   function getChangeLog($action, $id_user=null, $id_campaign=null, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;
      
// Tomo los datos
   $id_user = !is_null($id_user) ? $id_user : $_SESSION['s_id_user'];
   $date_start = is_null($date_start) ? $Campaign->getDate(7) : $date_start;
   $date_end = is_null($date_end) ? $Campaign->getDate(1) : $date_end;
   $colspan = 10;
   $changelog = $Campaign->getChangeLog($action, $id_campaign, $date_start, $date_end);
   $qty = $Campaign->cantidadItems($changelog);
   $changelog_pending = $Campaign->getChangeLogPending($action, $id_campaign, $date_start, $date_end);
   $qty_pending = $Campaign->cantidadItems($changelog_pending);
   $Campaign->getCampaigns(1, $id_campaign);
   $count = 1;
   
// ID de la campaña oculto
   $html.= '<input type="hidden" id="id_campaign" value="'.$id_campaign.'" />';   
// Título
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<td colspan="'.$colspan.'" class="section-title">Change Log</td>';
   $html.= '</tr>';
         
// Funciones
   $html.= '<tr class="report-functions">';
   $html.= '<td><input type="text" id="cl-date" class="date-box-n" size="10" /></td>';
   $html.= '<td>'.getComboNetworks(2).'</td>';
   $html.= '<td id="cl-tools">'.SELECCIONARRED.'</td>';
   $html.= '<td><input type="text" id="cl-cpc" size="3" /></td>';
   $html.= '<td>';
   $html.= '<select id="cl-model">';
   $html.= '<option value="0" selected>'.MODELO.'</option>';
   for($i=1; $i<=3; $i++){
   $html.= '<option value="'.$i.'" ';
   if($Campaign->getModelRate() == $i) $html.= 'selected';
   $html.= '>'.getModelRate($i).'</option>';
   }
   $html.= '</select>';
   $html.= '</td>';
   $html.= '<td><input type="text" id="cl-rate" value="'.$Campaign->getCpa().'" size="3" /></td>';
   $html.= '<td><input type="text" id="cl-cap" size="3" /></td>';
   $html.= '<td>';
   $html.= '<select id="cl-status">';
   $html.= '<option value="0" selected>'.ESTADO.'</option>';
   for($i=1; $i<=2; $i++){
   $html.= '<option value="'.$i.'">'.getCampaignStatus($i).'</option>';
   }
   $html.= '</select>';
   $html.= '</td>';
   $html.= '<td><input type="text" id="cl-comments" size="18" /></td>';
   $html.= '<td><input type="button" onclick="abmChangeLog(\'1\', \''.$id_campaign.'\'); return false;" value="'.AGREGAR.'" /></td>';
   $html.= '</tr>';
   
// Encabezados
   $html.= '<tr class="report-header">';
   $html.= '<th>'.FECHA.'</th>';
   $html.= '<th>'.REDES.'</th>';
   $html.= '<th>'.HERRAMIENTA.'</th>';
   $html.= '<th>Bid</th>';
   $html.= '<th>'.MODELO.'</th>';
   $html.= '<th>Rate</th>';
   $html.= '<th>CAP</th>';
   $html.= '<th>'.ESTADO.'</th>';
   $html.= '<th>'.COMENTARIOS.'</th>';
   $html.= '<th>&nbsp;</th>';
   $html.= '</tr>';
   
// Pendientes
   if($qty_pending > 0){
    while($row_pending = mysql_fetch_array($changelog_pending)){
    $html.= '<tr class="report-body pending" id="clog_'.$row_pending['id_clog'].'">';
    $html.= '<td valign="top">'.date2sp($row_pending['date']).'</td>';
    $html.= '<td valign="top">'.acute($row_pending['network']).'</td>';
    $html.= '<td valign="top">'.acute($row_pending['tool']).'</td>';
    $html.= '<td valign="top">'.precio($row_pending['cpc'], true, 4).'</td>';
    $html.= '<td valign="top">'.getModelRate($row_pending['model_rate']).'</td>';
    $html.= '<td valign="top">'.precio($row_pending['cpa']).'</td>';
    $html.= '<td valign="top">'.precio($row_pending['cap']).'</td>';
    $html.= '<td valign="top">'.getCampaignStatus($row_pending['status']).'</td>';
    $html.= '<td valign="top" class="report-body-txt">'.acute($row_pending['comments']).'</td>';
    $html.= '<td valign="top"><input type="button" onclick="abmChangeLog(\'3\', \''.$row_pending['id_clog'].'\'); return false;" value="'.ELIMINAR.'" /></td>';
    $html.= '</tr>';
    }
   }
          
// Data
   if($qty > 0){   
    while($row = mysql_fetch_array($changelog)){
    $html.= '<tr class="report-body" id="clog_'.$row['id_clog'].'">';
    $html.= '<td valign="top">'.date2sp($row['date']).'</td>';
    $html.= '<td valign="top">'.acute($row['network']).'</td>';
    $html.= '<td valign="top">'.acute($row['tool']).'</td>';
    $html.= '<td valign="top">'.precio($row['cpc'], true, 4).'</td>';
    $html.= '<td valign="top">'.getModelRate($row['model_rate']).'</td>';
    $html.= '<td valign="top">'.precio($row['value']).'</td>';
    $html.= '<td valign="top">'.precio($row['cap']).'</td>';
    $html.= '<td valign="top">'.getCampaignStatus($row['status']).'</td>';
    $html.= '<td valign="top" class="report-body-txt">'.acute($row['comments']).'</td>';
    $html.= '<td valign="top">';
    if($count == 1){
    $html.= '<input type="button" onclick="abmChangeLog(\'4\', \''.$row['id_clog'].'\'); return false;" value="'.MANTENER.'" />';
    }else{
    $html.= '<span class="txt-changelog">'.CERRADO.'</span>';
    }
    $html.= '</td>';
    $html.= '</tr>';
    $count++;
    }
   }else{
   $html.= '<tr><td colspan="'.$colspan.'" valign="middle" height="50px"><b>'.NOINFO.'</b></td></tr>';
   }
   
   $html.= '</table>';
   $html.= reloadDOM();
   
   return $html;
   }

// Función para armar combo de redes
   function getComboCampaigns($id_opp){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;
   
// Tomo los datos
   $campaigns = $Campaign->getCampaigns(3, null, $id_opp);
   $qty = $Campaign->cantidadItems($campaigns);
      
   $html.= '<select id="campaigns">';
   $html.= '<option value="0">'.TODAS.'</option>';
   while($row = mysql_fetch_array($campaigns)){
   $html.= '<option value="'.$row['id_campaign'].'" alt="('.$row['id_campaign'].') '.acute($row['campaign']).'" title="('.$row['id_campaign'].') '.acute($row['campaign']).'">'.$row['id_campaign'].' '.acute(limit_chars($row['campaign'], 10)).'</option>';
   }
   $html.= '</select>';
      
   return $html;
   }

// Función para armar combo de redes
   function getComboCarriers($id_country=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;
   
// Tomo los datos
   $carriers = $Campaign->getCarriers($id_country);
   $qty = $Campaign->cantidadItems($carriers);
      
   $html.= '<select id="carriers" multiple="multiple">';
   if(is_null($id_country)) $html.= '<option value="0">'.SELECCIONARPAIS.'</option>';
   if(!is_null($id_country)){
   while($row = mysql_fetch_array($carriers)){
   $html.= '<option value="'.$row['id_carrier'].'">'.acute($row['carrier']).'</option>';
   }
   }
   $html.= '</select>';
      
   return $html;
   }
   
// Función para armar combo de categorías
   function getComboCategories($action, $id_category=0){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;
   if($action == 1) $category = SELECCIONARCATEGORIA; else $category = SELECCIONARSUBCATEGORIA;
// Tomo los datos
   $categories = $Campaign->getCategories($id_category);
   $qty = $Campaign->cantidadItems($categories);
      
   $html.= '<select id="up-cat-prod'.$action.'" '; 
   if($action == 1) $html.= 'onchange="getComboCategories(\'2\');"';
   $html.= '>';
   $html.= '<option value="0">'.$category.'</option>';
   while($row = mysql_fetch_array($categories)){
    if($action == 2 && $id_category != 0){
    $html.= '<option value="'.$row['id_category'].'">'.acute($row['category']).'</option>';
    }elseif($action == 1){
    $html.= '<option value="'.$row['id_category'].'">'.acute($row['category']).'</option>';
    }else{
    $html.= null;
    }
   }
   $html.= '</select>';
      
   return $html;
   }

// Función para editar combo de categorías
   function getComboCategoriesEdit($action, $id_category=0, $id_campaign){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;
   if($action == 1) $category = SELECCIONARCATEGORIA; else $category = SELECCIONARSUBCATEGORIA;
// Tomo los datos
   $categories = $Campaign->getCategories($id_category);
   $qty = $Campaign->cantidadItems($categories);
      
   $html.= '<select id="up-cat-prod'.$action.'_'.$id_campaign.'" '; 
   if($action == 1) $html.= 'onchange="getComboCategoriesEdit(\'2\', \''.$id_campaign.'\');"';
   $html.= ' class="report-select">';
   $html.= '<option value="0">'.$category.'</option>';
   while($row = mysql_fetch_array($categories)){
    if($action == 2 && $id_category != 0){
    $html.= '<option value="'.$row['id_category'].'">'.acute($row['category']).'</option>';
    }elseif($action == 1){
    $html.= '<option value="'.$row['id_category'].'">'.acute($row['category']).'</option>';
    }else{
    $html.= null;
    }
   }
   $html.= '</select>';
      
   return $html;
   }

// Función para editar combo de categorías definidas
   function getComboCategoriesEditLoad($action, $id_category, $rel_category, $id_campaign){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;
   if($action == 1){

// Tomo los datos
   $categories = $Campaign->getCategories(0);
   $qty = $Campaign->cantidadItems($categories);
      
   $html.= '<select id="up-cat-prod'.$action.'_'.$id_campaign.'" onchange="getComboCategoriesEdit(\'2\', \''.$id_campaign.'\');" class="report-select">';
   $html.= '<option value="0">'.SELECCIONARCATEGORIA.'</option>';
    while($row = mysql_fetch_array($categories)){
    $html.= '<option value="'.$row['id_category'].'" ';
    if($rel_category == 0) $compare = $id_category; else $compare = $rel_category;
    if($row['id_category'] == $compare) $html.= 'selected';
    $html.= '>'.acute($row['category']).'</option>';
    }
   $html.= '</select>';
   }
   
   if($action == 2){

// Tomo los datos
   if($rel_category != 0){ 
   $categories = $Campaign->getCategories($rel_category);
   }else{
   $categories = $Campaign->getCategories($id_category);
   }
   $qty = $Campaign->cantidadItems($categories);
      
   $html.= '<select id="up-cat-prod'.$action.'_'.$id_campaign.'" class="report-select">';
   $html.= '<option value="0">'.SELECCIONARSUBCATEGORIA.'</option>';
    while($row = mysql_fetch_array($categories)){
    $html.= '<option value="'.$row['id_category'].'" ';
    if($rel_category != 0 && $row['id_category'] == $id_category) $html.= 'selected';
    $html.= '>'.acute($row['category']).'</option>';
    }
   $html.= '</select>';
   }
         
   return $html;
   }
      
// Función para obtener lista de clientes
   function getComboClients($action, $id_client=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   
   $html = null;
// Tomo los datos
   if($action == 1){
   $clients = $Campaign->getClients();
   }else{
   $clients = $Campaign->getClientsActive();
   }
   $qty = $Campaign->cantidadItems($clients);
      
   $html.= '<select id="clients" onchange="getComboOpps(\'2\', \'null\');">';
   $html.= '<option value="0">'.TODAS.'</option>';
   while($row = mysql_fetch_array($clients)){
   $html.= '<option value="'.$row['id_client'].'">'.acute($row['name']).'</option>';
   }
   $html.= '</select>';
   
   return $html;
   }

// Función para armar combo de redes
   /* Action 1: Para carriers
      Action 2: Para slots
      Action 3: Sin onchange */
   function getComboCountries($action, $id_country=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Publisher;

   $html = null;
   
// Tomo los datos
   if($action == 1 or $action == 3){
   $countries = $Campaign->getCountries(1);
   }else{
   $countries = $Publisher->getCountries(1);
   }
   $qty = $Campaign->cantidadItems($countries);
      
   $html.= '<select id="countries" ';
   if($action == 1) $html.= 'onchange="getComboCarriers();"';
   $html.= '>';
   $html.= '<option value="0">'.TODOS.'</option>';
   while($row = mysql_fetch_array($countries)){
   $html.= '<option value="'.$row['id_country'].'" ';
   if($id_country == $row['id_country']) $html.= 'selected';
   $html.= '>'.acute($row['country_eng']).'</option>';
   }
   $html.= '</select>';
      
   return $html;
   }
      
// Función para armar combo de redes
   /* Action 1: normal
      Action 2: para comobo dependiente tools */
   function getComboNetworks($action, $id_user=null, $id_network=0, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Network;

   $html = null;
   
// Tomo los datos
   $id_user = !is_null($id_user) ? $id_user : null;
   $date_start = is_null($date_start) ? $Campaign->getDate(7) : $date_start;
   $date_end = is_null($date_end) ? $Campaign->getDate(1) : $date_end;
   $networks = $Network->getNetworks($action, $id_user, $id_network, $date_start, $date_end);
   $qty = $Network->cantidadItems($networks);
      
   if($action == 1){
   $html.= '<select id="networks">';
   }else{
   $html.= '<select id="cl-networks" onchange="getComboTools(); return false;">';
   }
   $html.= '<option value="0">'.TODAS.'</option>';
   while($row = mysql_fetch_array($networks)){
   $html.= '<option value="'.$row['id_network'].'" ';
   if(!empty($id_network) && $id_network == $row['id_network']) $html.= 'selected';
   $html.= '>'.acute($row['network']).'</option>';
   }
   $html.= '</select>';
      
   return $html;
   }

// Función para armar combo de herramientas de redes
   function getComboNetworksTools($id_network){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Network;

   $html = null;
   
// Tomo los datos
   $tools = $Network->getNetworksTools($id_network);
   $qty = $Network->cantidadItems($tools);
      
   $html.= '<select id="networks-tools" class="report-select">';
   $html.= '<option value="0">'.TODAS.'</option>';
   while($row = mysql_fetch_array($tools)){
   $html.= '<option value="'.$row['id_tool'].'">'.acute($row['tool']).'</option>';
   }
   $html.= '</select>';
      
   return $html;
   }

// Función para obtener lista de oportunidades
   /* Action 1: vacío
      Action 2: oportunidades por cliente */
   function getComboOpps($action, $id_opp=null, $id_client=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   
   $html = null;
// Tomo los datos
   $opps = $Campaign->getOpps(3, $id_opp, $id_client);
   $qty = $Campaign->cantidadItems($opps);
      
   $html.= '<select id="opps">';
   $html.= '<option value="0">'.SELECCIONARCLIENTE.'</option>';
   if($action == 2){
    while($row = mysql_fetch_array($opps)){
    $html.= '<option value="'.$row['id_opportunity'].'">('.$row['id_opportunity'].') '.acute($row['opp']).'</option>';
    }
   }
   $html.= '</select>';
   
   return $html;
   }

// Función para armar combo de redes
   function getComboOS(){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;
   
// Tomo los datos
   $os = $Campaign->getOS();
   $qty = $Campaign->cantidadItems($os);
      
   $html.= '<select id="os" multiple="multiple">';
   while($row = mysql_fetch_array($os)){
   $html.= '<option value="'.$row['id_os'].'">'.acute($row['name']).'</option>';
   }
   $html.= '</select>';
      
   return $html;
   }
      
// Función para armar combo de usuarios
   function getComboUsersMedia($action, $id_user=0){
// Instancio las clases dentro de la función
   global $DBase;
   global $Users;

   $html = null;
   
// Tomo los datos
   $users = $Users->getUsersMedia(2);
   $qty = $Users->cantidadItems($users);
      
   $html.= '<select id="users" class="report-select">';
   $html.= '<option value="0">'.TODOS.'</option>';
   while($row = mysql_fetch_array($users)){
   $html.= '<option value="'.$row['id_user'].'" ';
   if(!empty($id_user) && $id_user == $row['id_user']) $html.= 'selected';
   $html.= '>'.acute($row['name']).'</option>';
   }
   $html.= '</select>';
      
   return $html;
   }

// Función para obtener log de carga de conversiones
   function getConversionsReport($action, $id_user=null, $date=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Graphs;
   global $Users;

   $html = null;
      
// Tomo los datos
   $id_user = !empty($id_user) ? $id_user : null;
   $date = is_null($date) ? $Campaign->getDate(0) : $date;
   $am = $Users->getUsersMedia(2);
   $qty = $Users->cantidadItems($am);
   $chart1 = null;
   
// Título
   $html.= '<table width="100%" class="fleft"><tr>';
   $html.= '<td class="section-title">'.CONVERSIONESLOG.'</td>';
   $html.= '</tr></table>';
     
// Funciones
   $html.= '<table width="100%" cellspacing="0" cellpadding="0" class="fleft">';
   $html.= '<tr class="report-functions">';
   $html.= '<td>';
   $html.= '<input type="text" id="date-log" class="date-box-t" value="'.$date.'" />';
   $html.= '<input type="button" class="input-button" onclick="getConversionsReport(\'1\', \''.$id_user.'\'); return false;" value="'.MODIFICAR.'" /></td>';
   $html.= '</tr>';
   $html.= '</table>';
   
// Gráficas   
   if($qty > 0){
// Tabla con reporte de horario de cargas y actividad
   $html.= '<table width="100%" cellspacing="0" cellpadding="0" class="fleft">';
   
// Encabezados
   $html.= '<tr class="report-header">';
   $html.= '<th class="report-left">Account Manager</th>';
   $html.= '<th>'.CLIENTES.'</th>';
   $html.= '<th>'.OPORTUNIDADES.'</th>';
   $html.= '<th>'.HORA.'</th>';
   $html.= '</tr>';

// Data
   mysql_data_seek($am, 0);
   while($row = mysql_fetch_array($am)){
   $data = $Campaign->getActivityLog(2, $row['id_user'], $date, $date);
    while($row_activity = mysql_fetch_array($data)){
    $html.= '<tr class="report-body">';
    $html.= '<td class="report-left">'.acute($row['name']).'</td>';
    $html.= '<td>'.acute($row_activity['client']).'</td>';
    $html.= '<td>'.acute($row_activity['opp']).'</td>';
    $html.= '<td>'.$row_activity['hour'].'</td>';
    $html.= '</tr>';
    }
   }
   $html.= '</table>';   
   $html.= reloadDOM();
   
   }else{
   
   $html.= '<table><tr><td align="center" height="30px"><b>'.NOINFO.'</b></td></tr></table>';
   
   }
   
   return $html;
   }
         
// Función para obtener promedio pesado hasta 3 valores
   function getConversionsValueAvg($conv1, $conv2, $conv3, $value1, $value2, $value3){
// Total de altas
   $conversions = $conv1 + $conv2 + $conv3;

// Altas sobre conversiones totales
   $convSt1 = $conv1/$conversions;
   $convSt2 = $conv2/$conversions;
   $convSt3 = $conv3/$conversions;

// Altas por cada valor
   $cpaT1 = $convSt1*$value1;
   $cpaT2 = $convSt2*$value2;
   $cpaT3 = $convSt3*$value3;

// Sumo para valor promedio
   $total = $cpaT1 + $cpaT2 + $cpaT3;

   return round($total, 2);
   }

// Función para obtener log de carga de conversiones
   function getDashboard($id_user=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Graphs;
   global $Users;

   $html = null;
      
// Tomo los datos
   $Users->getUsers(1, $id_user);
   
// Título
   $html.= '<table width="100%"><tr>';
   $html.= '<td class="section-title">'.PANEL.'</td>';
   $html.= '<td align="right" class="report-date" width="190px" nowrap>'.ACTIVIDADDIA.' '.date2sp($Campaign->getDate(0)).'</td>';
   $html.= '<tr><td>&nbsp;</td></tr>';
   $html.= '</tr></table>';
     
// Funciones
   $html.= '<table width="100%" cellspacing="0" cellpadding="0" class="fleft">';
   $html.= '<tr class="report-functions">';
   $html.= '<td>Panel de administración de '.$Users->getName().' para el día '.$Campaign->getDate(0).'</td>';
   $html.= '</tr>';
   $html.= '</table>';
   
   
   return $html;
   }
   
// Función para obtener utilidad de forecast para una campaña
   /* Action 1: cargar forecast
      Action 2: calcular forecast */           
   function getForecast($action, $status=0, $id_campaign, $contribution=null, $cpc=null, $cpa=null, $cap=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Graphs;

   $html = null;
      
// Tomo los datos 
   $Campaign->getCampaigns(1, $id_campaign);
   $colspan = 9;

// Datos fijos día anterior
   $date_start = $date_end = $Campaign->getDate(1); 
   $data = $Graphs->getRevenue(1, null, null, $id_campaign, 0, $date_start, $date_end);
   $clics_ld = $Graphs->getClics();
   $conversion_ld = $Graphs->getConversions();
   $revenue_ld = $Graphs->getRev();
   $spend_ld = $Graphs->getSpent();
   if($revenue_ld != 0 && $conversion_ld != 0) $cpa_ld = $revenue_ld / $conversion_ld; else $cpa_ld = 0;   
   if($revenue_ld != 0 && $spend_ld != 0) $contribucion_ld = ($revenue_ld - $spend_ld) * 100 / $revenue_ld; else $contribucion_ld = 0;
   $cpc_ld = $spend_ld / $clics_ld;
   $cap_ld = $Campaign->getCap();   
   $cr_ld = $conversion_ld / $clics_ld * 100;
   
// Título
   if($action == 1){
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<td colspan="'.$colspan.'" class="section-title">Forecast</td>';
   $html.= '</tr>';
         
// Funciones
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="'.$colspan.'">';
   $html.= '<select id="fc-status" onchange="getForecast(\'1\', \'null\', \''.$id_campaign.'\'); return false;">';
   $html.= '<option value="0">'.SELECCIONARESTADO.'</option>';
   for($i=1; $i<=6; $i++){
   switch($i){
   case 1: $txt = CONTRIBUCIONNEGATIVA; break;
   case 2: $txt = MAYORVOLUMENCAP; break;
   case 3: $txt = MAYORVOLUMENCPC; break;
   case 4: $txt = MAYORVOLUMENCONT; break;
   case 5: $txt = VARIACIONCPA; break;
   case 6: $txt = BAJOCPC; break;
   default:break;
   }
   $html.= '<option value="'.$i.'" ';
   if($status == $i) $html.= 'selected';
   $html.= '>'.$txt.'</option>';
   }
   $html.= '</select>';
   if($status != 0){
   if($status == 1 or $status == 5) $html.= '<b>'.CONTRIBUCION.'</b> <input type="text" id="fc-cont" value="0" size="3" />';
   if($status == 3 or $status == 4 or $status == 6) $html.= '<b>CPC</b> <input type="text" id="fc-cpc" value="0" size="3" />';
   if($status == 5) $html.= '<b>CPA</b> <input type="text" id="fc-cpa" value="0" size="3" />';
   if($status == 2 or $status == 3 or $status == 4 or $status == 6) $html.= '<b>CAP</b> <input type="text" id="fc-cap" value="'.$Campaign->getCap().'" size="3" />';
   $html.= '<input type="button" value="'.CREAR.'" onclick="getForecast(\'2\', \''.$status.'\', \''.$id_campaign.'\'); return false;" />'; 
   }
   if($conversion_ld == 0 & $status == 0) $html.= '<span class="txt-alert"><b>'.ALERTACONV.'</b></span>';
   $html.= '</td>';
   $html.= '</tr>';   

// Encabezados
   $html.= '<tr class="report-body">';
   $html.= '<td>'.CONTRIBUCION.'</td>';
   $html.= '<td>'.CLICS.'</td>';
   $html.= '<td>'.CONVERSIONES.'</td>';
   $html.= '<td>'.CONVERSIONRATE.'</td>';
   $html.= '<td>Spend</td>';
   $html.= '<td>CPA</td>';
   $html.= '<td>Revenue</td>';
   $html.= '<td>CPC</td>';
   $html.= '<td>CAP</td>';
   $html.= '</tr>';
   
   $html.= '<tr class="report-body">';
   $html.= '<td>'.percent($contribucion_ld).'</td>';
   $html.= '<td>'.number($clics_ld, false).'</td>';
   $html.= '<td>'.number($conversion_ld, false).'</td>';
   $html.= '<td>'.percent($cr_ld).'</td>';
   $html.= '<td>'.precio($spend_ld).'</td>';
   $html.= '<td>'.precio($cpa_ld).'</td>';
   $html.= '<td>'.precio($revenue_ld).'</td>';
   $html.= '<td>'.precio($cpc_ld, true, 4).'</td>';
   $html.= '<td>'.precio($cap_ld).'</td>';
   $html.= '</tr>';
      
   $html.= '</table>';
   $html.= '<div id="fc-results">';
   }

// Procesos de cálculo
   if($action == 2){
   $Campaign->abmActivity($id_campaign, '', 'forecast');
   $date_start = $Campaign->getDate(3);
   $date_end = $Campaign->getDate(1);
   $data = $Graphs->getRevenue(2, null, null, $id_campaign, 0, $date_start, $date_end);
   $qty = $Graphs->cantidadItems($data);
   $count = 1;
   
// Genéricos para todos los estados  
   while($row = mysql_fetch_array($data)){
    if($count == 1){
    $ema3clics = $row['clics'];
    $ema3conv = $row['conversions'];
    $spend_calculate = $row['spent'];
    }else{
    $ema3clics = $ema3clics + ($row['clics'] - $ema3clics) * (2/(1+3));
    $ema3conv = $ema3conv + ($row['conversions'] - $ema3conv) * (2/(1+3));
    $spend_calculate = $spend_calculate + $row['spent']; 
    }
    if($count == 3){
    $clics_last_day = $row['clics'];
    $spend_last_day = $row['spent'];   
    }
    $count++;
   }

// Dependientes del estado
   switch($status){
   case 2:
   case 4:
   case 6:
    $lines = 3;
   break;
   
   case 3:
    $lines = 4;
   break;
   
   default:
    $lines = 1;
   break;
   }
   
// Esc. 1. Contribución negativa
   if($status == 1){
   $clics = $ema3clics;
   $conversions = $ema3conv;
   $cr = $ema3conv / $ema3clics * 100;
   $revenue = $ema3conv * $Campaign->getCpa();
   $spend = $revenue - ($revenue * ($contribution / 100));
   $cpc = $spend / $ema3clics;
   $cpa = $Campaign->getCpa();
   $cap = $Campaign->getCap();   
   }

// Esc. 2. Incremento CAP para mayor volúmen
   if($status == 2){
   $cpc = $spend_last_day / $clics_last_day;
   $clics = $clics2 = $clics3 = $cap / $cpc;   
   $cr = $ema3conv / $ema3clics;
   $cr2 = $ema3conv / $ema3clics * 0.8;
   $cr3 = $ema3conv / $ema3clics * 0.5;
   $conversions = $clics * $cr;
   $conversions2 = $clics2 * $cr2;
   $conversions3 = $clics3 * $cr3;
   $revenue = $conversions * $Campaign->getCpa();
   $revenue2 = $conversions2 * $Campaign->getCpa();
   $revenue3 = $conversions3 * $Campaign->getCpa();
   $spend = $spend2 = $spend3 = $clics * $cpc;
   $contribution = (($revenue - $spend) * 100) / $revenue;
   $contribution2 = (($revenue2 - $spend2) * 100) / $revenue2;
   $contribution3 = (($revenue3 - $spend3) * 100) / $revenue3;
   $cpa = $Campaign->getCpa();   
   }
   
// Esc. 3. Incremento CPC para mayor volúmen
   if($status == 3){
   $clics = $ema3clics;
   $clics2 = $clics * 1.15;
   $clics3 = $clics * 1.3;
   $clics4 = $clics * 1.5;
   $cr = $cr2 = $cr3 = $cr4 = $ema3conv / $ema3clics;
   $conversions = $clics * $cr;
   $conversions2 = $clics2 * $cr2;
   $conversions3 = $clics3 * $cr3;
   $conversions4 = $clics4 * $cr4;   
   $revenue = $conversions * $Campaign->getCpa();
   $revenue2 = $conversions2 * $Campaign->getCpa();
   $revenue3 = $conversions3 * $Campaign->getCpa();
   $revenue4 = $conversions4 * $Campaign->getCpa();
   $spend = $clics * $cpc;
   $spend2 = $spend * 1.15;
   $spend3 = $spend * 1.3;
   $spend4 = $spend * 1.5;
   $contribution = (($revenue - $spend) * 100) / $revenue;
   $contribution2 = (($revenue2 - $spend2) * 100) / $revenue2;
   $contribution3 = (($revenue3 - $spend3) * 100) / $revenue3;
   $contribution4 = (($revenue4 - $spend4) * 100) / $revenue4;
   $cpa = $Campaign->getCpa();   
   }
   
// Esc. 4. Mucha contribución con poco volúmen
   if($status == 4){
   $clics = $clics2 = $clics3 = $cap / $cpc;
   $cr = $ema3conv / $ema3clics;
   $cr2 = $ema3conv / $ema3clics * 0.8;
   $cr3 = $ema3conv / $ema3clics * 0.5;
   $conversions = $clics * $cr; 
   $conversions2 = $clics * $cr2;
   $conversions3 = $clics * $cr3;  
   $revenue = $conversions * $Campaign->getCpa();
   $revenue2 = $conversions2 * $Campaign->getCpa();
   $revenue3 = $conversions3 * $Campaign->getCpa();
   $spend = $spend2 = $spend3 = $clics * $cpc;
   $contribution = (($revenue - $spend) / $revenue) * 100;
   $contribution2 = (($revenue2 - $spend2) / $revenue2) * 100;
   $contribution3 = (($revenue3 - $spend3) / $revenue3) * 100;
   $cpa = $Campaign->getCpa();   
   }
   
// Esc. 5. Variación de CPA  
   if($status == 5){
   $clics = $ema3clics;
   $conversions = $ema3conv;
   $cr = $ema3conv / $ema3clics * 100;
   $revenue = $conversions * $cpa;
   $spend = $revenue - ($revenue * ($contribution / 100));    
   $cpc = $spend / $clics;   
   $cap = $Campaign->getCap();   
   }

// Esc. 6. Bajo el CPC e incremento CAP
   if($status == 6){
   $clics = $clics2 = $clics3 = $cap / $cpc;   
   $cr = $ema3conv / $ema3clics * 100;
   $cr2 = $ema3conv / $ema3clics * 0.8 * 100;
   $cr3 = $ema3conv / $ema3clics * 0.5 * 100;
   $conversions = $clics * $cr;
   $conversions2 = $clics2 * $cr2;
   $conversions3 = $clics3 * $cr3;
   $revenue = $conversions * $Campaign->getCpa();
   $revenue2 = $conversions2 * $Campaign->getCpa();
   $revenue3 = $conversions3 * $Campaign->getCpa();
   $spend = $spend2 = $spend3 = $clics * $cpc;
   $contribution = (($revenue - $spend) * 100) / $revenue;
   $contribution2 = (($revenue2 - $spend2) * 100) / $revenue2;
   $contribution3 = (($revenue3 - $spend3) * 100) / $revenue3;
   $cpa = $Campaign->getCpa();   
   }
      
// Data
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   
// Encabezados
   $html.= '<tr class="report-header">';
   $html.= '<th>'.CONTRIBUCION.'</th>';
   $html.= '<th>'.CLICS.'</th>';
   $html.= '<th>'.CONVERSIONES.'</th>';
   $html.= '<th>'.CONVERSIONRATE.'</th>';
   $html.= '<th>Spend</th>';
   $html.= '<th>CPA</th>';
   $html.= '<th>Revenue</th>';
   $html.= '<th>CPC</th>';
   $html.= '<th>CAP</th>';
   $html.= '</tr>';
      
   if($status != 0){
   for($i=1; $i<=$lines; $i++){
   
   switch($i){
   case 2: 
    $clics = $clics2;
    $cr = $cr2;
    $conversions = $conversions2;
    $spend = $spend2;
    $revenue = $revenue2;
    $contribution = $contribution2; 
   break;
   
   case 3: 
    $clics = $clics3;
    $cr = $cr3;
    $conversions = $conversions3;
    $spend = $spend3;
    $revenue = $revenue3;
    $contribution = $contribution3; 
   break;
   
   case 4: 
    $clics = $clics4;
    $cr = $cr4;
    $conversions = $conversions4;
    $spend = $spend4;
    $revenue = $revenue4;
    $contribution = $contribution4; 
   break;
   
   default: 
    $clics = $clics;
    $cr = $cr;
    $conversions = $conversions;
    $spend = $spend;
    $revenue = $revenue;
    $contribution = $contribution; 
   break;
   }
   
   $html.= '<tr class="report-body">';
   $html.= '<td ';
   if($status == 1 or $status == 5) $html.= 'class="yellow"';
   $html.= '>'.percent($contribution).'</td>';
   $html.= '<td ';
   if($status == 2 or $status == 6) $html.= 'class="yellow"';
   $html.= '>'.number($clics, false).'</td>';
   $html.= '<td>'.number($conversions, false).'</td>';
   $html.= '<td>'.percent($cr, true, 4).'</td>';
   $html.= '<td>'.precio($spend).'</td>';
   $html.= '<td ';
   if($status == 5) $html.= 'class="yellow"';
   $html.= '>'.precio($cpa).'</td>';
   $html.= '<td>'.precio($revenue).'</td>';
   $html.= '<td ';
   if($status != 4) $html.= 'class="yellow"';
   $html.= '>'.precio($cpc, true, 4).'</td>';   
   $html.= '<td ';
   if($spend < $cap) $html.= 'class="yellow"'; else $html.= 'class="red"';
   $html.= '>'.precio($cap).'</td>';
   $html.= '</tr>';
   }
   }else{
   $html.= '<tr><td colspan="'.$colspan.'" valign="middle" height="50px"><b>'.NOFORECAST.'</b></td></tr>';
   }
   $html.= '</table>';
   }
   if($action == 1) $html.= '</div>';
   $html.= reloadDOM();

   return $html;
   }
   
// Función para obtener gráficas y funciones por Account Manager
   function getGraphAM($action, $id_user=null, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Graphs;
   global $Users;

   $html = null;
      
// Tomo los datos
   $id_user = !empty($id_user) ? $id_user : null;
   $date_start = is_null($date_start) ? $Campaign->getDate(7) : $date_start;
   $date_end = is_null($date_end) ? $Campaign->getDate(1) : $date_end;
   $am = $Users->getUsersMedia(2);
   $qty = $Users->cantidadItems($am);
   $chart1 = $chart2 = $chart3 = null;
   $colspan = 1;
   
// Título
   $html.= '<table width="100%"><tr>';
   $html.= '<td class="section-title">'.REPORTE.' Account Managers</td>';
   $html.= '</tr></table>';
     
// Funciones
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="'.$colspan.'">';
   $html.= ' '.ucwords(DESDE).' ';
   $html.= '<input type="text" id="date-start" class="date-box-o" value="'.$date_start.'" />';
   $html.= ' '.HASTA.' ';
   $html.= '<input type="text" id="date-end" class="date-box-o" value="'.$date_end.'" />';
   $html.= '<input type="button" class="input-button" onclick="getGraphAM(\'1\', \''.$id_user.'\'); return false;" value="'.MODIFICAR.'" /></td>';
   $html.= '</tr>';
   $html.= '</table>';
   
// Gráficas   
   if($qty > 0){
// Gráfica de de incidencia en el revenue total   
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Account Manager", "'.REVENUE.'"],';
		
   while($row = mysql_fetch_array($am)){
   $data = $Graphs->getRevenue(2, $row['id_user'], null, null, null, $date_start, $date_end);
   $revenue = 0;
   while($row_am = mysql_fetch_array($data)){
   $revenue = $revenue + $row_am['revenue'];
   }
   $chart1.='["'.$row['name'].'", '.number_format($revenue, 2, ".", "").'],';
   }
   $chart1 = substr($chart1, 0, strlen($chart1) - 1);
   
	 $html.= $chart1.']);';
	 $html.= 'var options = {
            title: "'.REVENUEINCIDIDENCIA.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:0, top:50, width:"100%", height:"100%"},
            fontSize: 12,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true},
            is3D: true
            };

            var chart = new google.visualization.PieChart(document.getElementById("revenue_am"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';
   
// Gráfica de de incidencia en el spend total   
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Account Manager", "'.SPEND.'"],';
	 
   mysql_data_seek($am, 0);	
   while($row = mysql_fetch_array($am)){
   $data = $Graphs->getRevenue(2, $row['id_user'], null, null, null, $date_start, $date_end);
   $spend = 0;
   while($row_am = mysql_fetch_array($data)){
   $spend = $spend + $row_am['spent'];
   }
   $chart2.='["'.$row['name'].'", '.number_format($spend, 2, ".", "").'],';
   }
   $chart2 = substr($chart2, 0, strlen($chart2) - 1);
   
	 $html.= $chart2.']);';
	 $html.= 'var options = {
            title: "'.SPENDINCIDIDENCIA.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:0, top:50, width:"100%", height:"100%"},
            fontSize: 12,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true},
            is3D: true
            };

            var chart = new google.visualization.PieChart(document.getElementById("spend_am"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';

// Gráfica de contribución acumulada   
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Account Manager", "'.CONTRIBUCION.'"],';
	 
   mysql_data_seek($am, 0);	
   while($row = mysql_fetch_array($am)){
   $data = $Graphs->getRevenue(2, $row['id_user'], null, null, null, $date_start, $date_end);
   $contribution = 0;
   while($row_am = mysql_fetch_array($data)){
   $contribution = $contribution + ($row_am['revenue'] - $row_am['spent']);
   }
   $chart3.='["'.$row['name'].'", '.number_format($contribution, 2, ".", "").'],';
   }
   $chart3 = substr($chart3, 0, strlen($chart3) - 1);
   
	 $html.= $chart3.']);';
	 $html.= 'var options = {
            title: "'.CONTRIBUCIONACUMULADA.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:110, top:50, width:"100%"},
            hAxis: {slantedText:false, slantedTextAngle: 90, gridlines: {count: 15}, minValue: 0},
            vAxis: {minValue: 0, format:"USD #", color: "#fff"},
            fontSize: 12,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true}
            };

            var chart = new google.visualization.BarChart(document.getElementById("cont_am"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';
         
// Imprimo las gráficas   
   $html.= '<div id="revenue_am" class="box-50 box-float"></div>';
   $html.= '<div id="spend_am" class="box-50 box-float"></div>';
   $html.= '<div id="cont_am" class="box box-float"></div>';

   $html.= reloadDOM();
   
   }else{
   
   $html.= '<table><tr><td align="center" height="30px"><b>'.NOINFO.'</b></td></tr></table>';
   
   }
   
   return $html;
   }
               
// Función para obtener gráficas y funciones por campaña
   function getGraphCampaigns($id_user=null, $id_campaign=null, $id_network=0, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Graphs;
   global $Users;

   $html = null;
      
// Tomo los datos
   $id_user = !empty($id_user) ? $id_user : null;
   $date_start = is_null($date_start) ? $Campaign->getDate(7) : $date_start;
   $date_end = is_null($date_end) ? $Campaign->getDate(1) : $date_end;
   $data = $Graphs->getRevenue(2, $id_user, null, $id_campaign, $id_network, $date_start, $date_end);
   $qty = $Graphs->cantidadItems($data);
   $chart1 = $chart2 = $chart3 = $chart4 = null;
   $colspan = 1;
   
// Título
   $Campaign->getCampaigns(1, $id_campaign);
   $html.= '<input type="hidden" id="id_user" value="'.$id_user.'" />';
   $html.= '<table width="100%"><tr>';
   $html.= '<td class="section-title">'.REPORTE.' '.$Campaign->getCampaign().' ('.$id_campaign.') <small>'.$Campaign->getProduct().'</small></td>';
   $html.= '<td align="right" class="report-extra" nowrap><h3>'.$Campaign->getOpp().'</h3></td>';
   $html.= '</tr></table>';
      
// Funciones
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="'.$colspan.'">';
   $html.= ' '.ucwords(DESDE).' ';
   $html.= '<input type="text" id="date-start" class="date-box-o" value="'.$date_start.'" />';
   $html.= ' '.HASTA.' ';
   $html.= '<input type="text" id="date-end" class="date-box-o" value="'.$date_end.'" />';
   $html.= ' '.REDES.' '.getComboNetworks(1, $id_user, $id_network, $date_start, $date_end);
   $html.= '<input type="button" class="input-button" onclick="getGraphCampaigns(\'2\', \''.$id_campaign.'\');" value="'.MODIFICAR.'" /></td>';
   $html.= '</tr>';
   $html.= '</table>';
   
// Gráficas   
   if($qty > 0){
// Gráfica de revenue, spend y contribución por día   
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Day", "'.REVENUE.'", "'.SPEND.'", "'.CONTRIBUCION.'"],';
		
   while($row = mysql_fetch_array($data)){
   $contribution = $row['revenue'] - $row['spent'];
   $chart1.='["'.$row['days'].'", '.number_format($row['revenue'], 2, ".", "").', '.number_format($row['spent'], 2, ".", "").', '.number_format($contribution, 2, ".", "").'],';
   }
   $chart1 = substr($chart1, 0, strlen($chart1) - 1);
   
	 $html.= $chart1.']);';
	 $html.= 'var options = {
            title: "'.REVENUE.' / '.SPEND.' / '.CONTRIBUCION.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:80, top:30, width:"80%"},
            hAxis: {slantedText:true, slantedTextAngle: 70},
            vAxis: {minValue: 0, format:"USD #"},
            lineWidth: 2,
            fontSize: 12,
            pointSize: 7,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true}
            };

            var chart = new google.visualization.AreaChart(document.getElementById("revenue_spent"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';
   
// Gráfica de contribución media 
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Day", "'.CONTRIBUCIONMEDIA.'", "'.CONTRIBUCIONMINIMA.' (30%)"],';
	   
   mysql_data_seek($data, 0);	
   while($row = mysql_fetch_array($data)){
   $diff = $row['revenue'] - $row['spent'];
   $contribution = @($diff*100/$row['revenue']);
   $chart2.='["'.$row['days'].'", '.number_format($contribution, 2, ".", "").', 30],';
   }
   $chart2 = substr($chart2, 0, strlen($chart2) - 1);
   
	 $html.= $chart2.']);';
	 $html.= 'var options = {
            title: "'.CONTRIBUCIONMEDIA.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:80, top:30, width:"80%"},
            hAxis: {slantedText:true, slantedTextAngle: 70},
            vAxis: {minValue: 0, format:"% #,##"},
            lineWidth: 2,
            fontSize: 12,
            pointSize: 7,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true},
            curveType: "function"
            };

            var chart = new google.visualization.LineChart(document.getElementById("contribution_media"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';
   
// Gráfica de contribución acumulada 
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Day", "'.CONTRIBUCIONACUMULADA.'"],';
	
   mysql_data_seek($data, 0);
   $cumulated = 0;	
   while($row = mysql_fetch_array($data)){
   $contribution = $row['revenue'] - $row['spent'];
   $cumulated = $cumulated + $contribution;
   $chart3.='["'.$row['days'].'", '.number_format($cumulated, 2, ".", "").'],';
   }
   $chart3 = substr($chart3, 0, strlen($chart3) - 1);
   
	 $html.= $chart3.']);';
	 $html.= 'var options = {
            title: "'.CONTRIBUCIONACUMULADA.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:80, top:30, width:"80%"},
            hAxis: {slantedText:true, slantedTextAngle: 70},
            vAxis: {minValue: 0, format:"USD #"},
            lineWidth: 2,
            fontSize: 12,
            pointSize: 7,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true}
            };

            var chart = new google.visualization.AreaChart(document.getElementById("contribution_cumulated"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';

// Gráfica de contribución media 
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Day", "'.CONVERSIONES.'", "'.CONVERSIONMEDIA.'"],'; 

// Media exponencial 7 días Conversion Rate (período independiente del rango de fechas seleccionado) 
   $date_start_cr = $Campaign->getDate(8, $date_end);
   $ema7cr = 0;
   mysql_data_seek($data, 0);
   while($row = mysql_fetch_array($data)){
   if($row['date'] > $date_start_cr){
   $cr = $row['conversions'] / $row['clics'];
   $ema7cr = $ema7cr + ($cr - $ema7cr) * (2/(7+1));
   }else{
   $ema7cr = $row['conversions'] / $row['clics'];
   }
   $sma7cr = $row['clics'] * $ema7cr;
   $chart4.='["'.$row['days'].'", '.number_format($row['conversions'], 0, ".", "").', '.number_format($sma7cr, 2, ".", "").'],';
   }
   $chart4 = substr($chart4, 0, strlen($chart4) - 1);
   
	 $html.= $chart4.']);';
	 $html.= 'var options = {
            title: "'.CONVERSIONMEDIA.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:80, top:30, width:"80%"},
            hAxis: {slantedText:true, slantedTextAngle: 70},
            vAxis: {minValue: 0, format:"#"},
            lineWidth: 2,
            fontSize: 12,
            pointSize: 7,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true},
            curveType: "function"
            };

            var chart = new google.visualization.LineChart(document.getElementById("sma7cr_media"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';
      
// Imprimo las gráficas   
   $html.= '<div id="revenue_spent" class="box"></div>';
   $html.= '<div id="contribution_media" class="box"></div>';
   $html.= '<div id="contribution_cumulated" class="box"></div>';
   $html.= '<div id="sma7cr_media" class="box"></div>';

   $html.= reloadDOM();
   
   }else{
   
   $html.= '<table><tr><td align="center" height="30px"><b>'.NOINFO.'</b></td></tr></table>';
   
   }
   
   return $html;
   }

// Función para obtener gráficas y funciones de performance de carga de conversiones
   function getGraphConversions($action, $id_user=null, $date=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Graphs;
   global $Users;

   $html = null;
      
// Tomo los datos
   $id_user = !empty($id_user) ? $id_user : null;
   $date = is_null($date) ? $Campaign->getDate(1) : $date;
   $am = $Users->getUsersMedia(2);
   $qty = $Users->cantidadItems($am);
   $chart1 = null;
   
// Título
   $html.= '<table width="100%"><tr>';
   $html.= '<td class="section-title">'.CONVERSIONESPERFORMANCE.'</td>';
   $html.= '</tr></table>';
     
// Funciones
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr class="report-functions">';
   $html.= '<td>';
   $html.= '<input type="text" id="date" class="date-box-t" value="'.$date.'" />';
   $html.= '<input type="button" class="input-button" onclick="getGraphConversions(\'1\', \''.$id_user.'\'); return false;" value="'.MODIFICAR.'" /></td>';
   $html.= '</tr>';
   $html.= '</table>';
   
// Gráficas   
   if($qty > 0){
// Gráfica de de incidencia en el revenue total   
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Account Manager", "'.CONVERSIONES.'"],';

   while($row = mysql_fetch_array($am)){
   $Graphs->getPerformanceTools($row['id_user'], $date, $date);
   if($Graphs->getCpConv() != 0 && $Graphs->getCampaigns() != 0){
   $conversions = $Graphs->getCpConv() / $Graphs->getCampaigns();
   }else{
   $conversions = 0;
   }
   
   $chart1.='["'.$row['name'].'", '.number_format($conversions, 2, ".", "").'],';
   }
   $chart1 = substr($chart1, 0, strlen($chart1) - 1);
   
	 $html.= $chart1.']);';
	 $html.= 'var options = {
            title: "'.CONVERSIONESPERFORMANCE.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:110, top:50, width:"100%"},
            hAxis: {slantedText:false, slantedTextAngle: 90, gridlines: {count: 15}, minValue: 0},
            vAxis: {minValue: 0, format:"#", color: "#fff"},
            fontSize: 12,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true}
            };

            var chart = new google.visualization.BarChart(document.getElementById("conversions_am"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';
                     
// Imprimo las gráficas   
   $html.= '<div id="conversions_am" class="box box-float"></div>';
   
   }else{
   
   $html.= '<table><tr><td align="center" height="30px"><b>'.NOINFO.'</b></td></tr></table>';
   
   }
   $html.= reloadDOM();
   
   return $html;
   }
   
// Función para obtener gráficas y funciones por Account Manager
   function getGraphNetworks($action, $id_network=null, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Graphs;
   global $Network;

   $html = null;
      
// Tomo los datos
   $id_network = !empty($id_network) ? $id_network : null;
   $date_start = is_null($date_start) ? $Campaign->getDate(7) : $date_start;
   $date_end = is_null($date_end) ? $Campaign->getDate(1) : $date_end;
   $networks = $Network->getNetworks(1, null, $id_network, $date_start, $date_end);
   $qty = $Network->cantidadItems($networks);
   $chart1 = $chart2 = $chart3 = $chart4 = null;
   $colspan = 1;
   
// Título
   $html.= '<table width="100%"><tr>';
   $html.= '<td class="section-title">'.REPORTE.' '.REDES.'</td>';
   $html.= '</tr></table>';
     
// Funciones
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="'.$colspan.'">';
   $html.= ' '.ucwords(DESDE).' ';
   $html.= '<input type="text" id="date-start" class="date-box-o" value="'.$date_start.'" />';
   $html.= ' '.HASTA.' ';
   $html.= '<input type="text" id="date-end" class="date-box-o" value="'.$date_end.'" />';
   $html.= '<input type="button" class="input-button" onclick="getGraphNetworks(\'1\', \''.$id_network.'\'); return false;" value="'.MODIFICAR.'" /></td>';
   $html.= '</tr>';
   $html.= '</table>';
   
// Gráficas   
   if($qty > 0){
// Gráfica de de incidencia en el revenue total   
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["'.RED.'", "'.REVENUE.'"],';
		
   while($row = mysql_fetch_array($networks)){
   $data = $Graphs->getRevenue(2, null, null, null, $row['id_network'], $date_start, $date_end);
   $revenue = 0;
   while($row_net = mysql_fetch_array($data)){
   $revenue = $revenue + $row_net['revenue'];
   }
   $chart1.='["'.$row['network'].'", '.number_format($revenue, 2, ".", "").'],';
   }
   $chart1 = substr($chart1, 0, strlen($chart1) - 1);
   
	 $html.= $chart1.']);';
	 $html.= 'var options = {
            title: "'.REVENUEINCIDIDENCIA.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:0, top:50, width:"100%", height:"100%"},
            fontSize: 12,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true},
            is3D: true
            };

            var chart = new google.visualization.PieChart(document.getElementById("revenue_net"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';
   
// Gráfica de de incidencia en el spend total   
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["'.RED.'", "'.SPEND.'"],';
	 
   mysql_data_seek($networks, 0);	
   while($row = mysql_fetch_array($networks)){
   $data = $Graphs->getRevenue(2, null, null, null, $row['id_network'], $date_start, $date_end);
   $spend = 0;
   while($row_net = mysql_fetch_array($data)){
   $spend = $spend + $row_net['spent'];
   }
   $chart2.='["'.$row['network'].'", '.number_format($spend, 2, ".", "").'],';
   }
   $chart2 = substr($chart2, 0, strlen($chart2) - 1);
   
	 $html.= $chart2.']);';
	 $html.= 'var options = {
            title: "'.SPENDINCIDIDENCIA.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:0, top:50, width:"100%", height:"100%"},
            fontSize: 12,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true},
            is3D: true
            };

            var chart = new google.visualization.PieChart(document.getElementById("spend_net"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';

// Gráfica de contribución acumulada   
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Account Manager", "'.CONTRIBUCION.'"],';
	 
   mysql_data_seek($networks, 0);
   while($row = mysql_fetch_array($networks)){
   $data = $Graphs->getRevenue(2, null, null, null, $row['id_network'], $date_start, $date_end);
   $contribution = 0;
   while($row_net = mysql_fetch_array($data)){
   $contribution = $contribution + ($row_net['revenue'] - $row_net['spent']);
   }
   $chart3.='["'.$row['network'].'", '.number_format($contribution, 2, ".", "").'],';
   }
   $chart3 = substr($chart3, 0, strlen($chart3) - 1);
   
	 $html.= $chart3.']);';
	 $html.= 'var options = {
            title: "'.CONTRIBUCIONACUMULADA.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:80, top:50, width:"100%"},
            hAxis: {slantedText:false, slantedTextAngle: 90, gridlines: {count: 15}, minValue: 0},
            vAxis: {minValue: 0, format:"USD #", color: "#fff"},
            fontSize: 12,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true}
            };

            var chart = new google.visualization.BarChart(document.getElementById("cont_net"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';
   
// Gráfica de spend acumulado   
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Account Manager", "'.CONTRIBUCION.'"],';
	 
   mysql_data_seek($networks, 0);	
   while($row = mysql_fetch_array($networks)){
   $data = $Graphs->getRevenue(2, null, null, null, $row['id_network'], $date_start, $date_end);
   $spend = 0;
   while($row_net = mysql_fetch_array($data)){
   $spend = $spend + $row_net['spent'];
   }
   $chart4.='["'.$row['network'].'", '.number_format($spend, 2, ".", "").'],';
   }
   $chart4 = substr($chart4, 0, strlen($chart4) - 1);
   
	 $html.= $chart4.']);';
	 $html.= 'var options = {
            title: "'.SPEND.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:80, top:50, width:"100%"},
            hAxis: {slantedText:false, slantedTextAngle: 90, gridlines: {count: 15}, minValue: 0},
            vAxis: {minValue: 0, format:"USD #", color: "#fff"},
            fontSize: 12,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true}
            };

            var chart = new google.visualization.BarChart(document.getElementById("spend_cum_net"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';
            
// Imprimo las gráficas   
   $html.= '<div id="revenue_net" class="box-50 box-float"></div>';
   $html.= '<div id="spend_net" class="box-50 box-float"></div>';
   $html.= '<div id="cont_net" class="box box-float"></div>';
   $html.= '<div id="spend_cum_net" class="box box-float"></div>';

   $html.= reloadDOM();
   
   }else{
   
   $html.= '<table><tr><td align="center" height="30px"><b>'.NOINFO.'</b></td></tr></table>';
   
   }
   
   return $html;
   }

// Función para obtener gráficas y funciones para análisis operativo
   function getGraphOperative($date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Graphs;
   global $Users;

   $html = null;
      
// Tomo los datos
   $date_start = is_null($date_start) ? $Campaign->getDate(7) : $date_start;
   $date_end = is_null($date_end) ? $Campaign->getDate(1) : $date_end;
   $am = $Users->getUsersMedia(2);
   $qty = $Users->cantidadItems($am);
   $chart1 = $chart2 = $chart3 = $chart4 = $chart5 = $chart6 = null;
   $colspan = 1;
   
// Título
   $html.= '<table width="100%"><tr>';
   $html.= '<td class="section-title">'.REPORTE.' '.PERFORMANCEOPERATIVA.'</td>';
   $html.= '</tr></table>';
     
// Funciones
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="'.$colspan.'">';
   $html.= ' '.ucwords(DESDE).' ';
   $html.= '<input type="text" id="date-start" class="date-box-o" value="'.$date_start.'" />';
   $html.= ' '.HASTA.' ';
   $html.= '<input type="text" id="date-end" class="date-box-o" value="'.$date_end.'" />';
   $html.= '<input type="button" class="input-button" onclick="getGraphOperative(); return false;" value="'.MODIFICAR.'" /></td>';
   $html.= '</tr>';
   $html.= '</table>';
   
// Gráficas   
   if($qty > 0){
// Gráfica de incidencia en el uso del changelog   
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Account Manager", "'.CHANGELOGUSE.'"],';
		
   while($row = mysql_fetch_array($am)){
   $Graphs->getPerformanceTools($row['id_user'], $date_start, $date_end);
   $chart1.='["'.$row['name'].'", '.number_format($Graphs->getChangeLog(), 2, ".", "").'],';
   }
   $chart1 = substr($chart1, 0, strlen($chart1) - 1);
   
	 $html.= $chart1.']);';
	 $html.= 'var options = {
            title: "'.CHANGELOGINCIDENCIA.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:0, top:50, width:"100%", height:"100%"},
            fontSize: 12,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true},
            is3D: true
            };

            var chart = new google.visualization.PieChart(document.getElementById("changelog_am"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';
   
// Gráfica de incidencia en el uso del forecast   
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Account Manager", "'.CHANGELOGUSE.'"],';
	 
   mysql_data_seek($am, 0);	
   while($row = mysql_fetch_array($am)){
   $Graphs->getPerformanceTools($row['id_user'], $date_start, $date_end);
   $chart2.='["'.$row['name'].'", '.number_format($Graphs->getForecast(), 2, ".", "").'],';
   }
   $chart2 = substr($chart2, 0, strlen($chart2) - 1);
   
	 $html.= $chart2.']);';
	 $html.= 'var options = {
            title: "'.FORECASTINCIDENCIA.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:0, top:50, width:"100%", height:"100%"},
            fontSize: 12,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true},
            is3D: true
            };

            var chart = new google.visualization.PieChart(document.getElementById("forecast_am"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';

// Gráfica de Nivel de Optimización (Entradas al Change Log / Campañas activas)   
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Account Manager", "'.NIVELOPTIMIZACION.'"],'; 
	 
   mysql_data_seek($am, 0);	
   while($row = mysql_fetch_array($am)){
   $Graphs->getPerformanceTools($row['id_user'], $date_start, $date_end);
   if($Graphs->getChangeLog() > 0){
   $optimization = $Graphs->getChangeLog() / $Graphs->getCampaigns() * 100;
   }else{
   $optimization = 0;
   }
   $chart3.='["'.$row['name'].'", '.number_format($optimization, 2, ".", "").'],';
   }
   
   $chart3 = substr($chart3, 0, strlen($chart3) - 1);
   
	 $html.= $chart3.']);';
	 $html.= 'var options = {
            title: "'.NIVELOPTIMIZACIONTITULO.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:110, top:50, width:"70%"},
            hAxis: {slantedText:false, slantedTextAngle: 90, gridlines: {count: 15}, minValue: 0},
            vAxis: {minValue: 0, format:"#,##", color: "#fff"},
            fontSize: 12,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true}
            };

            var chart = new google.visualization.BarChart(document.getElementById("optimization_am"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';
   
// Gráfica de Nivel de Forecast (Entradas al Forecast / Campañas activas)   
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Account Manager", "'.FORECASTOPTIMIZACION.'"],';
	 
   mysql_data_seek($am, 0);	
   while($row = mysql_fetch_array($am)){
   $Graphs->getPerformanceTools($row['id_user'], $date_start, $date_end);
   if($Graphs->getForecast() > 0){
   $optimization = $Graphs->getForecast() / $Graphs->getCampaigns();
   }else{
   $optimization = 0;
   }
   $chart4.='["'.$row['name'].'", '.number_format($optimization, 2, ".", "").'],';
   }
   $chart4 = substr($chart4, 0, strlen($chart4) - 1);
   
	 $html.= $chart4.']);';
	 $html.= 'var options = {
            title: "'.FORECASTOPTIMIZACIONTITULO.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:110, top:50, width:"70%"},
            hAxis: {slantedText:false, slantedTextAngle: 90, gridlines: {count: 15}, minValue: 0},
            vAxis: {minValue: 0, format:"#,##", color: "#fff"},
            fontSize: 12,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true}
            };

            var chart = new google.visualization.BarChart(document.getElementById("optimization_forecast_am"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';

// Gráfica de Optimización / Forecast (Cantidad de entradas al Change Log/ Cantidad de entradas al Forecast)  
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Account Manager", "'.OPTIMIZACIONFORECAST.'"],';
	 
   mysql_data_seek($am, 0);	
   while($row = mysql_fetch_array($am)){
   $Graphs->getPerformanceTools($row['id_user'], $date_start, $date_end);
   if($Graphs->getChangelog() != 0 && $Graphs->getForecast() != 0){
   $optimization = $Graphs->getChangelog() / $Graphs->getForecast();
   }else{
   $optimization = 0;
   }
   $chart5.='["'.$row['name'].'", '.number_format($optimization, 2, ".", "").'],';
   }
   $chart5 = substr($chart5, 0, strlen($chart5) - 1);
   
	 $html.= $chart5.']);';
	 $html.= 'var options = {
            title: "'.OPTIMIZACIONFORECASTTITULO.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:110, top:50, width:"70%"},
            hAxis: {slantedText:false, slantedTextAngle: 90, gridlines: {count: 15}, minValue: 0},
            vAxis: {minValue: 0, format:"#,##", color: "#fff"},
            fontSize: 12,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true}
            };

            var chart = new google.visualization.BarChart(document.getElementById("opt_fc_am"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';

// Gráfica de tiempo de uso  
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Account Manager", "'.OPTIMIZACIONTIEMPO.' / '.HORAS.'"],';
	 
   mysql_data_seek($am, 0);	
   while($row = mysql_fetch_array($am)){
   $Graphs->getUsageTime($row['id_user'], $date_start, $date_end);
   if($Graphs->getAvg() != 0){
   $spendtime = $Graphs->getAvg();
   }else{
   $spendtime = 0;
   }
   $chart6.='["'.$row['name'].'", '.number_format($spendtime, 2, ".", "").'],';
   }
   $chart6 = substr($chart6, 0, strlen($chart6) - 1);
   
	 $html.= $chart6.']);';
	 $html.= 'var options = {
            title: "'.OPTIMIZACIONTIEMPO.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:110, top:50, width:"70%"},
            hAxis: {slantedText:false, slantedTextAngle: 90, gridlines: {count: 15}, minValue: 0},
            vAxis: {minValue: 0, format:"#,##", color: "#fff"},
            fontSize: 12,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true}
            };

            var chart = new google.visualization.BarChart(document.getElementById("opt_time_am"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';
                  
// Imprimo las gráficas   
   $html.= '<div id="changelog_am" class="box-50 box-float"></div>';
   $html.= '<div id="forecast_am" class="box-50 box-float"></div>';
   $html.= '<div id="optimization_am" class="box box-float"></div>';
   $html.= '<div id="optimization_forecast_am" class="box box-float"></div>';
   $html.= '<div id="opt_fc_am" class="box box-float"></div>';
   $html.= '<div id="opt_time_am" class="box box-float"></div>';

   $html.= reloadDOM();
   
   }else{
   
   $html.= '<table><tr><td align="center" height="30px"><b>'.NOINFO.'</b></td></tr></table>';
   
   }
   
   return $html;
   }
      
// Función para obtener gráficas por oprtunidad
   function getGraphOpps($id_user=null, $id_opp=null, $id_network=0, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Graphs;

   $html = null;
      
// Tomo los datos
   $id_user = !empty($id_user) ? $id_user : null;
   $date_start = is_null($date_start) ? $Campaign->getDate(7) : $date_start;
   $date_end = is_null($date_end) ? $Campaign->getDate(1) : $date_end;
   $data = $Graphs->getRevenue(2, $id_user, $id_opp, null, $id_network, $date_start, $date_end);
   $qty = $Graphs->cantidadItems($data);
   $chart1 = $chart2 = $chart3 = null;
   $colspan = 1;
   
// Título
   $Campaign->getOpps(1, $id_opp);
   $html.= '<input type="hidden" id="id_user" value="'.$id_user.'" />';
   $html.= '<table width="100%"><tr>';
   $html.= '<td class="section-title">'.REPORTE.' '.$Campaign->getOpp().'</td>';
   $html.= '<td align="right" class="report-extra" nowrap><h3>'.$Campaign->getClient().'</h3></td>';
   $html.= '</tr></table>';
      
// Funciones
// Funciones
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="'.$colspan.'">';
   $html.= ' '.ucwords(DESDE).' ';
   $html.= '<input type="text" id="date-start" class="date-box-o" value="'.$date_start.'" />';
   $html.= ' '.HASTA.' ';
   $html.= '<input type="text" id="date-end" class="date-box-o" value="'.$date_end.'" />';
   $html.= ' '.REDES.' '.getComboNetworks(1, $id_user, $id_network, $date_start, $date_end);
   $html.= '<input type="button" class="input-button" onclick="getGraphOpps(\'2\', \''.$id_opp.'\');" value="'.MODIFICAR.'" /></td>';
   $html.= '</tr>';
   $html.= '</table>';
   
// Gráficas   
   if($qty > 0){
// Gráfica de revenue, spend y contribución por día   
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Day", "'.REVENUE.'", "'.SPEND.'", "'.CONTRIBUCION.'"],';
		
   while($row = mysql_fetch_array($data)){
   $contribution = $row['revenue'] - $row['spent'];
   $chart1.='["'.$row['days'].'", '.number_format($row['revenue'], 2, ".", "").', '.number_format($row['spent'], 2, ".", "").', '.number_format($contribution, 2, ".", "").'],';
   }
   $chart1 = substr($chart1, 0, strlen($chart1) - 1);
   
	 $html.= $chart1.']);';
	 $html.= 'var options = {
            title: "'.REVENUE.' / '.SPEND.' / '.CONTRIBUCION.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:80, top:30, width:"80%"},
            hAxis: {slantedText:true, slantedTextAngle: 70},
            vAxis: {minValue: 0, format:"USD #"},
            lineWidth: 2,
            fontSize: 12,
            pointSize: 7,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true}
            };

            var chart = new google.visualization.AreaChart(document.getElementById("revenue_spent"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';
   
// Gráfica de contribución media 
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Day", "'.CONTRIBUCIONMEDIA.'", "'.CONTRIBUCIONMINIMA.' (30%)"],';
	
  // $cont_media7 = $cont_yesterday + ($cont_today - $cont_yesterday) * (2/7+1);
	   
   mysql_data_seek($data, 0);	
   while($row = mysql_fetch_array($data)){
   $diff = $row['revenue'] - $row['spent'];
   $contribution = @($diff*100/$row['revenue']);
   $chart2.='["'.$row['days'].'", '.number_format($contribution, 2, ".", "").', 30],';
   }
   $chart2 = substr($chart2, 0, strlen($chart2) - 1);
   
	 $html.= $chart2.']);';
	 $html.= 'var options = {
            title: "'.CONTRIBUCIONMEDIA.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:80, top:30, width:"80%"},
            hAxis: {slantedText:true, slantedTextAngle: 70},
            vAxis: {minValue: 0, format:"% #,##"},
            lineWidth: 2,
            fontSize: 12,
            pointSize: 7,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true},
            curveType: "function"
            };

            var chart = new google.visualization.LineChart(document.getElementById("contribution_media"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';
   
// Gráfica de contribución acumulada 
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Day", "'.CONTRIBUCIONACUMULADA.'"],';
	
   mysql_data_seek($data, 0);
   $cumulated = 0;	
   while($row = mysql_fetch_array($data)){
   $contribution = $row['revenue'] - $row['spent'];
   $cumulated = $cumulated + $contribution;
   $chart3.='["'.$row['days'].'", '.number_format($cumulated, 2, ".", "").'],';
   }
   $chart3 = substr($chart3, 0, strlen($chart3) - 1);
   
	 $html.= $chart3.']);';
	 $html.= 'var options = {
            title: "'.CONTRIBUCIONACUMULADA.'",
            animation: {easing: "inAndOut"},
            chartArea:{left:80, top:30, width:"80%"},
            hAxis: {slantedText:true, slantedTextAngle: 70},
            vAxis: {minValue: 0, format:"USD #"},
            lineWidth: 2,
            fontSize: 12,
            pointSize: 7,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true}
            };

            var chart = new google.visualization.AreaChart(document.getElementById("contribution_cumulated"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<script type="text/javascript">drawChart();</script>';
   
// Imprimo las gráficas   
   $html.= '<div id="revenue_spent" class="box"></div>';
   $html.= '<div id="contribution_media" class="box"></div>';
   $html.= '<div id="contribution_cumulated" class="box"></div>';

   $html.= reloadDOM();
   
   }else{
   
   $html.= '<table><tr><td align="center" height="30px"><b>'.NOINFO.'</b></td></tr></table>';
   
   }
   
   return $html;
   }
   
// Función para obtener gráfico con overall de un usuario 
   function getGraphOverall($id_user=null, $id_network=0, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Graphs;

   $html = null;
      
// Tomo los datos
   $id_user = !empty($id_user) ? $id_user : null;
   $date_start = is_null($date_start) ? $Campaign->getDate(7) : $date_start;
   $date_end = is_null($date_end) ? $Campaign->getDate(1) : $date_end;
   $data = $Graphs->getRevenue(2, $id_user, null, null, $id_network, $date_start, $date_end);
   $qty = $Graphs->cantidadItems($data);
   $chart = null;
   
   if($qty > 0){  
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Day", "'.REVENUE.'", "'.SPEND.'", "'.CONTRIBUCION.'"],';
		
   while($row = mysql_fetch_array($data)){
   $contribution = $row['revenue'] - $row['spent'];
   $chart.='["'.$row['days'].'", '.number_format($row['revenue'], 2, ".", "").', '.number_format($row['spent'], 2, ".", "").', '.number_format($contribution, 2, ".", "").'],';
   }
   $chart = substr($chart, 0, strlen($chart) - 1);
   
	 $html.= $chart.']);';
	 $html.= 'var options = {
            title: "",
            animation: {easing: "inAndOut"},
            chartArea:{left:80, top:30, width:"80%"},
            hAxis: {slantedText:true, slantedTextAngle: 70},
            vAxis: {minValue: 0, format:"USD #"},
            lineWidth: 2,
            fontSize: 12,
            pointSize: 7,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true}
            };

            var chart = new google.visualization.AreaChart(document.getElementById("revenue_spent"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<table width="100%"><tr>';
   $html.= '<td class="section-title">'.REPORTEGENERAL.'</td>';
   $html.= '<td align="right" class="report-date" width="190px" nowrap>'.date2sp($date_start).' &raquo; '.date2sp($date_end).'</td>';
   $html.= '</tr></table>';
   $html.= '<div id="revenue_spent" class="box"></div>';

   $html.= '<script type="text/javascript">drawChart();</script>';
   $html.= reloadDOM();
   
   }else{
   
   $html.= '<table><tr><td align="center" height="30px"><b>'.NOINFO.'</b></td></tr></table>';
   
   }
   
   return $html;
   }

// Función para obtener gráfico con overall de un usuario 
   function getGraphOverallPublishers($id_country=0, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Graphs;

   $html = null;
      
// Tomo los datos
   $date_start = is_null($date_start) ? $Campaign->getDate(6) : $date_start;
   $date_end = is_null($date_end) ? $Campaign->getDate(0) : $date_end;
   $data = $Graphs->getPublishersPerformance($id_country, $date_start, $date_end);
   $qty = $Graphs->cantidadItems($data);
   $chart = null;
   
   if($qty > 0){  
	 $html.= '<script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart(){
            var data = google.visualization.arrayToDataTable([';
	 $html.= '["Day", "'.IMPRESIONES.'"],';
		
   while($row = mysql_fetch_array($data)){
   $chart.='["'.$row['days'].'", '.number_format($row['impressions'], 2, ".", "").'],';
   }
   $chart = substr($chart, 0, strlen($chart) - 1);
   
	 $html.= $chart.']);';
	 $html.= 'var options = {
            title: "",
            animation: {easing: "inAndOut"},
            chartArea:{left:80, top:30, width:"80%"},
            hAxis: {slantedText:true, slantedTextAngle: 70},
            vAxis: {minValue: 0},
            lineWidth: 2,
            fontSize: 12,
            pointSize: 7,
            tooltip: {textStyle: {color: "#333", fontSize: 11}, showColorCode: true}
            };

            var chart = new google.visualization.AreaChart(document.getElementById("impressions"));
            chart.draw(data, options);
            }
            </script>';
   $html.= '<table width="100%"><tr>';
   $html.= '<td class="section-title">'.REPORTEPUBLISHERS.'</td>';
   $html.= '<td align="right" class="report-date" width="190px" nowrap>'.date2sp($date_start).' &raquo; '.date2sp($date_end).'</td>';
   $html.= '</tr></table>';
   $html.= '<div id="impressions" class="box"></div>';

   $html.= '<script type="text/javascript">drawChart();</script>';
   $html.= reloadDOM();
   
   }else{
   
   $html.= '<table><tr><td align="center" height="30px"><b>'.NOINFO.'</b></td></tr></table>';
   
   }
   
   return $html;
   }
   
// Función para obtener usuarios
   /* Action 1: datos de un usuario particular por su id
      Action 2: datos de un usuario particular para el login
      Action 3: todos los usuarios */
   function getLogin($action, $id_user=null, $email=null, $password=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Users;
      
   $html = null;                                                                             
   
   if($action == 1){
   
   $html.= '<div class="login">';
   $html.= '<div class="login-sub-header">';
   $html.= '<img src="'.ROOT.'/images/logo.png" />';
   $html.= '</div>';
   $html.= '<div class="login-sub">';
   $html.= '<p><b>'.LOGINUSUARIO.'</b></p>';
   $html.= '<input type="text" id="email" autofocus="autofocus" value="" placeholder="'.LOGINUSUARIOPLACEHOLDER.'" class="login-textbox" autocomplete="off">';
   $html.= '<p><b>'.LOGINPASS.'</b></p>';
   $html.= '<input type="password" id="password" placeholder="'.LOGINPASSPLACEHOLDER.'" class="login-textbox" autocomplete="off">';
   $html.= '<p><input type="button" id="bt-login" value="'.LOGINACCEDER.'" class="login-btn" onclick="getLogin(\'2\');" /></p>';
   $html.= '</div>';
   $html.= '</div>';
   
   return $html;
      
   }else{                
   
   $password = base64_encode($password);
   
   $Users->getUsers(2, null, $email, $password);

   if($Users->getEmail() == $email && $Users->getPassword() == $password){
   $_SESSION['s_id_user'] = $Users->getIdUser();
   $_SESSION['s_name'] = $Users->getName();
   $_SESSION['s_email'] = $Users->getEmail();
   $_SESSION['s_level'] = $Users->getLevel();
   $_SESSION['s_status'] = $Users->getStatus();
   if(COOKIE) setcookie('adserver', $Users->getConCode(), time()+ 60 * 60 * 24 * 30, '/'); // Expira en 1 mes
   $Users->abmActivity($_SESSION['s_id_user'], null, 'login');
   return true;
   }else{
   return false;
   } 
   }   
   }

// Función para loguear si el usuario ya tiene guardada la cookie
   function getLoginCookie(){
// Instancio las clases dentro de la función
   global $DBase;
   global $Users;
      
   $Users->getUsers(4, null, null, null, $_COOKIE['adserver']);
   if(getLogin(2, null, $Users->getEmail(), base64_decode($Users->getPassword()))) header('Location: home.php');
   }
   
// Función para desloguear un usuario
   function getLogout(){
   session_destroy();
   if(isset($_COOKIE['adserver']) && COOKIE) setcookie('adserver', '', time()-42000, '/');
   header('Location: '.ROOT.'/index.php');  
   }
      
// Función para armar el menú
   function getMenu(){
// Instancio las clases dentro de la función
   global $DBase;
   global $Users;
   
   $Users->getDataLogin();
   
   $html = null;

// Parámetros adicionales   
   $parameters = $_GET;
   $addtourl = null;
   foreach ($parameters as $key=>$value){
   if($key != 'lang')
   $addtourl.="&".$key."=".$value;
   }
   
   $html.= '<div class="content100 login-data-user">';
   
   $html.= '<div class="txt-menu-login">';
   $html.= HOLA.', <b>'.acute($_SESSION['s_name']).'</b> ';
   $html.= '('.ULTIMOLOGIN.' '.$Users->getLastLogin().' GMT) | ';
   $html.= '<b>Logged time today:</b> '.$Users->getTimeLogin().' '.HORAS.' | ';
   $html.= '(<a href="'.$_SERVER['PHP_SELF'].'?lang=esp'.$addtourl.'" title="'.VERSIONESPANIOL.'" alt="'.VERSIONESPANIOL.'">es</a>) . ';
   $html.= '(<a href="'.$_SERVER['PHP_SELF'].'?lang=eng'.$addtourl.'" title="'.VERSIONINGLES.'" alt="'.VERSIONINGLES.'">en</a>) | ';
   $html.= '<a href="'.ROOT.'/logout.php">'.LOGOUT.'</a>';
   $html.= '</div>';
   $html.= '</div>';
   
   $html.= '<div class="menu-search-cp txt-search">';
   $html.= BUSCADORCAMPANIA.' <input type="text" placeholder="ID '.CAMPANIA.'" id="search-cp" value="" />';
   $html.= '</div>';

   $html.= '<a href="'.ROOT.'/home.php"><img src="'.ROOT.'/images/logo.png" class="header-logo" /></a>';
   
   $html.= '<ul id="nav-one" class="dropmenu">';
   $html.= '<li><a href="'.ROOT.'/dashboard.php">Dashboard</a>';
   $html.= '</li>';
   
   if($Users->permissions(1)){
   $html.= '<li><a href="#">Performance</a>';
   $html.= '<ul class="left">';
   $html.= '<li><a href="'.ROOT.'/home.php">'.REPORTES.'</a></li>';
   $html.= '<li><a href="'.ROOT.'/campaigns.php">'.CAMPANIAS.'</a></li>';
   $html.= '<li><a href="'.ROOT.'/create.php">'.CAMPANIASUPLOAD.'</a></li>';
   $html.= '<li><a href="'.ROOT.'/upload.php">'.CONVERSIONES.'</a></li>';
   $html.= '</ul>';
   $html.= '</li>';
   }
   
   if($Users->permissions(8)){
   $html.= '<li><a href="#">'.ANALISIS.'</a>';
   $html.= '<ul class="left">';
   $html.= '<li><a href="'.ROOT.'/analytics.php">'.CAMPANIAS.'</a></li>';
   $html.= '<li><a href="'.ROOT.'/accounts.php">'.OPTIMIZACION.'</a></li>';
   $html.= '<li><a href="'.ROOT.'/operative.php">'.PERFORMANCEOPERATIVA.'</a></li>';
   $html.= '<li><a href="'.ROOT.'/conversions.php">'.CONVERSIONES.'</a></li>';
   if(!ENV) $html.= '<li><a href="'.ROOT.'/clients.php">'.CLIENTES.'</a></li>';
   $html.= '<li><a href="'.ROOT.'/networks.php">'.REDES.'</a></li>';
   $html.= '</ul>';
   $html.= '</li>';
   }

   if($Users->permissions(4)){
   $html.= '<li><a href="#">'.PUBLISHERS.'</a>';
   $html.= '<ul class="left">';
   $html.= '<li><a href="'.ROOT.'/publishers.php">'.REPORTES.'</a></li>';
   $html.= '</ul>';
   $html.= '</li>';
   }
   
   /*   
   if($Users->permissions(2)) $html.= '<li><a href="'.ROOT.'/advertisers.php">'.ANUNCIANTES.'</a></li>';  
   if($Users->permissions(3)) $html.= '<li><a href="'.ROOT.'/affiliates.php">'.AFILIADOS.'</a></li>';
   if($Users->permissions(5)) $html.= '<li><a href="'.ROOT.'/redirects.php">'.REDIRECTS.'</a></li>';     
   if($Users->permissions(6)) $html.= '<li><a href="'.ROOT.'/templates.php">'.TEMPLATES.'</a></li>';   
   if($Users->permissions(7)) $html.= '<li><a href="'.ROOT.'/users.php">'.USUARIOS.'</a></li>';
   */ 
   
   $html.= '<li><a href="#">'.USUARIOS.'</a>';
   $html.= '<ul class="left">';
   $html.= '<li><a href="'.ROOT.'/messages.php">'.MENSAJES.'</a></li>';
   $html.= '</ul>';
   $html.= '</li>';  
   $html.= '</ul>';
      
   return $html;
   }

// Función para obtener lista de oportunidades/clientes
   /* Action 1: Inbox
      Action 2: Send */
   function getMessages($action, $id_user=0, $date=null, $status=0, $id_sender=0, $date_no=0){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Users;

   $html = null;
      
// Tomo los datos
   $date = is_null($date) ? $Campaign->getDate(0) : $date;
   
   $messages = $Users->getMessages($action, $id_user, $date, $status, $id_sender, $date_no);
   $qty = $Users->cantidadItems($messages);
   $users = $Users->getUsersMedia(2);
   $colspan = 4;

   $html.= '<table width="100%"><tr>';
   $html.= '<td class="section-title">'.MENSAJES.'</td>';
   $html.= '<td align="right"><a href="#" onclick="slideToggle(\'new-msg\');" class="bt-gral">'.NUEVOMENSAJE.'</a></td>';
   $html.= '</tr></table>';
   
   $html.= '<div id="new-msg" class="new-msg">';
   $html.= '<table width="100%">';
   $html.= '<tr>';
   $html.= '<td valign="top" width="100px"><b>'.PARA.'</b></td>';
   $html.= '<td>'; 
   $html.= '<select id="users-to" class="report-select">';
   $html.= '<option value="0">'.TODOS.'</option>';
   while($row = mysql_fetch_array($users)){
   $html.= '<option value="'.$row['id_user'].'">'.acute($row['name']).'</option>';
   }
   $html.= '</select>';
   $html.= '</td>';
   $html.= '</tr>';
   $html.= '<tr>';
   $html.= '<td valign="top"><b>'.MENSAJE.'</b></td>';
   $html.= '<td><textarea id="message-to" rows="5" cols="50"></textarea></td>';
   $html.= '</tr>';
   $html.= '<tr>';
   $html.= '<td>&nbsp;</td>';
   $html.= '<td><input type="button" onclick="abmMessages(\'1\'); return false;" value="'.ENVIAR.'" /></td>';
   $html.= '</tr>';
   $html.= '</table>';
   $html.= '</div>';
          
// Funciones
   $html.= '<input type="hidden" id="msg-user" value="'.$id_user.'" />';
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="3">';
   if($action == 1){
   $html.= '<b>Inbox</b> (<b>'.$qty.'</b>) &raquo; ';
   }else{
   $html.= '<b>'.ENVIADOS.'</b> (<b>'.$qty.'</b>) &raquo; ';   
   }
   $html.= getComboUsersMedia(1, $id_sender);
   $html.= '<input type="text" id="msg-date" class="date-box-t" value="'.$date.'" />';
   $html.= '<input type="checkbox" id="msg-date-no" value="'.$date_no.'" ';
   if(!empty($date_no)) $html.= 'checked';
   $html.= ' onclick="showDate();" /> '.TODASFECHAS.' ';
   $html.= '<select id="msg-status">';
   $html.= '<option value="0" selected>'.TODOS.'</option>';
   for($i=2; $i>=1; $i--){
   if($i == 2) $txt = TERMINADO; else $txt = ENPROCESO;
   $html.= '<option value="'.$i.'" ';
   if($i == $status) $html.= 'selected';
   $html.= '>'.$txt.'</option>';
   if($i == 1) $html.= '<br />';
   }
   $html.= '</select>';   
   $html.= '<input type="button" class="input-button" onclick="getMessages(\''.$action.'\'); return false;" value="'.FILTRAR.'" />';
   $html.= '</td>';
   $html.= '<td align="right">';
   if($action == 1){
   $html.= '<a href="#" onclick="getMessages(\'2\'); return false;">'.ENVIADOS.'</a> &raquo;';
   }else{
   $html.= '<a href="#" onclick="getMessages(\'1\'); return false;">Inbox</a> &raquo;';   
   }   
   $html.= '</td>';
   $html.= '</tr>';
   
// Encabezados
   $html.= '<tr class="report-header">';
   
   if($action == 1){
   $html.= '<th class="report-left">'.REMITENTE.'</th>';
   }else{
   $html.= '<th class="report-left">'.PARA.'</th>';   
   }
   $html.= '<th class="report-left">'.MENSAJE.'</th>';
   $html.= '<th class="report-left">'.ESTADO.'</th>';
   $html.= '<th class="report-right">'.FECHA.'</th>';   
   $html.= '</tr>';

// Mensajes
   if($qty > 0){   
   while($row = mysql_fetch_array($messages)){
   $html.= '<tr class="msg">';
   if($action == 1){
   $html.= '<td class="report-left" valign="top"><b>'.$row['name'].'</b></td>';
   }else{
   $html.= '<td class="report-left" valign="top"><b>'.$row['sendto'].'</b></td>';
   }   
   $html.= '<td width="60%" valign="top">'.$row['message'].'</td>';
   $html.= '<td valign="top">';
   if($action == 1){
   for($i=2; $i>=1; $i--){
   if($i == 2) $txt = TERMINADO; else $txt = ENPROCESO;
   $html.= '<input type="radio" name="status_'.$row['id_message'].'" value="'.$i.'" class="radio-button" ';
   if($row['status'] == $i) $html.= 'checked';
   $html.= ' onclick="abmMessages(\'2\', \''.$i.'\', \''.$row['id_message'].'\');" />'.$txt;
   if($i == 2) $html.= '<br />';
   }
   }else{
   if($row['status'] == 2) $html.= TERMINADO; else $html.= ENPROCESO;
   }             
   $html.= '</td>';
   $html.= '<td align="right" valign="top">'.$row['date'].'<br />'.$row['hour'].'</td>';   
   $html.= '</tr>';
   }
   }else{
   $html.= '<tr class="msg">';
   $html.= '<td colspan="'.$colspan.'" valign="middle" align="center" height="200px">'.NOMSG.'</td>';   
   $html.= '</tr>';   
   }   
   $html.= '</table>';

   $html.= reloadDOM();
   
   return $html;
   }
      
// Función para obtener lista de oportunidades/clientes
   /* Action 1: reporte por account manager
      Action 3: reporte general */
   function getOppsReport($action, $id_user=null, $id_opps=null, $id_network=0, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Users;

   $html = null;
      
// Tomo los datos
   $id_user = !empty($id_user) ? $id_user : null;
   $date_start = is_null($date_start) ? $Campaign->getDate(7) : $date_start;
   $date_end = is_null($date_end) ? $Campaign->getDate(1) : $date_end;
   $opps = $Campaign->getOppsReport($id_user, $id_network, $date_start, $date_end);
   $qty = $Campaign->cantidadItems($opps);
   $colspan = 13;
   $sum_impressions[] = $sum_clics[] = $sum_conversions[] = $sum_spent[] = $sum_cr[] = $sum_ecpc[] = $sum_ecpa[] = $sum_cpa[] = $sum_revenue[] = $sum_contribution_money[] = null;
    
// Funciones
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="'.$colspan.'">';
   $html.= 'Total (<b>'.$qty.'</b> '.OPORTUNIDADES.') '.DESDE.' ';
   $html.= '<input type="text" id="date-start" class="date-box-o" value="'.$date_start.'" />';
   $html.= ' '.HASTA.' ';
   $html.= '<input type="text" id="date-end" class="date-box-o" value="'.$date_end.'" />';   
   $html.= ' '.REDES.' '.getComboNetworks(1, $id_user, $id_network, $date_start, $date_end);
   if($action == 3){
   $html.= ' AM '.getComboUsersMedia(1, $id_user);
   }else{
   $html.= '<input type="hidden" id="users" value="'.$_SESSION['s_id_user'].'" />';
   }
   $html.= '<input type="button" class="input-button" onclick="getOppsReport(\''.$action.'\', \''.$id_user.'\'); return false;" value="'.MODIFICAR.'" />';
   $html.= '<a href="#" onclick="export2Excel(); return false;" alt="'.EXPORTAREXCEL.'" title="'.EXPORTAREXCEL.'"><img src="'.ROOT.'/images/ic_excel.gif" /></a>';
   $html.= '</td>';
   $html.= '</tr>';
   
// Encabezados
   $html.= '<tr class="report-header">';
   $html.= '<th class="report-left">'.CLIENTES.'</th>';
   $html.= '<th>Imp.</th>';
   $html.= '<th>Clics</th>';
   $html.= '<th>Spend</th>';
   $html.= '<th>Conv.</th>';
   // $html.= '<th>C.AS</th>';   
   $html.= '<th>CR</th>';
   $html.= '<th>eCPC</th>';
   $html.= '<th>eCPA</th>';
   $html.= '<th>Rate</th>';
   $html.= '<th>Revenue</th>';
   $html.= '<th>Cont. (%)</th>';
   $html.= '<th>Cont. ($)</th>';
   $html.= '<th>&nbsp;</th>';   
   $html.= '</tr>';
   
   if($qty > 0){
   $count = 0;     
   while($row = mysql_fetch_array($opps)){
   
   $Campaign->getOppsReportDetail($id_user, $row['id_opportunity'], $id_network, $date_start, $date_end);
   // Calculos
   $cr = $Campaign->getConversions() / $Campaign->getClics() * 100;
   $ecpc = $Campaign->getSpent() / $Campaign->getClics();
   if($Campaign->getConversions() != 0){
   $ecpa = $Campaign->getSpent() / $Campaign->getConversions();
   }else{
   $ecpa = 0;
   }
   $contribution_money = $Campaign->getRevenue() - $Campaign->getSpent();
   if($Campaign->getRevenue() != 0){ 
   $contribution = $contribution_money * 100 / $Campaign->getRevenue();
   }else{
   $contribution = 0;
   }
   
   $html.= '<tr class="report-body" alt="'.acute($row['opp']).' ('.acute($row['client']).')" title="'.acute($row['opp']).' ('.acute($row['client']).')">';
   $html.= '<td class="report-left" onclick="getCampaignsReport(\'1\', \''.$id_user.'\', \''.$row['id_opportunity'].'\'); return false;"><b>'.acute(limit_chars($row['opp'], 25)).'</b> <br /><small>('.$row['id_opportunity'].') '.acute($row['client']).'</small></td>';   
   $html.= '<td>'.number($Campaign->getImpressions(), false).'</td>';
   $html.= '<td>'.number($Campaign->getClics(), false).'</td>';
   $html.= '<td>'.precio($Campaign->getSpent()).'</td>';
   $html.= '<td>'.number($Campaign->getConversions(), false).'</td>';
   $html.= '<td>'.percent($cr).'</td>';
   $html.= '<td>'.precio($ecpc, true, 3).'</td>';
   $html.= '<td>'.precio($ecpa, true, 3).'</td>';
   $html.= '<td>'.precio($Campaign->getCpa()).'</td>';
   $html.= '<td>'.precio($Campaign->getRevenue()).'</td>';
   $html.= '<td>'.percent($contribution).'</td>';
   $html.= '<td>'.precio($contribution_money).'</td>';
   $html.= '<td align="right">';
   $html.= '<div class="report-alert-empty"></div>';
   $html.= '<div class="report-alert-empty"></div>';                    
   $html.= '<a href="#" onclick="getConversionsAS(\'1\', \''.$row['id_opportunity'].'\'); return false;" >
            <img src="'.ROOT.'/images/16-line-chart.png" alt="'.VERCONVAS.' '.acute($row['opp']).'" title="'.VERCONVAS.' '.acute($row['opp']).'" /></a>';
   $html.= '<a href="#" onclick="getGraphOpps(\'1\', \''.$row['id_opportunity'].'\'); return false;" >
            <img src="'.ROOT.'/images/17-bar-chart.png" alt="'.VERREPORTEDETALLE.' '.acute($row['opp']).'" title="'.VERREPORTEDETALLE.' '.acute($row['opp']).'" /></a>';          
   $html.= '</td>';   
   $html.= '</tr>';
   $html.= '<tr><td colspan="'.$colspan.'">';
   $html.= '<div id="campaigns_'.$row['id_opportunity'].'" class="campaigns"></div>';
   $html.= '</td></tr>'; 
   
// Agrego dentro del array para sumar o promediar al final
   $sum_impressions[$count] = $Campaign->getImpressions();
   $sum_clics[$count] = $Campaign->getClics();
   $sum_conversions[$count] = $Campaign->getConversions();
   $sum_spent[$count] = $Campaign->getSpent();
   $sum_cr[$count] = $cr;
   $sum_ecpc[$count] = $ecpc;
   $sum_ecpa[$count] = $ecpa;
   $sum_cpa[$count] = $Campaign->getCpa();
   $sum_revenue[$count] = $Campaign->getRevenue();
   $sum_contribution_money[$count] = $contribution_money; 
      
   $count++;
   }

   $html.= '<tr class="report-bottom">';
   $html.= '<td>&nbsp;</td>';
   $html.= '<td>'.number(array_sum($sum_impressions), false).'</td>';
   $html.= '<td>'.number(array_sum($sum_clics), false).'</td>';
   $html.= '<td>'.precio(array_sum($sum_spent)).'</td>';
   $html.= '<td>'.number(array_sum($sum_conversions), false).'</td>';
   // $html.= '<td>'.number(array_sum($sum_conversions_as), false).'</td>';
   $cr_total = array_sum($sum_conversions)/array_sum($sum_clics)*100;
   $html.= '<td>'.percent($cr_total).'</td>';
   $html.= '<td>&nbsp;</td>';
   $html.= '<td>&nbsp;</td>';
   $html.= '<td>&nbsp;</td>';
   $html.= '<td>'.precio(array_sum($sum_revenue)).'</td>';
   $contribution = array_sum($sum_contribution_money)*100/array_sum($sum_revenue);
   $html.= '<td>'.percent($contribution).'</td>';
   $html.= '<td>'.precio(array_sum($sum_contribution_money)).'</td>';
   $html.= '<td>&nbsp;</td>';   
   $html.= '</tr>';

   }else{
   
   $html.= '<tr><td colspan="'.$colspan.'" align="center" height="50px"><b>'.NOINFO.'</b></td></tr>';
   }
   
   $html.= '</table>';

   $html.= '<script type="text/javascript">drawChart();</script>';
   $html.= reloadDOM();
   
   return $html;
   }

// Función para obtener países y modelos para cada uno del publisher
   function getPublisherModels($id_publisher){
// Instancio las clases dentro de la función
   global $DBase;
   global $Publisher;

   $html = null;
   
   $countries = $Publisher->getPublisherModels($id_publisher);
   
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';   
   while($row = mysql_fetch_array($countries)){
   $html.= '<tr class="report-body report-body-no-line" id="country_'.$row['id_publisher_model'].'">';
   $html.= '<td class="report-left">'.$row['country_eng'].'</td>';
   $html.= '<td class="report-left">'.$row['model'].'</td>';
   $html.= '<td class="report-left">'.precio($row['value']).'</td>';
   $html.= '<td><input type="button" value="'.ELIMINAR.'" onclick="abmPublishersModels(\'3\', \''.$row['id_publisher_model'].'\'); return false;" /></td>';
   $html.= '</tr>';   
   }
   $html.= '</table>';
   
   return $html;   
   }
   
// Función para obtener perfil del publisher
   function getPublisherProfile($action, $id_publisher){
// Instancio las clases dentro de la función
   global $DBase;
   global $Publisher;

   $html = null;
      
// Tomo los datos
   $Publisher->getPublisherProfile($action, $id_publisher);
   $colspan = 4;
   
// Título
   $html.= '<input type="hidden" id="id_publisher" value="'.$id_publisher.'" />';
   $html.= '<table width="100%" cellspacing="0" cellpadding="0"><tr>';
   $html.= '<td class="section-title" colspan="'.$colspan.'">'.PUBLISHERPERFIL.'</td>';
   $html.= '</tr>';

// Encabezados
   $html.= '<tr class="report-header">';
   $html.= '<th colspan="'.$colspan.'" class="report-left">'.INFORMACIONCUENTA.'</th>'; 
   $html.= '</tr>';
   
// Perfil
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>'.NOMBRE.'</b></td>';
   $html.= '<td colspan="3" class="report-left"><input type="text" id="pub-name" value="'.$Publisher->getPublisher().'" size="35" /></td>';
   $html.= '</tr>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>'.COMERCIAL.'</b></td>';
   $html.= '<td colspan="3" class="report-left"><input type="text" id="pub-commercial" value="'.$Publisher->getCommercial().'" size="35" /></td>';
   $html.= '</tr>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>E-mail</b></td>';
   $html.= '<td colspan="3" class="report-left"><input type="text" id="pub-email" value="'.$Publisher->getEmail().'" size="35" /></td>';
   $html.= '</tr>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>'.TELEFONO.'</b></td>';
   $html.= '<td colspan="3" class="report-left"><input type="text" id="pub-phone" value="'.$Publisher->getPhone().'" size="35" /></td>';
   $html.= '</tr>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>'.DIRECCION.'</b></td>';
   $html.= '<td colspan="3" class="report-left"><input type="text" id="pub-address" value="'.$Publisher->getAddress().'" size="35" /></td>';
   $html.= '</tr>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>Zip Code</b></td>';
   $html.= '<td colspan="3" class="report-left"><input type="text" id="pub-zip" value="'.$Publisher->getZip().'" size="35" /></td>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>'.PAIS.'</b></td>';
   $html.= '<td colspan="3" class="report-left">';
   $html.= RenderCombo('pub-country-get', 'ads_countries', 'id_country', 'country_eng', 'country_eng ASC', $Publisher->getIdCountry());
   $html.= '</td>';
   $html.= '</tr>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>Tax ID</b></td>';
   $html.= '<td colspan="3" class="report-left"><input type="text" id="pub-taxid" value="'.$Publisher->getTaxId().'" size="35" /></td>';
   $html.= '</tr>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>Password</b></td>';
   $html.= '<td colspan="3" class="report-left"><input type="password" id="pub-password" value="'.$Publisher->getPassword().'" size="35" /></td>';
   $html.= '</tr>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>'.ESTADO.'</b></td>';
   $html.= '<td colspan="3" class="report-left">';
   $html.= '<select id="pub-status">';
   for($i=0; $i<2; $i++){
   switch($i){
   case 0: $txt = ACTIVO; break;
   case 1: $txt = INACTIVO; break;
   default:break;
   }
   $html.= '<option value="'.$i.'" ';
   if($Publisher->getStatus() ==  $i) $html.= 'sellected';
   $html.= '>'.$txt.'</option>';
   }
   $html.= '</select>';
   $html.= '</td>';
   $html.= '</tr>';
   
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td>&nbsp;</td>';
   $html.= '<td colspan="3" class="report-left"><input type="button" value="'.ACTUALIZAR.'" onclick="abmPublishersInformation(\'2\', \''.$id_publisher.'\'); return false;" /></td>';
   $html.= '</tr>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td colspan="'.$colspan.'">&nbsp;</td>';
   $html.= '</tr>';

// Información bancaria
   $html.= '<tr class="report-header">';
   $html.= '<th colspan="'.$colspan.'" class="report-left">'.INFORMACIONBANCO.'</th>'; 
   $html.= '</tr>';
   
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>'.BANCOBENEFICIARIO.'</b></td>';
   $html.= '<td class="report-left"><input type="text" id="pub-beneficiary" value="'.$Publisher->getBeneficiary().'" size="35" /></td>';
   $html.= '<td class="report-left"><b>PayPal Account</b></td>';
   $html.= '<td class="report-left"><input type="text" id="pub-paypal" value="'.$Publisher->getPaypalAccount().'" size="35" /></td>';
   $html.= '</tr>';
   
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>'.BANCODIRECCION.'</b></td>';
   $html.= '<td colspan="3" class="report-left"><input type="text" id="pub-ben-add" value="'.$Publisher->getBenAddress().'" size="35" /></td>';
   $html.= '</tr>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>'.BANCOCUENTA.'</b></td>';
   $html.= '<td colspan="3" class="report-left"><input type="text" id="pub-ben-acc" value="'.$Publisher->getBenAccount().'" size="35" /></td>';
   $html.= '</tr>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>'.BANCOBANCO.'</b></td>';
   $html.= '<td colspan="3" class="report-left"><input type="text" id="pub-ben-bank" value="'.$Publisher->getBenBank().'" size="35" /></td>';
   $html.= '</tr>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>'.BANCODIRECCIONBANCO.'</b></td>';
   $html.= '<td colspan="3" class="report-left"><input type="text" id="pub-ben-bank-add" value="'.$Publisher->getBankAddress().'" size="35" /></td>';
   $html.= '</tr>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>SWIFT Code</b></td>';
   $html.= '<td colspan="3" class="report-left"><input type="text" id="pub-ben-swift" value="'.$Publisher->getSwiftcode().'" size="35" /></td>';
   $html.= '</tr>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>ABA</b></td>';
   $html.= '<td colspan="3" class="report-left"><input type="text" id="pub-ben-aba" value="'.$Publisher->getAba().'" size="35" /></td>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td class="report-left"><b>'.BANCOINTERMEDIARIO.'</b></td>';
   $html.= '<td colspan="3" class="report-left"><input type="text" id="pub-ben-int" value="'.$Publisher->getBankIntermediary().'" size="35" /></td>';
   $html.= '</tr>';
   
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td>&nbsp;</td>';
   $html.= '<td colspan="3" class="report-left"><input type="button" value="'.ACTUALIZAR.'" onclick="abmPublishersPayments(\'2\', \''.$id_publisher.'\'); return false;" /></td>';
   $html.= '</tr>';
   $html.= '<tr class="report-body report-body-no-line">';
   $html.= '<td colspan="'.$colspan.'">&nbsp;</td>';
   $html.= '</tr>';   

   $html.= '</table>';
   
// Modelos y rates para cada país
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="'.$colspan.'" class="report-left">';
   $html.= '<b>'.AGREGARPAIS.'</b> &raquo; ';
   $html.= RenderCombo('pub-country-add', 'ads_countries', 'id_country', 'country_eng', 'country_eng ASC', 0, SELECCIONARPAIS, 0);
   $html.= '<select id="pub-country-model">';
   $html.= '<option value="0">'.SELECCIONARMODELO.'</option>';
   $html.= '<option value="1">CPA</option>';
   $html.= '<option value="2">CPC</option>';
   $html.= '<option value="3">CPM</option>';
   $html.= '</select>';
   $html.= '<input type="text" id="pub-country-value" placeholder="'.INGRESARVALORPUBLISHER.'" value="" />';
   $html.= '<input type="button" value="'.AGREGAR.'" onclick="abmPublishersModels(\'1\', \''.$id_publisher.'\'); return false;" />';
   $html.= '</td>'; 
   $html.= '</tr>';
   $html.= '<tr class="report-header">';
   $html.= '<th class="report-left">'.PAIS.'</th>';
   $html.= '<th class="report-left">'.MODELO.'</th>';
   $html.= '<th class="report-left">'.VALOR.'</th>';
   $html.= '<th class="report-left">&nbsp;</th>'; 
   $html.= '</tr>';
   $html.= '<tr class="report-body-no-line">';
   $html.= '<td colspan="'.$colspan.'">';
   $html.= '<div id="countries_'.$id_publisher.'">'.getPublisherModels($id_publisher).'</div>';
   $html.= '</td>';
   $html.= '</tr>';
   $html.= '</table>';
   
   return $html;
   }
         
// Función para obtener lista de oportunidades/clientes
   /* Action 1: reporte por account manager
      Action 3: reporte general */
   function getPublishersReport($action, $id_publisher=null, $id_country=0, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Publisher;

   $html = null;
      
// Tomo los datos
   $date_start = is_null($date_start) ? $Publisher->getDate(6) : $date_start;
   $date_end = is_null($date_end) ? $Publisher->getDate(0) : $date_end; 
   $publishers = $Publisher->getPublishersReport($id_country, $date_start, $date_end);
   $qty = $Publisher->cantidadItems($publishers);
   $colspan = 8;
   $sum_impressions[] = $sum_clics[] = $sum_spent[] = $sum_ecpc[] = $sum_ecpa[] = null;
    
// Funciones
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="'.$colspan.'">';
   $html.= 'Total (<b>'.$qty.'</b> Publishers) '.DESDE.' ';
   $html.= '<input type="text" id="date-start" class="date-box-t" value="'.$date_start.'" />';
   $html.= ' '.HASTA.' ';
   $html.= '<input type="text" id="date-end" class="date-box-t" value="'.$date_end.'" />';
   $html.= getComboCountries(2, $id_country);   
   $html.= '<input type="button" class="input-button" onclick="getPublishersReport(\'1\', \''.$id_publisher.'\'); return false;" value="'.MODIFICAR.'" />';
   $html.= '</td>';
   $html.= '</tr>';
   
// Encabezados
   $html.= '<tr class="report-header">';
   $html.= '<th class="report-left">Publishers</th>';
   $html.= '<th>Imp.</th>';
   $html.= '<th>Clics</th>';
   $html.= '<th>CTR</th>';
   $html.= '<th>Spend</th>';
   $html.= '<th>eCPC</th>';
   $html.= '<th>eCPM</th>';
   $html.= '<th>&nbsp;</th>';  
   $html.= '</tr>';
   
   if($qty > 0){
   $count = 0;     
   while($row = mysql_fetch_array($publishers)){
   if(!empty($id_country)){ 
   $spent = $row['spent'];
   $ctr = $row['clics'] / $row['impressions'] * 100;
   $ecpm = $spent / $row['impressions'] * 1000; // Revenue / Impresiones
   $ecpc = $spent / $row['clics']; 
   switch($row['model']){
    case 1: $model = 'CPA'; break;
    case 2: $model = 'CPC'; break;
    case 3: $model = 'CPM'; break;
    default:break;
   }
   }else{
   $spent = 0;
   $ctr = $row['clics'] / $row['impressions'] * 100;
   $ecpm = 0; // Revenue / Impresiones
   $ecpc = 0;
   }
   
   $html.= '<tr class="report-body" alt="'.acute($row['publisher']).' ('.acute($row['commercial']).')" title="'.acute($row['publisher']).' ('.acute($row['commercial']).')" onclick="getSlotsReport(\'1\', \''.$row['id_user'].'\'); return false;">';
   $html.= '<td class="report-left txt-tools">'.acute($row['publisher']);
   $html.= '<br /><small>('.acute($row['commercial']).')</smalll>';
   if(!empty($id_country)) $html.= '<br />'.$model.' - ('.precio($row['value']).')</td>';
   $html.= '<td>'.number($row['impressions'], false).'</td>';
   $html.= '<td>'.number($row['clics'], false).'</td>';
   $html.= '<td>'.percent($ctr).'</td>'; 
   $html.= '<td>'.precio($spent).'</td>';
   $html.= '<td>'.precio(0).'</td>';
   $html.= '<td>'.precio(0).'</td>';
   $html.= '<td><a href="#" alt="'.PUBLISHERPERFIL.'" title="'.PUBLISHERPERFIL.'" onclick="getPublisherProfile(\''.$row['id_user'].'\'); return false;"><img src="'.ROOT.'/images/112-group.png" /></a></td>';   
   $html.= '</tr>';
   $html.= '<tr><td colspan="'.$colspan.'">';
   $html.= '<div id="publishers_'.$row['id_user'].'" class="publishers"></div>';
   $html.= '</td></tr>';   

// Agrego dentro del array para sumar o promediar al final
   $sum_impressions[$count] = $row['impressions'];
   $sum_clics[$count] = $row['clics'];
   $sum_spent[$count] = $spent;
   $sum_ecpm[$count] = $ecpm;
   $sum_ecpc[$count] = $ecpc;
  
   $count++;
   }

   $ctr = array_sum($sum_clics) / array_sum($sum_impressions) * 100;
   $ecpm = array_sum($sum_spent) / array_sum($sum_impressions) * 1000; // Revenue / Impresiones
   $ecpc = array_sum($sum_spent) / array_sum($sum_clics);
   
   $html.= '<tr class="report-bottom">';
   $html.= '<td>&nbsp;</td>';
   $html.= '<td>'.number(array_sum($sum_impressions), false).'</td>';
   $html.= '<td>'.number(array_sum($sum_clics), false).'</td>';
   $html.= '<td>'.percent($ctr).'</td>';
   $html.= '<td>'.precio(array_sum($sum_spent)).'</td>';   
   $html.= '<td>'.precio(0).'</td>';
   $html.= '<td>'.precio(0).'</td>'; 
   $html.= '<td>&nbsp;</td>';  
   $html.= '</tr>';

   }else{
   
   $html.= '<tr><td colspan="'.$colspan.'" align="center" height="50px"><b>'.NOINFO.'</b></td></tr>';
   }
   
   $html.= '</table>';
   $html.= reloadDOM();
   
   return $html;
   }
   
// Función para estadística en tiempo real del AdServer
   /* Action 1: general
      Action 2: por oportunidad
      Action 3: por campaña */
   function getRealTime($action, $id=null, $value){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   
   $html = null;
   
   $Campaign->getRealTime($action, $id);
   $cpa = $Campaign->getCpa();
   
   $html.= '<input type="hidden" id="id_rt" value="'.$id.'" />';
   $html.= '<table width="100%" class="realtime-clock">';
   $html.= '<tr><td colspan="2" class="realtime-clock-title">SMA Real Time</td></tr>';
   $html.= '<tr><td colspan="2" class="realtime-clock-notes">'.date("r").'</td></tr>';
   
   // Clics
   $html.= '<tr>';
   $html.= '<td>'.CLICS.'</td>';
   $html.= '<td rowspan="8" align="right" valign="bottom">
            <a href="#" onclick="getRealTime(\''.$action.'\', \''.$id.'\', \'300\', \'1\'); return false;" alt="'.ACTUALIZARAHORA.'" title="'.ACTUALIZARAHORA.'">
            <img src="'.ROOT.'/images/ic_reload.png" /></a></td>';
   $html.= '</tr>';
   $clics = $Campaign->getClics();
   $html.= '<tr><td class="realtime-clock-number" nowrap>'.number($clics, false).'</td></tr>';
   
   // Conversiones
   $html.= '<tr><td>'.CONVERSIONES.'</td></tr>';
   $conversions = $Campaign->getConversions();
   $html.= '<tr><td class="realtime-clock-number">'.number($conversions, false).'</td></tr>';
   
   // Conversion Rate
   $html.= '<tr><td>'.CONVERSIONRATE.'</td></tr>';
   if($clics == 0 or $Campaign->getConversions() == 0){
   $cr = 0;
   }else{
   $cr = $Campaign->getConversions()/$clics*100;
   } 
   $html.= '<tr><td class="realtime-clock-number">'.percent($cr).'</td></tr>';
   
   // Revenue
   $html.= '<tr><td>Revenue</td></tr>';
   $revenue = $Campaign->getConversions() * $cpa;
   $html.= '<tr><td class="realtime-clock-number">'.precio($revenue, false).'</td></tr>';
      
   $html.= '<tr><td colspan="2" class="realtime-clock-refresh" height="25px" valign="bottom">'.ACTUALIZAEN.' <span id="realtime-seconds">'.$value.'</span> '.SEGUNDOS.'</td></tr>';
   $html.= '</tr>';
   
   // Proyectado final día
   $html.= '<tr><td colspan="2" height="40px" class="realtime-clock-title">'.DAILYFORECAST.'</td></tr>';
   $past = date("H") * 60 + date("i");
   $tc = $Campaign->getConversions() / $past;
   $rest = 1440 - $past;
   $forecast = $tc * $rest * $cpa + $revenue;
   $html.= '<tr><td colspan="2" class="realtime-clock-number">'.precio($forecast, false).'</td></tr>';

   // Proyectado final mes
   $html.= '<tr><td colspan="2" height="40px" class="realtime-clock-title">'.MONTHLYFORECAST.'</td></tr>';   
   $conversions = $Campaign->getPerformanceAS(2, $Campaign->getDate(2), $Campaign->getDate(0));
   $count = 1;
   $ema3conv = 0;
   while($row = mysql_fetch_array($conversions)){
    if($count == 1){
    $ema3conv = $row['conversions'];
    }else{
    $ema3conv = $ema3conv + ($row['conversions'] - $ema3conv) * (2/(1+3)); 
    }
    $count++;
   }
   $Campaign->getRevenuePeriod(1);
   
   $past = date("d");
   $left = $Campaign->getLastDay() - $past;
   $forecast = $ema3conv * $cpa * $left + $Campaign->getRevenue();
   $html.= '<tr><td colspan="2" class="realtime-clock-number">'.precio($forecast, false).'</td></tr>';
      
   $html.= '<tr><td colspan="2" valign="bottom" height="40px" class="realtime-clock-title">'.DIFERENCIAHORA.'</td></tr>';
   $html.= '<tr><td colspan="2" class="realtime-clock-notes">
                <b>London</b><br />'.getTimezone('Europe/London').'</td></tr>';
   $html.= '<tr><td colspan="2" class="realtime-clock-notes">
                <b>Mexico</b><br />'.getTimezone('America/Mexico_City').'</td></tr>';
   $html.= '<tr><td colspan="2" class="realtime-clock-notes">
                <b>Sao Paulo</b><br />'.getTimezone('America/Sao_Paulo').'</td></tr>';   
   $html.= '<tr><td colspan="2" class="realtime-clock-notes">
                <b>Los Angeles</b><br />'.getTimezone('America/Los_Angeles').'</td></tr>';
   $html.= '<tr><td colspan="2" class="realtime-clock-notes">
                <b>India</b><br />'.getTimezone('Etc/GMT-5').'</td></tr>';   
   $html.= '</table>';

   return $html;   
   }

// Función para obtener lista de oportunidades/clientes
   /* Action 1: reporte por account manager
      Action 3: reporte general */
   function getReportAM($action, $id_user=null, $id_opps=null, $id_network=0, $performance=null, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;
   global $Users;

   $html = null;
         
// Tomo los datos
   $id_user = !empty($id_user) ? $id_user : null;
   $date_start = is_null($date_start) ? $Campaign->getDate(7) : $date_start;
   $date_end = is_null($date_end) ? $Campaign->getDate(1) : $date_end;
   $opps = $Campaign->getOppsReport($id_user, $id_network, $date_start, $date_end);
   $qty = $Campaign->cantidadItems($opps);
   $colspan = 9;
   $sum_impressions[] = $sum_clics[] = $sum_conversions[] = $sum_spent[] = $sum_revenue[] = $sum_contribution_money[] = null;
   
// Campos ocultos
   $html.= '<input type="hidden" id="networks" value="'.$id_network.'" />';
   
// Título
   $html.= '<table width="100%" cellspacing="0" cellpadding="0" class="fleft">';
   $html.= '<td colspan="'.$colspan.'" class="section-title">Performance</td>';
   $html.= '</tr>';

// Funciones
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="'.$colspan.'">';
   $html.= SELECCIONAR.' &raquo; ';
   $html.= 'Account Manager '.getComboUsersMedia(1, $id_user);
   $html.= CONTRIBUCION.' <select id="am-performance">';
   $html.= '<option value="0">'.TODOS.'</option>';
   for($i=1; $i<=5; $i++){
   switch($i){
   case 1: $txt = NEGATIVO; break;
   case 2: $txt = '0% - 10%'; break;
   case 3: $txt = '10% - 30%'; break;
   case 4: $txt = '30% - 50%'; break;
   case 5: $txt = '+ 50%'; break;
   default:break;
   }
   $html.= '<option value="'.$i.'" ';
   if($performance == $i) $html.= 'selected';
   $html.= '>'.$txt.'</option>';
   }   
   $html.= '</select>';
   $html.= '<input type="button" onclick="getReportAM(); return false;" value="'.CREAR.'" />';
   $html.= '</td>';
   $html.= '</tr>';
   
// Encabezados
   $html.= '<tr class="report-header">';
   $html.= '<th class="report-left">'.CLIENTES.'</th>';
   $html.= '<th>'.IMPRESIONES.'</th>';
   $html.= '<th>'.CLICS.'</th>';
   $html.= '<th>'.CONVERSIONES.'</th>';
   $html.= '<th>Revenue</th>';
   $html.= '<th>'.SPEND.'</th>';
   $html.= '<th>'.CONTRIBUCION.' %</th>';
   $html.= '<th>'.CONTRIBUCION.' $</th>';
   $html.= '<th>&nbsp;</th>';   
   $html.= '</tr>';
      
   if($qty > 0){
   $count = 0;     
   while($row = mysql_fetch_array($opps)){

   $Campaign->getOppsReportDetail($id_user, $row['id_opportunity'], $id_network, $date_start, $date_end);
   // Calculos
   $contribution_money = $Campaign->getRevenue() - $Campaign->getSpent();   
   if($Campaign->getRevenue() != 0){    
   $contribution = $contribution_money *100 / $Campaign->getRevenue();
   }else{
   $contribution = 0;
   }
    
   $html.= '<tr class="report-body-40" alt="'.acute($row['opp']).' ('.acute($row['client']).')" title="'.acute($row['opp']).' ('.acute($row['client']).')" onclick="getReportAMCampaign(\'1\', \''.$id_user.'\', \''.$row['id_opportunity'].'\'); return false;">';
   $html.= '<td class="report-left"><b>'.acute(limit_chars($row['opp'], 20)).'</b><br /><small>'.acute($row['client']).'</small></td>';   
   $html.= '<td>'.number($Campaign->getImpressions(), false).'</td>';
   $html.= '<td>'.number($Campaign->getClics(), false).'</td>';
   $html.= '<td>'.number($Campaign->getConversions(), false).'</td>';
   $html.= '<td>'.precio($Campaign->getRevenue()).'</td>';
   $html.= '<td>'.precio($Campaign->getSpent()).'</td>';
   $html.= '<td>'.percent($contribution).'</td>';
   $html.= '<td>'.precio($contribution_money).'</td>';
   $html.= '<td align="right">';                    
   $html.= '<div class="report-alert-empty"></div>';
   $html.= '<a href="#" onclick="getGraphOpps(\'1\', \''.$row['id_opportunity'].'\'); return false;" >
            <img src="'.ROOT.'/images/17-bar-chart.png" alt="'.VERREPORTEDETALLE.' '.acute($row['opp']).'" title="'.VERREPORTEDETALLE.' '.acute($row['opp']).'" /></a>';
   $html.= '</td>';   
   $html.= '</tr>';
   $html.= '<tr><td colspan="'.$colspan.'">';
   $html.= '<div id="campaigns_'.$row['id_opportunity'].'" class="campaigns"></div>';
   $html.= '</td></tr>'; 
   
// Agrego dentro del array para sumar o promediar al final
   $sum_impressions[$count] = $Campaign->getImpressions();
   $sum_clics[$count] = $Campaign->getClics();
   $sum_conversions[$count] = $Campaign->getConversions();
   $sum_spent[$count] = $Campaign->getSpent();
   $sum_revenue[$count] = $Campaign->getRevenue();
   $sum_contribution_money[$count] = $contribution_money; 
      
   $count++;
   }
   
   $html.= '<tr class="report-bottom">';
   $html.= '<td>&nbsp;</td>';
   $html.= '<td>'.number(array_sum($sum_impressions), false).'</td>';
   $html.= '<td>'.number(array_sum($sum_clics), false).'</td>';
   $html.= '<td>'.number(array_sum($sum_conversions), false).'</td>';
   $html.= '<td>'.precio(array_sum($sum_revenue)).'</td>';
   $html.= '<td>'.precio(array_sum($sum_spent)).'</td>';
   $contribution = array_sum($sum_contribution_money) * 100 / array_sum($sum_revenue);
   $html.= '<td>'.percent($contribution).'</td>';
   $html.= '<td>'.precio(array_sum($sum_contribution_money)).'</td>';
   $html.= '<td>&nbsp;</td>';  
   $html.= '</tr>';

   }else{
   
   $html.= '<tr><td colspan="'.$colspan.'" align="center" height="50px"><b>'.NOINFO.'</b></td></tr>';  
   }
   
   $html.= '</table>';

   $html.= '<script type="text/javascript">drawChart();</script>';
   $html.= reloadDOM();
   
   return $html;
   }

// Función para obtener lista de oportunidades/clientes
   function getReportAMCampaign($action, $id_user=null, $id_opp=null, $id_network=0, $performance=null, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

// Tomo los datos
   $id_user = isset($id_user) ? $id_user : $_SESSION['s_id_user'];
   $campaigns = $Campaign->getCampaignsReport($id_user, $id_opp, $id_network, $date_start, $date_end);
   $qty = $Campaign->cantidadItems($campaigns);
   $colspan= 9;
   $count_contribution = 0;
   $html = null;
   
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   
   if($qty > 0){
   while($row = mysql_fetch_array($campaigns)){
    
   $Campaign->getCampaignsReportDetail($id_user, $row['id_campaign'], $id_network, $date_start, $date_end);
   // Calculos   
   if($Campaign->getSpent() != 0 && $Campaign->getRevenue() != 0){
   $contribution_money = $Campaign->getRevenue() - $Campaign->getSpent(); 
   $contribution = $contribution_money / $Campaign->getRevenue() * 100;
   }else{
   $contribution_money = 0;
   $contribution = 0;
   }

// Filtro por contribución porcentual   
   switch($performance){
   case 1:
    $low = -100000; 
    $high = 0; 
   break;
    
   case 2:    
    $low = 0; 
    $high = 10; 
   break;
    
   case 3:  
    $low = 10;
    $high = 30;
   break;
    
   case 4:
    $low = 30; 
    $high = 50; 
   break;
    
   case 5:      
    $low = 50;
    $high = 100000;
   break;
    
   default:  
    $low = -100000; 
    $high = 100000;  
   break;
   }
   
   if($contribution > $low && $contribution < $high){       
   $html.= '<tr class="report-body-40 report-campaigns" alt="'.acute($row['campaign']).' ('.$row['id_campaign'].')" title="'.acute($row['campaign']).' ('.$row['id_campaign'].')">';
   $html.= '<td class="report-left-40">'.acute(limit_chars($row['campaign'], 20)).'<br /><small>('.$row['id_campaign'].')</small></td>';   
   $html.= '<td>'.number($Campaign->getImpressions(), false).'</td>';
   $html.= '<td>'.number($Campaign->getClics(), false).'</td>';
   $html.= '<td>'.number($Campaign->getConversions(), false).'</td>';
   $html.= '<td>'.precio($Campaign->getRevenue()).'</td>';
   $html.= '<td>'.precio($Campaign->getSpent()).'</td>';
   $html.= '<td>'.percent($contribution).'</td>';
   $html.= '<td>'.precio($contribution_money).'</td>';
   $html.= '<td align="right">';
   $html.= getCampaignHealth($contribution);
   $html.= '<a href="#" onclick="getGraphCampaigns(\'1\', \''.$row['id_campaign'].'\'); return false;" >
             <img src="'.ROOT.'/images/17-bar-chart.png" alt="'.VERREPORTEDETALLE.' '.acute($row['campaign']).'" title="'.VERREPORTEDETALLE.' '.acute($row['campaign']).'" /></a>';
   $html.= '</td>';
   $html.= '</tr>';
   $count_contribution++;
   }
   }
   if($count_contribution == 0) $html.= '<script>alert(\''.NOCONTRIBUTION.'\');</script>';   
   }else{
   $html.= '<tr><td colspan="'.$colspan.'" valign="middle" height="50px"><b>'.NOINFO.'</b></td></tr>';
   }
   $html.= '</table>';
   
   return $html;
   }
      
// Función para obtener lista de oportunidades/clientes
   function getReportExport($id_user=null, $id_opps=null, $id_network=0, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;
      
// Tomo los datos
   $id_user = !is_null($id_user) ? $id_user : null;
   $date_start = is_null($date_start) ? $Campaign->getDate(7) : $date_start;
   $date_end = is_null($date_end) ? $Campaign->getDate(1) : $date_end;
   $opps = $Campaign->getOppsReport($id_user, $id_network, $date_start, $date_end);
   $qty = $Campaign->cantidadItems($opps);
   $colspan = 17;
   
// Funciones
   $html.= '<table>';
   $html.= '<tr>';
   $html.= '<td colspan="'.$colspan.'">';
   $html.= 'Total (<b>'.$qty.'</b> '.OPORTUNIDADES.') '.DESDE.' '.$date_start.' '.HASTA.' '.$date_end;
   $html.= '</td>';
   $html.= '</tr>';
   
// Encabezados
   $html.= '<tr>';
   $html.= '<th>Account Manager</th>';
   $html.= '<th>ID</th>';
   $html.= '<th colspan="2">'.CLIENTES.'</th>';
   $html.= '<th>ID</th>';
   $html.= '<th>'.IMPRESIONES.'</th>';
   $html.= '<th>'.CLICS.'</th>';
   $html.= '<th>Spend</th>';
   $html.= '<th>'.CONVERSIONES.'</th>';
   $html.= '<th>'.utf8_decode(CONVERSIONRATE).'</th>';
   $html.= '<th>eCPC</th>';
   $html.= '<th>eCPA</th>';
   $html.= '<th>CPA</th>';
   $html.= '<th>'.REVENUE.'</th>';
   $html.= '<th>'.utf8_decode(CONTRIBUCION).' (%)</th>';
   $html.= '<th>'.utf8_decode(CONTRIBUCION).' ($)</th>';
   $html.= '<th>'.PRODUCTO.'</th>';   
   $html.= '</tr>';
      
   while($row = mysql_fetch_array($opps)){
   
   $Campaign->getOppsReportDetail($id_user, $row['id_opportunity'], $id_network, $date_start, $date_end);
   // Calculos
   if($Campaign->getConversions() != 0 && $Campaign->getClics() != 0){
   $cr = $Campaign->getConversions()/$Campaign->getClics()*100;
   }else{
   $cr = 0;
   }
   if($Campaign->getSpent() != 0 && $Campaign->getClics() != 0){
   $ecpc = $Campaign->getSpent()/$Campaign->getClics();
   }else{
   $ecpc = 0;
   }
   if($Campaign->getSpent() != 0 && $Campaign->getConversions() != 0){
   $ecpa = $Campaign->getSpent()/$Campaign->getConversions();
   }else{
   $ecpa = 0;
   }   
   if($Campaign->getSpent() != 0 && $Campaign->getRevenue() != 0){
   $contribution_money = $Campaign->getRevenue() - $Campaign->getSpent(); 
   $contribution = $contribution_money/$Campaign->getRevenue()*100;
   }else{
   $contribution_money = 0;
   $contribution = 0;
   }
        
   $html.= '<tr>';
   $html.= '<td>&nbsp;</td>';
   $html.= '<td>&nbsp;</td>';
   $html.= '<td colspan="2"><b>'.utf8_decode($row['opp']).'</b> - '.utf8_decode($row['client']).'</td>';
   $html.= '<td>&nbsp;</td>';   
   $html.= '<td><b>'.$Campaign->getImpressions().'</b></td>';
   $html.= '<td><b>'.$Campaign->getClics().'</b></td>';
   $html.= '<td><b>'.numberExport($Campaign->getSpent()).'</b></td>';
   $html.= '<td><b>'.$Campaign->getConversions().'</b></td>';
   $html.= '<td><b>'.numberExport($cr).'</b></td>';
   $html.= '<td><b>'.numberExport($ecpc).'</b></td>';
   $html.= '<td><b>'.numberExport($ecpa).'</b></td>';
   $html.= '<td><b>'.numberExport($Campaign->getCpa()).'</b></td>';
   $html.= '<td><b>'.numberExport($Campaign->getRevenue()).'</b></td>';
   $html.= '<td><b>'.numberExport($contribution).'</b></td>';
   $html.= '<td><b>'.numberExport($contribution_money).'</b></td>';
   $html.= '<td>&nbsp;</td>';  
   $html.= '</tr>';

   $opportunity = utf8_decode($row['opp']);
   
// Campañas    
   $campaigns = $Campaign->getCampaignsReport($id_user, $row['id_opportunity'], $id_network, $date_start, $date_end);

   while($row_campaigns = mysql_fetch_array($campaigns)){
    
    $Campaign->getCampaignsReportDetail($id_user, $row_campaigns['id_campaign'], $id_network, $date_start, $date_end);
    // Calculos
    if($Campaign->getClics() != 0){
    $cr = $Campaign->getConversions() / $Campaign->getClics() * 100;
    $ecpc = $Campaign->getSpent() / $Campaign->getClics();
    }else{
    $cr = 0;
    $ecpc = 0;
    }
    if($Campaign->getConversions() != 0){
    $ecpa = $Campaign->getSpent() / $Campaign->getConversions();
    }else{
    $ecpa = 0;
    }
    $contribution_money = $Campaign->getRevenue() - $Campaign->getSpent();   
    if($Campaign->getRevenue() != 0){     
    $contribution = $contribution_money / $Campaign->getRevenue() * 100;
    }else{
    $contribution = 0;
    }
       
    $html.= '<tr>';
    $html.= '<td>'.utf8_decode($row_campaigns['account']).'</td>';
    $html.= '<td>'.$row_campaigns['id_user'].'</td>';
    $html.= '<td>'.utf8_decode($row_campaigns['campaign']).' ('.$row_campaigns['id_campaign'].')</td>';
    $html.= '<td>'.$opportunity.'</td>';
    $html.= '<td>'.$row_campaigns['id_campaign'].'</td>';   
    $html.= '<td>'.$Campaign->getImpressions().'</td>';
    $html.= '<td>'.$Campaign->getClics().'</td>';
    $html.= '<td>'.numberExport($Campaign->getSpent()).'</td>';
    $html.= '<td>'.$Campaign->getConversions().'</td>';
    $html.= '<td>'.numberExport($cr).'</td>';
    $html.= '<td>'.numberExport($ecpc).'</td>';
    $html.= '<td>'.numberExport($ecpa).'</td>';
    $html.= '<td>'.numberExport($Campaign->getCpa()).'</td>';
    $html.= '<td>'.numberExport($Campaign->getRevenue()).'</td>';
    $html.= '<td>'.numberExport($contribution).'</td>';
    $html.= '<td>'.numberExport($contribution_money).'</td>';
    $html.= '<td>'.utf8_decode($row_campaigns['comments']).'</td>';
    $html.= '</tr>';
    }
   }
   
   $html.= '</table>';
   
   return $html;
   }

// Función para obtener lista de slots
   function getSlotsReport($action, $id_publisher=null, $id_country=0, $date_start=null, $date_end=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Publisher;

   $html = null;
      
// Tomo los datos
   $date_start = is_null($date_start) ? $Publisher->getDate(7) : $date_start;
   $date_end = is_null($date_end) ? $Publisher->getDate(1) : $date_end;
   $publishers = $Publisher->getSlotsReport($id_publisher, $id_country, $date_start, $date_end);
   $qty = $Publisher->cantidadItems($publishers);
   $colspan = 8;
    
// Funciones
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   
   if($qty > 0){
   $count = 0;     
   while($row = mysql_fetch_array($publishers)){
   if($row['impressions'] > 0){
   if(!empty($id_country)){ 
   $spent = $row['spent'];
   $ctr = $row['clics'] / $row['impressions'] * 100;
   $ecpm = $spent / $row['impressions'] * 1000; // Revenue / Impresiones
   $ecpc = $spent / $row['clics']; 
   }else{
   $spent = 0;
   $ctr = $row['clics'] / $row['impressions'] * 100;
   $ecpm = 0; // Revenue / Impresiones
   $ecpc = 0;
   }

   $html.= '<tr class="report-body report-campaigns" alt="('.$row['id_slot'].') '.acute($row['name']).' - '.acute($row['url']).'" title="('.$row['id_slot'].') '.acute($row['name']).' - '.acute($row['url']).'">';
   $html.= '<td class="report-left txt-tools">'.acute(limit_chars($row['name'], 20));
   $html.= '<br /><small>(ID SLOT: '.$row['id_slot'].')</smalll>';
   $html.= '<br />'.acute(limit_chars($row['url'], 25)).'</td>';
   $html.= '<td>'.number($row['impressions'], false).'</td>';
   $html.= '<td>'.number($row['clics'], false).'</td>';
   $html.= '<td>'.percent($ctr).'</td>';
   $html.= '<td>'.precio($spent).'</td>';
   $html.= '<td>'.precio($ecpm).'</td>';
   $html.= '<td>'.precio($ecpc).'</td>';
   $html.= '<td>&nbsp;</td>';   
   $html.= '</tr>';   

   $count++;
   }
   }

   }else{
   
   $html.= '<tr><td colspan="'.$colspan.'" align="center" height="50px"><b>'.NOINFO.'</b></td></tr>';
   }
   
   $html.= '</table>';
   $html.= reloadDOM();
   
   return $html;
   }
            
// Función para recargar el DOM
   function reloadDOM(){
   $html = '<script type="text/javascript">
            $(document).ready(function(){    
            // Datepicker
	             $(".date-box").datetimepicker({
                showSecond: false,
		            timeFormat: "hh:mm:ss",
		            dateFormat: "yy-mm-dd"
               });

           	var f = new Date();
            var date = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + (f.getDate() - 1);
            $(".date-box-o").datepicker({dateFormat: \'yy-mm-dd\', maxDate: date});
   
            var date = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate();
            $(".date-box-n").datepicker({dateFormat: \'yy-mm-dd\', minDate: date});

            var date = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate();
            $(".date-box-t").datepicker({dateFormat: \'yy-mm-dd\', maxDate: date});
            
            
		        // Modal
	             $("a[name=modal]").click(function(e) {
		           e.preventDefault();
		
		           var id = $(this).attr("href");
		           var content = $(this).attr("id");
		           var tipo = explode("_", content);
    
               $("html, body").animate({scrollTop:0}, "slow");
               
		           switch(tipo[0]){
               case "getChangeLog":
                getChangeLog(tipo[1], tipo[2]);
               break;		           
                                             
               default:break; 
               }

		           var maskHeight = $(document).height();
		           var maskWidth = $(window).width();

		           $("#mask").css({"width":maskWidth,"height":maskHeight});
	
		           $("#mask").fadeTo(25, 0.5);	

		           var winH = $(window).height();
		           var winW = $(window).width();
              
		           $(id).css("top",  winH/2-$(id).height()/2);
		           $(id).css("left", winW/2-$(id).width()/2);	
		           $(id).fadeIn(25);               	
		           });
	
		           $(".window .close").click(function (e) {
		            e.preventDefault();
		
		            $("#mask").hide();
		            $(".window").hide();
		           });		
	
		           $("#mask").click(function () {
		            $(this).hide();
		            $(".window").hide();
		           });            
            
                        
            }); // Cierro el ready            
             </script>';
   
   return $html;
   }

// Función para validar y guardar la imagen del banner
   function setBanner($file, $id_banner){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $banner = $Campaign->getBanner($id_banner);
   $row = mysql_fetch_array($banner);
   
   $size = getimagesize(DOCROOT."/tmp/".$file);
   $size = $size[0].'x'.$size[1];
   
   if($Campaign->getSize($size)){
   $Campaign->abmBanners(2, $id_banner, $row['id_campaign'], $Campaign->getIdBannerSize(), $row['extension']);
   rename(DOCROOT."/tmp/".$file, DOCROOT."/files/".$row['id_campaign']."/".$id_banner."_".$Campaign->getIdBannerSize().$row['extension']);   
   return $id_banner;
   
   }else{
   
   unlink(DOCROOT."/tmp/".$file);
   return false;
   }
   }
   
// Función para cargar creativos de campañas
   function setBanners($campaigns){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;
      
// Tomo los datos
   $campaigns2send = $campaigns;
   $campaigns = $Campaign->getCampaignsValidation($campaigns);
   $colspan = 2;

   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr><td colspan="'.$colspan.'" class="section-title">'.CAMPANIASUPLOAD.'</td></tr>';
      
// Funciones
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="'.$colspan.'">';
   $html.= '<div class="number-no-select">1</div>';
   $html.= '<div class="number-no-select">2</div>';
   $html.= '<div class="number-select">3</div>';
   $html.= '<div class="number-no-select">4</div>';
   $html.= '<span class="txt-steps">'.CARGARCREATIVOS.'</span>';
   $html.= '</td>';
   $html.= '</tr>';
   
// Encabezados
   $html.= '<tr class="report-header">';
   $html.= '<th colspan="'.$colspan.'" class="report-left">'.CAMPANIAS.'</th>';  
   $html.= '</tr>';

// Campañas
   while($row = mysql_fetch_array($campaigns)){
   switch($row['id_cat_product']){
   case 1: $cat = 'Application'; break;
   case 2: $cat = 'Branding'; break;
   case 3: $cat = 'Mobile Web Content'; break;
   default:break;
   }

   switch($row['id_cat_product']){
   case 1: $model = 'CPA'; break;
   case 2: $model = 'CPC'; break;
   case 3: $model = 'CPM'; break;
   default:break;
   }
   
   if(empty($row['id_cat_theme'])) $category = UNDEFINED; else $category = acute($row['category']);
      
   $html.= '<tr class="report-body">';
   $html.= '<td class="report-left" colspan="'.$colspan.'">';
   $html.= '('.$row['id_campaign'].') &raquo; <b>'.CLIENTE.':</b> '.acute($row['opp']).' &raquo; <b>'.ASIGNADAA.':</b> '.acute($row['user']).' &raquo; <b>'.PRODUCTO.':</b> '.$cat.' &raquo; <b>'.MODELO.':</b> '.$model.' &raquo; <b>'.VALOR.':</b> '.precio($row['cpa']).'<br />';
   $html.= '<b>URL:</b> <a href="'.$row['url'].'" target="_blank">'.$row['url'].'</a>'; 
   $html.= '</td>';   
   $html.= '</tr>';

   $html.= '<tr class="report-body report-body-no-line" id="campaign_'.$row['id_campaign'].'">';

// Banners
   $html.= '<td class="report-left" valign="top">Banners &raquo; ';
   $html.= '<input type="file" id="up-banner_'.$row['id_campaign'].'" name="up-banner_'.$row['id_campaign'].'" />';
   $html.= '<input type="button" onclick="abmBanners(\'1\', \''.$row['id_campaign'].'\');" value="'.AGREGAR.'" />';
   $html.= '<div id="banners_'.$row['id_campaign'].'"></div>';
   $html.= '</td>';

// AdText   
   $html.= '<td class="report-left" valign="top">AdText &raquo; ';
   $html.= '<input type="text" id="up-adtxt-title_'.$row['id_campaign'].'" placeholder="'.TITULO.' (20)" maxlength="20" />';
   $html.= '<input type="text" id="up-adtxt-description_'.$row['id_campaign'].'" placeholder="'.DESCRIPCION.' (40)" maxlength="40" />';
   $html.= '<input type="text" id="up-adtxt-url_'.$row['id_campaign'].'" placeholder="'.URLPARAMOSTRAR.'" />';
   $html.= '<input type="button" onclick="abmAdText(\'1\', \''.$row['id_campaign'].'\');" value="'.AGREGAR.'" />';
   $html.= '<div id="adtext_'.$row['id_campaign'].'"></div>';
   $html.= '</td>';   
   $html.= '</tr>';
   }
   $html.= '<tr class="report-body">';
   $html.= '<td align="right" colspan="'.$colspan.'">';
   $html.= '<input type="button" value="'.SEGMENTACION.' &raquo;" onclick="setBanners(\'1\', \''.$campaigns2send.'\');" class="input-button button-bottom" />';   
   $html.= '</td>';   
   $html.= '</tr>';    
   $html.= '</table>';

   $html.= reloadDOM();
   
   return $html;
   }
   
// Función para obtener lista de oportunidades/clientes
   function setCampaigns($action, $id_user=null, $id_opps=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;
      
// Tomo los datos
   $id_user = !is_null($id_user) ? $id_user : $_SESSION['s_id_user'];
   $colspan = 3;

   $html.= '<input type="hidden" id="id_user" value="'.$id_user.'" />';
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr><td colspan="'.$colspan.'" class="section-title">'.CAMPANIASUPLOAD.'</td></tr>';
      
// Funciones
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="'.$colspan.'">';
   $html.= '<div class="number-select">1</div>';
   $html.= '<div class="number-no-select">2</div>';
   $html.= '<div class="number-no-select">3</div>';
   $html.= '<div class="number-no-select">4</div>';
   $html.= '<span class="txt-steps">'.SELECCIONAROPORTUNIDAD.'</span>';
   $html.= '</td>';
   $html.= '</tr>';
   
// Encabezados
   $html.= '<tr class="report-header">';
   $html.= '<th width="30%" class="report-left">'.FINANCE.'</th>';
   $html.= '<th class="report-left">'.CLIENTES.' ('.OPORTUNIDADES.')</th>';
   $html.= '<th>&nbsp;</th>';   
   $html.= '</tr>';
   
// Oportunidades
   $html.= '<tr>';
   $html.= '<td class="report-select-tb">'.getComboClients(1).'</td>';
   $html.= '<td class="report-select-tb"><div id="up-opps">'.getComboOpps(1).'</div></td>';
   $html.= '<td align="right"><input type="button" value="'.SELECCIONAR.'" onclick="getUploadSteps(\'1\');" /></td>';   
   $html.= '</tr>';

// Tipo de producto
   $html.= '<tr class="report-header product data">';
   $html.= '<th class="report-select-tb" colspan="'.$colspan.'">'.DATOSCAMPANIA.'</th>';
   $html.= '</tr>';
   $html.= '<tr class="data">';
   $html.= '<td class="report-select-tb">';
   $html.= '<select id="up-type-prod">';
   $html.= '<option value="1">Application</option>';
   $html.= '<option value="2">Branding</option>';
   $html.= '<option value="3">Mobile Web Content</option>';
   $html.= '</select>';
   $html.= '</td>';
   $html.= '<td colspan="2" class="report-left report-box-text">'.SELECCIONARTIPOPRODUCTO.'</td>';
   $html.= '</tr>';
   
// Categoría
   $html.= '<tr class="data">';
   $html.= '<td class="report-select-tb">';
   $html.= getComboCategories(1);
   $html.= '<div id="cat-prod2" class="txt-combo">'.getComboCategories(2).'</div>';
   $html.= '</td>';
   $html.= '<td colspan="2" class="report-left report-box-text">'.SELECCIONARCATEGORIAPRODUCTO.'</td>';
   $html.= '</tr>';
   
// Modelo
   $html.= '<tr class="data">';
   $html.= '<td class="report-select-tb">';
   $html.= '<select id="up-model-prod">';
   $html.= '<option value="1">CPA</option>';
   $html.= '<option value="2">CPC</option>';
   $html.= '<option value="3">CPM</option>';
   $html.= '</select>';
   $html.= '</td>';
   $html.= '<td class="report-left report-box-text">'.SELECCIONARMODELO.'</td>';
   $html.= '</tr>';
   
// Valor
   $html.= '<tr class="data">';
   $html.= '<td class="report-select-tb">';
   $html.= '<input type="text" id="up-value-prod" />';
   $html.= '</td>';
   $html.= '<td class="report-left report-box-text">'.INGRESARVALOR.'</td>';
   $html.= '<td align="right">';
   $html.= '<input type="button" value="'.SELECCIONAR.'" onclick="getUploadSteps(\'2\');" />';
   $html.= '</td>';
   $html.= '</tr>';
      
// URLs
   $html.= '<tr class="report-header urls">';
   $html.= '<th class="report-select-tb" colspan="'.$colspan.'">URL\'s</th>';
   $html.= '</tr>';
   $html.= '<tr class="urls">';
   $html.= '<td class="report-select-tb">';
   $html.= '<textarea id="up-urls" class="report-textarea-up"></textarea>';
   $html.= '</td>';
   $html.= '<td class="report-left report-box-text" valign="top">'.URLSPEECH.'</td>';
   $html.= '<td align="right" valign="bottom">';
   $html.= '<input type="button" value="'.CREAR.'" onclick="abmCampaigns(\'1\', \'null\');" />';
   $html.= '<input type="button" value="'.CANCELAR.'" onclick="abmCampaigns(\'4\', \'null\');" />';
   $html.= '</td>';   
   $html.= '</tr>';
    
   $html.= '</table>';

   $html.= reloadDOM();
   
   return $html;
   }
   
// Función para obtener lista de oportunidades/clientes
   function setConversions($action, $id_user=null, $id_opps=null, $date=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;
      
// Tomo los datos
   $id_user = !is_null($id_user) ? $id_user : $_SESSION['s_id_user'];
   $date = is_null($date) ? $Campaign->getDate(1) : $date;
   $opps = $Campaign->getOppsReport($id_user, 0, $date, $date);
   $qty = $Campaign->cantidadItems($opps);
   $colspan = 6;

   $html.= '<input type="hidden" id="id_user" value="'.$id_user.'" />';
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr><td colspan="'.$colspan.'" class="section-title">'.UPLOADCONV.' '.date2sp($date).'</td></tr>';
      
// Funciones
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="'.$colspan.'">';
   $html.= 'Total (<b>'.$qty.'</b> '.OPORTUNIDADES.') ';
   $html.= '<input type="text" id="date" class="date-box-o" value="'.$date.'" onchange="getOppsReport(\'2\', \''.$id_user.'\'); return false;" />';
   // $html.= '<input type="button" class="input-button" onclick="getOppsReport(\'2\', \''.$id_user.'\'); return false;" value="'.MODIFICAR.'" />';
   $html.= '</td>';
   $html.= '</tr>';
   
// Encabezados
   $html.= '<tr class="report-header">';
   $html.= '<th class="report-left">'.CLIENTES.'</th>';
   $html.= '<th>'.IMPRESIONES.'</th>';
   $html.= '<th>'.CLICS.'</th>';
   $html.= '<th>Spend</th>';
   $html.= '<th>'.CONVERSIONES.'</th>';
   $html.= '<th>&nbsp;</th>';   
   $html.= '</tr>';
   
   if($qty > 0){
   $count = 0;     
   while($row = mysql_fetch_array($opps)){
   
   $Campaign->getOppsReportDetail($id_user, $row['id_opportunity'], 0, $date, $date);
        
   $html.= '<tr class="report-body-50" alt="'.acute($row['opp']).' ('.acute($row['client']).')" title="'.acute($row['opp']).' ('.acute($row['client']).')" onclick="getCampaignsReport(\'2\', \''.$id_user.'\', \''.$row['id_opportunity'].'\'); return false;">'; 
   $html.= '<td class="report-left-50"><b>'.acute(limit_chars($row['opp'], 25)).'</b><br /><small>('.$row['id_opportunity'].') '.acute($row['client']).'</small></td>';   
   $html.= '<td>'.number($Campaign->getImpressions(), false).'</td>';
   $html.= '<td>'.number($Campaign->getClics(), false).'</td>';
   $html.= '<td>'.precio($Campaign->getSpent()).'</td>';
   $html.= '<td>'.number($Campaign->getConversions(), false).'</td>';
   $html.= '<td align="right">';
   $html.= '<input type="button" class="input-button" value="Guardar" onclick="abmConversions(\'2\', \''.$row['id_opportunity'].'\'); return false;" />';
   $html.= '</td>';   
   $html.= '</tr>';
   $html.= '<tr><td colspan="'.$colspan.'">';
   $html.= '<div id="campaigns_'.$row['id_opportunity'].'" class="campaigns"></div>';
   $html.= '</td></tr>'; 
   }

   }else{
   
   $html.= '<tr><td colspan="'.$colspan.'" align="center" height="50px"><b>'.NOINFO.'</b></td></tr>';
   }
   
   $html.= '</table>';

   $html.= reloadDOM();
   
   return $html;
   }
    
// Función para obtener conversiones de campañas
   function setConversionsCampaigns($id_user=null, $id_opp=null, $date=null){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

// Tomo los datos
   $id_user = isset($id_user) ? $id_user : $_SESSION['s_id_user'];
   $campaigns = $Campaign->getCampaignsReport($id_user, $id_opp, 0, $date, $date);
   $qty = $Campaign->cantidadItems($campaigns);
   $colspan= 6;
   
   $html = null;
   
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   
   if($qty > 0){
   while($row = mysql_fetch_array($campaigns)){
   if(!empty($row['tool'])) $tool = acute($row['tool']); else $tool = '<span class="txt-alert">'.UNDEFINED.'</span>';
    
   $Campaign->getCampaignsReportDetail($id_user, $row['id_campaign'], $row['id_network'], $date, $date);
       
   $html.= '<tr class="report-body-50 report-campaigns" alt="'.acute($row['campaign']).' ('.$row['id_campaign'].')" title="'.acute($row['campaign']).' ('.$row['id_campaign'].')">';
   $html.= '<td class="report-left-50">'.acute($row['campaign']);
   $html.= '<br /><small>'.$row['id_campaign'].' / '.$tool.'</small></td>';   
   $html.= '<td>'.number($Campaign->getImpressions(), false).'</td>';
   $html.= '<td>'.number($Campaign->getClics(), false).'</td>';
   $html.= '<td>'.precio($Campaign->getSpent()).'</td>';
   $html.= '<td>';
   $html.= '<input type="text" class="input-conv" id="conv_'.$row['id_campaign'].'_'.$row['id_network'].'" name="conversions" value="'.number($Campaign->getConversions(), false).'" size="3" />';
   $html.= '<input type="button" value="M" onclick="setConversionsMO(\'1\', \''.$row['id_campaign'].'\', \''.$row['id_network'].'\'); return false;" />';
   $html.= '<input type="hidden" name="campaigns" value="'.$row['id_campaign'].'" />';
   $html.= '<input type="hidden" name="networks" value="'.$row['id_network'].'" />';
   
// Ventana para carga de multioperadores
   $html.= '<div id="mo-'.$row['id_campaign'].'" class="report-MO">';
   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr>';
   $html.= '<th>'.CONVERSIONES.'</th>';
   $html.= '<th>'.VALOR.'</th>';
   $html.= '</tr>';
   $html.= '<tr>';
   $html.= '<td><input type="text" id="conv1-'.$row['id_campaign'].'" value="0" size="3" /></td>';
   $html.= '<td><input type="text" id="value1-'.$row['id_campaign'].'" value="0" size="3" /></td>';
   $html.= '</tr>';
   $html.= '<tr>';
   $html.= '<td><input type="text" id="conv2-'.$row['id_campaign'].'" value="0" size="3" /></td>';
   $html.= '<td><input type="text" id="value2-'.$row['id_campaign'].'" value="0" size="3" /></td>';
   $html.= '</tr>';
   $html.= '<tr>';
   $html.= '<td><input type="text" id="conv3-'.$row['id_campaign'].'" value="0" size="3" /></td>';
   $html.= '<td><input type="text" id="value3-'.$row['id_campaign'].'" value="0" size="3" /></td>';
   $html.= '</tr>';
   $html.= '<tr>';
   $html.= '<td><input type="button" value="'.GUARDAR.'" onclick="setConversionsMO(\'2\', \''.$row['id_campaign'].'\', \''.$row['id_network'].'\'); return false;" /></td>';
   $html.= '<td><input type="button" value="'.CERRAR.'" onclick="setConversionsMO(\'3\', \''.$row['id_campaign'].'\', \''.$row['id_network'].'\'); return false;" /></td>';
   $html.= '</tr>';
   $html.= '</table>';
   $html.= '</div>';
   
   $html.= '</td>';
   $html.= '<td>'.acute($Campaign->getNetwork()).'</td>';
   $html.= '</tr>';
   }
   $html.= '<tr class="report-body-50 report-campaigns-lost">';
   $html.= '<td class="report-left-50">'.getComboCampaigns($id_opp).'</td>';   
   $html.= '<td>'.number(0, false).'</td>';
   $html.= '<td>'.number(0, false).'</td>';
   $html.= '<td>'.precio(0).'</td>';
   $html.= '<td>';
   $html.= '<input type="text" id="conv_lost_'.$id_opp.'" value="" size="3" />';
   $html.= '</td>';
   $html.= '<td>';
   $html.= getComboNetworks(1);
   $html.= '<input type="button" value="+" onclick="setCampaignsLost(\''.$id_opp.'\', \''.$id_user.'\'); return false;" />';
   $html.= '</td>';
   $html.= '</tr>';   
   }else{
   $html.= '<tr><td colspan="'.$colspan.'" valign="middle" height="50px"><b>'.NOINFO.'</b></td></tr>';
   }
   $html.= '</table>';
   
   return $html;
   }

// Función para obtener lista de campañas a validar
   function setEnviroment($campaigns){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;
      
// Tomo los datos
   $campaigns2send = $campaigns;
   $campaigns = $Campaign->getCampaignsValidation($campaigns);
   $colspan = 4;

   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr><td colspan="'.$colspan.'" class="section-title">'.CAMPANIASUPLOAD.'</td></tr>';
      
// Funciones
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="'.$colspan.'">';
   $html.= '<div class="number-no-select">1</div>';
   $html.= '<div class="number-select">2</div>';
   $html.= '<div class="number-no-select">3</div>';
   $html.= '<div class="number-no-select">4</div>';
   $html.= '<span class="txt-steps">'.SELECCIONARENVIROMENT.'</span>';
   $html.= '</td>';
   $html.= '</tr>';
   
// Encabezados
   $html.= '<tr class="report-header">';
   $html.= '<th colspan="'.$colspan.'" class="report-left">'.CAMPANIAS.'</th>';  
   $html.= '</tr>';

// Campañas
   while($row = mysql_fetch_array($campaigns)){
   switch($row['id_cat_product']){
   case 1: $cat = 'Application'; break;
   case 2: $cat = 'Branding'; break;
   case 3: $cat = 'Mobile Web Content'; break;
   default:break;
   }

   switch($row['id_cat_product']){
   case 1: $model = 'CPA'; break;
   case 2: $model = 'CPC'; break;
   case 3: $model = 'CPM'; break;
   default:break;
   }
   
   if(empty($row['id_cat_theme'])) $category = UNDEFINED; else $category = acute($row['category']);
      
   $html.= '<tr class="report-body" id="campaign1_'.$row['id_campaign'].'">';
   $html.= '<td class="report-left" colspan="'.$colspan.'">';
   $html.= '<input type="hidden" class="cp_validation" id="cp_validation_'.$row['id_campaign'].'" />';
   $html.= '('.$row['id_campaign'].') &raquo; <b>'.OPORTUNIDAD.':</b> '.acute($row['opp']).' ('.$row['id_opportunity'].') &raquo; <b>'.ASIGNADAA.':</b> '.acute($row['user']).' &raquo; <b>'.PRODUCTO.':</b> '.$cat.' &raquo; <b>'.MODELO.':</b> '.$model.' &raquo; <b>'.VALOR.':</b> '.precio($row['cpa']).'<br />';
   $html.= '<b>URL:</b> <a href="'.$row['url'].'" target="_blank">'.$row['url'].'</a>'; 
   $html.= '</td>';   
   $html.= '</tr>';
   
   $html.= '<tr class="report-body-no-line" id="campaign2_'.$row['id_campaign'].'">';
   $html.= '<td class="report-left">'.NOMBRE.'</td>';
   $html.= '<td class="report-left">'.DESCRIPCION.'</td>';
   $html.= '<td class="report-left">'.CATEGORIA.'</td>';
   $html.= '<td class="report-left">'.ENTORNO.'</td>';
   $html.= '</tr>';
   
   $html.= '<tr class="report-body report-body-no-line" id="campaign3_'.$row['id_campaign'].'">';
   $html.= '<td class="report-left"><input type="text" id="up-name_'.$row['id_campaign'].'" value="'.acute($row['name']).'" /></td>';
   $html.= '<td class="report-left"><input type="text" id="up-description_'.$row['id_campaign'].'" value="'.acute($row['description']).'" /></td>';
   $html.= '<td class="report-left">';
   if($row['id_cat_theme'] == 0){
   $html.= getComboCategoriesEdit(1, 0, $row['id_campaign']);
   $html.= '<div id="cat-prod2_'.$row['id_campaign'].'" class="txt-combo">'.getComboCategoriesEdit(2, 0, $row['id_campaign']).'</div>';
   }else{
   $html.= getComboCategoriesEditLoad(1, $row['id_cat_theme'], $row['rel_category'], $row['id_campaign']);
   $html.= '<div id="cat-prod2_'.$row['id_campaign'].'" class="txt-combo">'.getComboCategoriesEditLoad(2, $row['id_cat_theme'], $row['rel_category'], $row['id_campaign']).'</div>';
   }
   $html.= '</td>';
   $html.= '<td class="report-left">';
   for($i=0; $i<=1; $i++){
   $html.= '<input type="radio" name="up-enviroment_'.$row['id_campaign'].'" value="'.$i.'" class="radio-button" ';
   if($row['enviroment'] == $i) $html.= 'checked';
   $html.= ' />';
   if($i == 0) $html.= 'Test'; else $html.= PRODUCCION;
   }
   $html.= '</td>';
   $html.= '</tr>';
   $html.= '<tr id="campaign4_'.$row['id_campaign'].'">';
   $html.= '<td align="right" colspan="'.$colspan.'">';
   $html.= '<input type="button" value="'.GUARDAR.'" class="input-button button-bottom" onclick="abmCampaigns(\'2\', \''.$row['id_campaign'].'\');" />';
   $html.= '<input type="button" value="'.ELIMINAR.'" onclick="abmCampaigns(\'3\', \''.$row['id_campaign'].'\');" />';   
   $html.= '</td>';   
   $html.= '</tr>';
   }
   $html.= '<tr class="report-body">';
   $html.= '<td align="right" colspan="'.$colspan.'">';
   $html.= DISPONIBLENETWORK.' <input type="button" value="'.SI.'" class="input-button button-bottom" onclick="setEnviroment(\'1\', \''.$campaigns2send.'\');" />';
   $html.= '<input type="button" value="No" class="input-button button-bottom" onclick="setEnviroment(\'2\', \'null\');" />';   
   $html.= '</td>';   
   $html.= '</tr>';    
   $html.= '</table>';

   $html.= reloadDOM();
   
   return $html;
   }
   
// Función para configurar segmentación de campañas
   function setSegmentation($campaigns){
// Instancio las clases dentro de la función
   global $DBase;
   global $Campaign;

   $html = null;
      
// Tomo los datos
   $colspan = 3;

   $html.= '<table width="100%" cellspacing="0" cellpadding="0">';
   $html.= '<tr><td colspan="'.$colspan.'" class="section-title">'.CAMPANIASUPLOAD.'</td></tr>';
      
// Funciones
   $html.= '<tr class="report-functions">';
   $html.= '<td colspan="'.$colspan.'">';
   $html.= '<div class="number-no-select">1</div>';
   $html.= '<div class="number-no-select">2</div>';
   $html.= '<div class="number-no-select">3</div>';
   $html.= '<div class="number-select">4</div>';
   $html.= '<span class="txt-steps">'.DEFINIRSEGMENTACION.'</span>';
   $html.= '</td>';
   $html.= '</tr>';
   
// Encabezados
   $html.= '<tr class="report-header">';
   $html.= '<th class="report-left">'.PAIS.'</th>';
   $html.= '<th class="report-left">'.CARRIERS.'</th>';
   $html.= '<th class="report-left">OS</th>';
   // $html.= '<th class="report-left">Target</th>';   
   $html.= '</tr>';

// Selects
   $html.= '<tr class="report-header">';
   $html.= '<td class="report-select-tb" valign="top">'.getComboCountries(1).'</td>';
   $html.= '<td class="report-select-tb" valign="top" id="sl-carriers">'.getComboCarriers().'</td>';
   $html.= '<td class="report-select-tb" valign="top">'.getComboOS().'</td>';
   // $html.= '<td class="report-select-tb" valign="top">'.getComboCountries(1).'</td>';   
   $html.= '</tr>';
      
// Final
   $html.= '<tr>';
   $html.= '<th colspan="'.$colspan.'">';
   $html.= '<input type="button" value="'.AGREGARFINALIZAR.'" class="input-button button-bottom" onclick="abmSegmentation(\'1\', \''.$campaigns.'\');" />';
   $html.= '</th>';   
   $html.= '</tr>';
    
   $html.= '</table>';

   $html.= reloadDOM();
   
   return $html;
   }
                  
// Función para traducir textos desde JavaScript
   function translate($text){
   $html = constant($text);
  
   return $html;
   }
?>