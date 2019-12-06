<?php
	require_once("./ads_control.php");
	echo $_GET["marque"];

?>
 <html>
 <body>
 	<div id="aa">aa</div>
 	<script type="text/javascript">
 		document.getElementById("aa").innerHTML = "<?php get_ads_cat('','PC'); ?>"; 
 		  
 	</script>
 </body>
 </html>