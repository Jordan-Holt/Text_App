
<?php
	require_once("inc/config.php");
/*********************************************************************
					FORM PROCESSING
*********************************************************************/						
if ($_SERVER["REQUEST_METHOD"] == "POST") {


	$carrier = trim($_POST["cell_carrier"]);
	$phone = trim($_POST["phone"]);
	$message = trim($_POST["message"]);

	
	if ($carrier == "" OR $phone == "" OR $message == "") {		// Verifies that all fields have been entered.
		$error_message = "You must specify a value for Cell Carrier, phone number and message.";
	}
	
	foreach( $_POST as $value ) {								//Injection Defense
		if(!isset($error_message) AND stripos($value,'Content-Type:') != FALSE ){
			$error_message = "There was a problem with the information you entered.";
		}
	}

	if (!isset($error_message) AND $_POST["address"] != "") {								//HoneyPot Spam Defense
		$error_message = "Your form submission has an error.";	
	}

	$email = "";								// Syncs cell provider to proper email address.
	switch ($carrier) {
		case "att":
			$email = $email . $phone . "@txt.att.net";
			break;	
		case "boost_mobile":
			$email = $email . $phone . "@myboostmobile.com";
			break;
		case "metro_pcs":
			$email = $email . $phone . "@mymetropcs.com";
			break;
		case "sprint":
			$email = $email . $phone . "@messaging.sprintpcs.com";
			break;
		case "t_mobile":
			$email = $email . $phone . "@tmomail.net";
			break;
		case "us_cellular":
			$email = $email . $phone . "@email.uscc.net";
			break;
		case "verizon":
			$email = $email . $phone . "@vtext.com";
			break;
		case "virgin_mobile":
			$email = $email . $phone . "@vmobl.com";
			break;
	}
	//echo $email;									//Test (have to comment out header redirect)- Remove
/*********************************************************************
					EMAIL PROCESSING 
*********************************************************************/
/*
require_once("inc/phpmailer/class.phpmailer.php");		//Includes 3rd Party Mailer 'PHPMailer'.

	$mail = new PHPMailer();

	$mail->SentFrom("Jordan@CompanyInc.com","Jordan");		//Change to real email
	$address = $email;
	$mail->AddAddress($address, "Recipient's Name");

	$mail->Subject = "Message from Text App | Apps by Jordan" ;
	$mail->AltBody = "To view the message, please use an HTML compatible email viewer.";
	$mail->MsgHTML($message);
	

	$if(!$mail->Send()) {
		error_message = "There was a problem sending the email: " . $mail->ErrorInfo;
		exit;
	}
	
*/
/*********************************************************************
					REDIRECT TO THANK YOU MESSAGE 
*********************************************************************/
	if(!isset($error_message)) {
		header("Location: index.php?status=thanks");
		exit;
	}
	
}
?>

<?php 
$pageTitle = "Text App";
$section = "text ap
Your text message will be sent shortly.p";
include(ROOT_PATH . 'inc/header.php'); ?>

	<?php 
/*********************************************************************
					THANK YOU SCREEN
*********************************************************************/
		if(isset($_GET["status"]) AND $_GET["status"] == "thanks") { ?>
			<div class="container" style="text-align: center">
				<h3> Thanks for using the Text App!</h3><br>
				<p>Your text message will be sent shortly.</p><br>
				<a href="<?php echo BASE_URL; ?>" type="button" class="btn btn-primary">Return</a>
			</div>
		<?php 
/*********************************************************************
					NORMAL INDEX.PHP
*********************************************************************/
		} else { ?>
			<div class="container">
				<div class="row">
					
					<div class="col-sm-6">		<!-- Body Text -->
						<?php
							if(!isset($error_message)) { ?>
								<h1>Send a text message right here!</h1>  
								<p>That's right, no phone required.  Simply fill out the form and click Send!</p>
								<br>
								<br>
							<?php }  else { ?>
								<h1>There has been an error!</h1>
								<p><?php echo $error_message; ?> </p>
							<?php } ?>
					</div>  
					<div class="col-sm-6">		<!-- Form -->
						<form method = "post" action="index.php" class="well span4">
							<div class="form-group">
								<label for="cell_carrier">Choose a Cell Carrier: </label>
								<select id="cell_carrier" name="cell_carrier" class="form-control">
									<optgroup label="Cell Carriers:">
									<option value=""></option>
									<option value="att">AT&amp;T</option>
									<option value="boost_mobile">Boost Mobile</option>
									<option value="metro_pcs">Metro PCS</option>
									<option value="sprint">Sprint</option>
									<option value="t_mobile">T-Mobile</option>
									<option value="us_cellular">US Cellular</option>
									<option value="verizon">Verizon</option>
									<option value="virgin_mobile">Virgin Mobile</option>
									</optgroup>
								</select>
							</div> 
							<div class="form-group">
								<label for="phone_number">Please enter your 10 digit phone number: </label>
								<input type="text" id="phone" maxlength="10" onKeyDown="noAlpha(this)" onKeyUp="noAlpha(this)" name="phone" id="phone"  placeholder="Numbers only" class="form-control" value="<?php if(isset($phone)){ echo $phone;}?>"/>
									<script language="javascript">
									function noAlpha(obj){
			    						reg = /[^0-9]/g;
			    						obj.value =  obj.value.replace(reg,"");
									}
									</script>
							</div>
							<div class="form-group">
								<label for="message">Please enter your message (160 characters max): </label>
								<textarea name="message" id="message" maxlength="160" class="form-control"> </textarea>
							</div>
							<div class="form-group" style="display: none">							<!-- Start HoneyPot bot defense -->
								<label for="address">Please enter your address: </label>
								<input class="form-control" type="text" name="address" id="address" />
									<span>Humans, please leave this last field blank. </span>
							</div>
							<br>																	<!-- End HoneyPot bot defense -->
							<button type="submit" class="btn btn-primary btn-block" id="but">Send</button>
							<button type="reset" class="btn btn-block" id="clear_button">Clear All</button>
						</form>
					</div>
				</div>  <!-- Close Row -->
			</div>  <!-- Close Container -->
	<?php } ?>	
<?php include(ROOT_PATH . 'inc/footer.php'); ?>