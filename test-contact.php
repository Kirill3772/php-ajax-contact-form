<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") { 	//THIS WILL TELL YOUR SCRIPT TO KILL ITSELF IF SOMEONE TRIES
  die();					//TO VIEW IT DIRECTLY IN A BROWSER
}
$name = $email = $txt = "";
$errname = "<div class='errname'><p>* Fill out your name</p></div>"; //ALL YOUR ERROR AND SUCCESS MESSAGES 
$errnametwo = "<div class='errname'><p>* Use only letters and spaces</p></div>";
$errmail = "<div class='errmail'><p>* Enter an email address</p></div>";
$errmailtwo = "<div class='errmail'><p>* Make sure your email is valid</p></div>";
$errtxt = "<div class='errtxt'><p>* Write a message</p></div>";
$success = "<div class='success'><p>Message Sent! Thank you for considering my business.</p></div>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fname"])) {					//IF THE FIELD IS EMTPY, SHOW ERROR MESSAGE
	echo $errname;
	$val_error = true;
    } else {
    $name = test_input($_POST["fname"]);			//THE test_input FUNCTION PREVENTS MALICIOUS CODE FROM BEING SENT
      if (!preg_match("/^[a-zA-z ]*$/",$name)) {		//BASIC PHP FILTER THAT ALLOWS ONLY LETTERS AND SPACES
	echo $errnametwo;
	$val_error = true;					//IF THE INPUTS WERE WRONG, SET val_error = true
      }
    }
    if (empty($_POST["email"])) {					//DO THE SAME AS YOU DID FOR THE NAME
	echo $errmail;
	$val_error = true;
    } else {
    $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {		//PHP BASIC EMAIL FILTER, CHECK TO MAKE SURE EMAIL
	echo $errmailtwo;					//IS IN THE CORRECT FORMAT
	$val_error = true;
      }
    }
    if (empty($_POST["message"])) {
	echo $errtxt;
	$val_error = true;
    } else {
    $txt = test_input($_POST["message"]);
    }
  }
function test_input($data) {						//WE USE THIS FUNCTION TO TEST ALL OUR USER INPUTS
  $data = trim($data);							//TAKE OFF UNNECESSARY CHARACTERS, SUCH AS EXTRA SPACE
  $data = stripslashes($data);						//REMOVE BACKSLASHES FROM INPUTS
  $data = htmlspecialchars($data);					//CONVERT ALL INPUT CODE INTO HTML escape code, PREVENTING
									//ANY UNWATED CODE EXECUTION
													
  return $data;								//SEND DATA BACK TO MAIL FORM, WITH ERROR MESSAGES FOR ANYTHING
									//THAT WAS NOT PUT IN CORRECTLY
}
?>

<?php
if (!$val_error) {							//IF NO ERRORS WERE FOUND, AND val_error IS FALSE, SEND USER
									//INPUTS TO THE DESIRED EMAIL ADDRESS
$to = "kirill3772@hotmail.com";
$subject = "Contact From Articulate SEO";
$from = "$name <kirill@articulateseo.com>";
$message = "<html>
		<body>
			<table style='width: 100%; padding: 1em;'>
				<tr>
				<table style='width: 100%; background: red; font-size: 140%; padding: 1em 0; color: #fff;'>
					<td style='padding: 1em;'>Hi, this is $name</td>
				</table>
				</tr> 
				<tr>
				<table style='width: 100%; color: blue; font-size: 120%; padding: 1em 0;'>
					<td style='padding: 1em;'>$txt</td>
				</table>
				</tr>
				<tr>
				<table style='width: 100%; height: 4em; background: grey;'>
					<td>Made By Kirill Sukharev</td>
				</table>
				</tr>
				</table>
		   </body>
	     </html>";				//IF SENDING HTML MAIL, YOU MUST BUILD IT USING MAINLY table TAGS, IF YOU TRY USING
						//TAGS SUCH AS div, SOME EMAIL PROVIDERS WILL STRIP THEM OUT, ESPECIALLY IF THEY ARE
						//EMPTY. YOUR STYLING MUST ALSO BE DONE AS inline.
$headers = "From: $from \r\n";
$headers .= "Reply-To: $email \r\n";
$headers .= "Return-Path: $from \r\n";
$headers .= "MIME-Version: 1.0 \r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
$headers .= "CC: redeye3772@gmail.com, codebargain@gmail.com, kirill3771@gmail.com";
mail($to,$subject,$message,$headers,"-f$email");
					//IN ORDER TO SEND OUT HTML MAIL CORRECTLY AND BYPASS SPAM FILTERS, THE from, headers AND
					//mail SECTIONS MUST BE SET EXACTLY AS ABOVE. FOR EXAMPLE, THE $from PART MUST BE
					//user@website.com IF YOU TRY www.website.com GMAIL WILL LET IT PASS, BUT HOTMAIL WILL MARK
					//IT AS SPAM. THE mail PORTION MUST HAVE THE "-f$email" PART AS WELL TO AVOID HOTMAIL SPAM
									
echo $success;				//IF EVERYTHING WENT SMOOTHLY, SHOW SUCCESS MESSAGE
}
?>
