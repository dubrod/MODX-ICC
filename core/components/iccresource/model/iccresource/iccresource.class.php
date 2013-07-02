<?php
class iccResource extends modResource {
	
	// shows up in the left-hand tree's context menu 
	public $showInContextMenu = true;
    function __construct(xPDO & $xpdo) {
        parent :: __construct($xpdo);
        $this->set('class_key','iccResource');
    }

	public static function getControllerPath(xPDO &$modx) {
    	return $modx->getOption('iccresource.core_path',null,$modx->getOption('core_path').'components/iccresource/').'controllers/';
	}
	
	public function getContextMenuText() {
	  return array(
	    'text_create' => 'ICC Page',
	    'text_create_here' => 'Create an ICC Page Here',
	  );
	}
	
	public function getResourceTypeName() {
	  return 'ICC Page';
	}
	
	//append the content 
	
	public function getContent(array $options = array()) {
	   $content = parent::getContent($options);

	   //ICC Custom Variables
	   $ref = $_SERVER['HTTP_REFERER'];
	   $ip = $_SERVER['SERVER_ADDR'];
	   $useragent = $_SERVER['HTTP_USER_AGENT'];
	   $source = htmlspecialchars($_GET['utm_source']);
	   $medium = htmlspecialchars($_GET['utm_medium']);
	   $campaign = htmlspecialchars($_GET['utm_campaign']);
	   
	   //Create Content
	   $content .= ' 
	   
	   <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
	   	
	  		<script type="text/javascript">
				
				$("#icc_success").hide();
				
				var icc_ref = "'.$ref.'";
				var icc_ip = "'.$ip.'";
				var user_agent = "'.$useragent.'";
				var icc_source = "'.$source.'";
				var icc_medium = "'.$medium.'";
				var icc_campaign = "'.$campaign.'";
				
				$("#iccSubmit").click(function() {
					
					//check for @
					var email = $("#icc_email").val();
					var at = email.indexOf("@");
					if(at > -1){
						$("#icc_email").addClass("validField");
					} else {
						$("#icc_email").addClass("errorField");
						alert("Your Email Address is missing the @ symbol.");
						return false;
					}	
					//eof check for @
					
					//check for special chars
					var specialChars = "<>@!#$%^&*()_+[]{}?:;|\"\\,./~`-=";
					var check = function(string){
					 for(i = 0; i < specialChars.length;i++){
					   if(string.indexOf(specialChars[i]) > -1){
					       return true;
					    }
					 }
					 return false;
					} 
					
					if(check($("#icc_name").val()) == false){
						$("#icc_name").addClass("validField");					
					} else {
						$("#icc_name").addClass("errorField");
						alert("Your Name has special characters that are not allowed.");
						return false;
					}
					if(check($("#icc_phone").val()) == false){
						$("#icc_phone").addClass("validField");					
					} else {
						$("#icc_phone").addClass("errorField");
						alert("Your Phone # has special characters, please enter DIGITS ONLY.");
						return false;
					}
					//eof check for special chars
					
					//start process
					$.ajax({
					type: "POST",
						url: "[[++site_url]]core/components/iccresource/processor.php",
						data: { 
							
							name: $("#icc_name").val(),
							email: $("#icc_email").val(),
							phone: $("#icc_phone").val(),
							ref: icc_ref,
							ip: icc_ip,
							useragent: user_agent,  
							source: icc_source,
							medium: icc_medium,
							campaign: icc_campaign,
							
						}
					}).done(function( msg ) {
						$("#icc_form").fadeOut("slow");
						$("#icc_form").hide();
						$("#icc_success").show();
					});
					
				});
				
			
			</script>
	   
	   ';
	   return $content;
	}
}