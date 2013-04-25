<!DOCTYPE html> 
<html lang="en"> 
<head>
<title><?php echo SITE;?></title>
<meta http-equiv="Content-Type"   content="text/html; charset=utf-8" />   
<meta name="robots"               content="noindex, nofollow" />
<style type="text/css">
@import url(<?php echo ROOT;?>/css/general.css);
@import url(<?php echo ROOT;?>/css/jquery-ui-1.8.21.custom.css); 
</style>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="<?php echo ROOT;?>/js/php.full.min.js"></script>
<script type="text/javascript" src="<?php echo ROOT;?>/js/general.js"></script>
<script type="text/javascript" src="<?php echo ROOT;?>/js/ready.js"></script>
<script type="text/javascript" src="<?php echo ROOT;?>/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="<?php echo ROOT;?>/js/jquery-ui-timepicker-addon.js"></script>       
<link rel="shortcut icon" type="image/x-icon" href="<?php echo ROOT;?>/favicon.ico">
<?php if(ENV){ ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-37209259-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php }?>  
</head> 
<body">
<div id="loading" class="loading"><img src="<?php echo ROOT;?>/images/ajax-loader.gif" /><br />Loading ...</div>

<div id="mask"></div>
<div id="boxes">
<div id="dialog" class="window">
<a href="#" class="close" /><b>x</b></a>
<div id="result"></div>
</div>
</div>

<?php if(FILE != 'index.php'){?>
<header class="header">
<?php echo getMenu();?> 
</header>
<?php }?>
<section>