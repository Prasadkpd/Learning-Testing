<?php 
	$status = '';
	if(isset($_POST['submit']))
	{
		$fname   =$_POST['fname'];
		$email   =$_POST['email'];
		$subject =$_POST['subject'];
		$message =$_POST['message'];

		$to = 'prasadlakshan9984@gmail.com';
		$email_subject = "Message from Website";
		$email_body = "Message from Contact Us page of the Website: <br>";
		$email_body .= "<b>From:</b> {$fname} <br>";
		$email_body .= "<b>Subject:</b> {$subject} <br>";
		$email_body .= "<b>Message:</b> <br>". nl2br(strip_tags($message));

		$header = "From: {$email}\r\n Content-Type: text/html;";
		$send_mail_result = mail($to,$email_subject,$email_body,$header);
		
		if($send_mail_result)
		{
			$status = '<p class="success">Message Sent Successfully</p>';
			echo "Message Sent";
		}else{
			$status = '<p class="error">Error: Message was not Sent.</p>';
			echo "Message not sent";
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial scale=1.0">
	<title>Mail Us</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="mailus.css">
</head>
<body>
	<header>
		<div class="head">
			<h1>Bellyful</h1>
		</div>
		<nav>
			<ul>
				<li><a href="../index.html">Home</a></li>
				<li><a href="package.html">Packages</a></li>
				<li><a href="about.html">About</a></li>
				<li><a href="mailus.html" class="activate">Mail Us</a></li>
				<li><a href="signin.html">Sign Up</a></li>
			</ul>
		</nav>
	</header>
	<section>
		<div class="contact">
			<h2>Location</h2>
			<p>28 Jackson Blvd Ste 1020 Chicago</p><p>IL60604-2340</p>
			<h2>Contact Us</h2>
			<p>0784654646</p>
			
			<a href="#" class="fa fa-facebook"></a>
			<a href="#" class="fa fa-twitter"></a>
			<a href="#" class="fa fa-google"></a>
			<a href="#" class="fa fa-youtube"></a>
			<a href="#" class="fa fa-instagram"></a>
		</div>
		<div class="container">
			<?php echo $status ?>
			<form action="mailus.php" method="POST">
		  
			  <label for="fname">First Name</label>
			  <input type="text" id="fname" name="fname" placeholder="Your name..">
		  
			  <label for="subject">Subject</label>
			  <input type="text" id="subject" name="subject" placeholder="Your Subject..">
		  
			  <label for="email">Email</label>
			  <input type="email" name="email" id="email" placeholder="Enter your Email">
			  </select>
		  
			  <label for="message">Message</label>
			  <textarea id="message" name="message" placeholder="Write something.." style="height:200px"></textarea>
		  
			  <input type="submit" name="submit" value="Send Message">
		  
			</form>
		  </div>
	</section>
</body>