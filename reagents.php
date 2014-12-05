<?php
require_once('php/recaptchalib.php');
$privatekey = "6LdWItYSAAAAAEHDqQ2oeRLtcX6a4c5ydaQaL6Ql";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
	$resp = recaptcha_check_answer ($privatekey,
	$_SERVER["REMOTE_ADDR"],
	$_POST["recaptcha_challenge_field"],
	$_POST["recaptcha_response_field"]);
  
	if (!$resp->is_valid) {
		$error = $resp->error;
	} else {
    
		$todo = urlencode("formkey")."=dDVkVENuU1hqZDlZMTY2V0RfUl9JTWc6MQ&".urlencode("ifq")."&";

		while (list($name, $value) = each($_POST)) {
			if (substr($name,0,9) != "recaptcha") {
				foreach (explode("_",$name) as $partName) {
					$todo.=$partName.".";
				}
				$todo = rtrim($todo,".");
				$todo.="=".$value."&";
			}
		}
		$todo = rtrim($todo,"&");
		$ch = curl_init('https://docs.google.com/spreadsheet/formResponse');
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $todo);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt ($ch, CURLOPT_SLL_VERIFYHOST, 2);
		curl_setopt ($ch, CURLOPT_CAINFO, getcwd() . "/CAcerts/google-docs.crt");
		curl_setopt ($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/x-www-form-urlencoded"));
		$output = curl_exec ($ch);
		$errno = curl_errno($ch);
		curl_close ($ch);
		unset($_POST);
		if ($errno == 0) {
			header('Location: confirmation.php');
		} else {
			echo "There was an error, please just email us with your request";
		}
	}
} else {
	$error = "";
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include "header.html";?>
	<title>Major Lab - Reagents</title>
	<script type="text/javascript">
	function validateForm() {
		var input = document.getElementById("entry_0");
		var i = 0;
		var valid = true;
		do {
			if (input.parentNode.className.search("docs-required") != -1) {
				if (input.value == "") {
					input.parentNode.className += " " + "docs-missing";
					valid = false;
				} else {
					input.parentNode.className = "docs-required";
				}
			}
			i+=1;
			input = document.getElementById("entry_"+String(i));
		} while (input != null);
		if (!valid) window.scroll(0,0);
		return valid;
	}
	</script>
    
	<script type="text/javascript">
	var RecaptchaOptions = {
		theme: 'white'
	};
	</script>
	<script type="text/javascript" src="js/google-analytics.js"></script>    
</head>
<body>
	<div id="wrap">
		<?php include "navbar.html";?>
      
		<div id="stripe2">
	
			<div id="str2">
				<div class="innerdiv">
					<div class="pageHeader">
						<h1>Reagents</h1>
					</div>
					<div class="content"> 
						<!-- <form action="https://docs.google.com/spreadsheet/formResponse?formkey=dDVkVENuU1hqZDlZMTY2V0RfUl9JTWc6MQ&amp;ifq" method="POST" id="ss-form">-->
							<!--<form action="php/index.php" method="POST" id="ss-form">-->
	      
								<iframe id="hidden_iframe" name="hidden_iframe" style="display:none"></iframe>
	      
								<form action="" method="post" id="ss-form" onsubmit="return validateForm()"><!-- target="hidden_iframe"> -->
									<div id="docs-left">
										<div class="docs-required">
											<label class="ss-q-title" for="entry_0">Name<span class="ss-required-asterisk">*</span></label>
											<input type="text" name="entry.0.single" value="<?php echo isset($_POST['entry_0_single']) ? $_POST['entry_0_single'] : '' ?>" class="ss-q-short" id="entry_0"/>
										</div>
										<div class="docs-required">
											<label class="ss-q-title" for="entry_1">Email address<span class="ss-required-asterisk">*</span></label>
											<input type="text" name="entry.1.single" value="<?php echo isset($_POST['entry_1_single']) ? $_POST['entry_1_single'] : ''?>" class="ss-q-short" id="entry_1"/>
										</div>
										<div>
											<label class="ss-q-title" for="entry_2">Phone</label>
											<input type="text" name="entry.2.single" value="<?php echo isset($_POST['entry_2_single']) ? $_POST['entry_2_single'] : ""?>" class="ss-q-short" id="entry_2"/>
										</div>
										<div class="docs-required">
											<label class="ss-q-title" for="entry_3">Principal Investigator<span class="ss-required-asterisk">*</span></label>
											<input type="text" name="entry.3.single" value="<?php echo isset($_POST['entry_3_single']) ? $_POST['entry_3_single'] : ""?>" class="ss-q-short" id="entry_3"/>
										</div>
										<div class="docs-required">
											<label class="ss-q-title" for="entry_4">Institute/Company<span class="ss-required-asterisk">*</span></label>
											<input type="text" name="entry.4.single" value="<?php echo isset($_POST['entry_4_single']) ? $_POST['entry_4_single'] : ""?>" class="ss-q-short" id="entry_4"/>
										</div>
										<div class="docs-required">
											<label class="ss-q-title" for="entry_10">Mailing Address<span class="ss-required-asterisk">*</span></label>
											<input type="text" name="entry.10.single" value="<?php echo isset($_POST['entry_10_single']) ? $_POST['entry_10_single'] : ""?>" class="ss-q-short" id="entry_10"/>
										</div>
										<div class="docs-required">
											<label class="ss-q-title" for="entry_5">Requested Item<span class="ss-required-asterisk">*</span></label>
											<input type="text" name="entry.5.single" value="<?php echo isset($_POST['entry_5_single']) ? $_POST['entry_5_single'] : ""?>" class="ss-q-short" id="entry_5"/>
										</div>
										<div class="docs-required">
											<label class="ss-q-title" for="entry_6">Quantity<span class="ss-required-asterisk">*</span></label>
											<input type="text" name="entry.6.single" value="<?php echo isset($_POST['entry_6_single']) ? $_POST['entry_6_single'] : ""?>" class="ss-q-short" id="entry_6"/>
										</div>
									</div>
									<div id="docs-right">
										<div>
											<label class="ss-q-title" for="entry_7">Publication referencing reagent</label>
											<textarea name="entry.7.single" rows="8" cols="75" class="ss-q-long" id="entry_7"><?php echo isset($_POST['entry_7_single']) ? $_POST['entry_7_single'] : ""?></textarea>
										</div>
										<div class="docs-required">
											<label class="ss-q-title" for="entry_8">Brief description of planned use<span class="ss-required-asterisk">*</span></label>
											<textarea name="entry.8.single" rows="8" cols="75" class="ss-q-long" id="entry_8"><?php echo isset($_POST['entry_8_single']) ? $_POST['entry_8_single'] : ""?></textarea>
										</div>
										<div>
											<label class="ss-q-title" for="entry_9">Special requests or comments</label>
											<textarea name="entry.9.single" rows="8" cols="75" class="ss-q-long" id="entry_9"><?php echo isset($_POST['entry_9_single']) ? $_POST['entry_9_single'] : ""?></textarea>
										</div>
		  
										<fieldset style="display:none">
											<legend/>
											<input type="hidden" name="pageNumber" value="0"/>
											<input type="hidden" name="backupCache" value=""/>
										</fieldset>
									</div>
		
									<div style="clear:both;"></div>
									<div>
										<?php
										require_once('php/recaptchalib.php');
										$publickey = "6LdWItYSAAAAADw3jOwXMRDBxg96SpGFz48TStNU";
										echo recaptcha_get_html($publickey, $error);
										?> 
		  
										<div class="ss-item ss-navigate">
											<div class="ss-form-entry">
												<input type="submit" name="submit" value="Submit"/>
											</div>
										</div>
									</div>
									<!-- <div style="clear:both"/>
										-->
		
									</form>
	      
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php include "footer.html";?>
			</body>
			</html>