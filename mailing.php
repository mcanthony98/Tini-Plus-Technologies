<?php session_start();
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	if(isset($_POST['contactus'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$sms = $_POST['sms'];
		
		$subject = "TiniPlus Website - Contact Us";
		$message = '
					<h2>A New Query From Tini Plus Website</h2>
					<p>Name: '.$fname.' - '.$lname.'</p>
					<p>Email: '.$email.'</p>
					<p>Phone: '.$phone.'</p>
					<p>Message: '.$sms.'</p>
					';
		$result = 'Your message was sent successfully. We shall contact you in 24hrs. <br/> THANK YOU.';	
		
	}elseif(isset($_POST['reqcall'])){
		
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		
		$subject = "TiniPlus Website - Contact Us";
		$message = '
					<h2>A New Call Request From Tini Plus Website</h2>
					<p>Name: '.$name.'</p>
					<p>Phone: '.$phone.'</p>
					';
		$result = 'Your request was sent successfully. We shall contact you in 24hrs. <br/> THANK YOU.';	
		
	}else{
		header('location: contact.php');
		exit();
	}

					//Load phpmailer
		    		require 'vendor/autoload.php';

		    		$mail = new PHPMailer(true);                             
				    try {
				        //Server settings
				        $mail->isSMTP();                                     
				        $mail->Host = 'smtp.gmail.com';                      
				        $mail->SMTPAuth = true;                               
				        $mail->Username = 'mcanthony98@gmail.com';     
				        $mail->Password = '36987412';                    
				        $mail->SMTPOptions = array(
				            'ssl' => array(
				            'verify_peer' => false,
				            'verify_peer_name' => false,
				            'allow_self_signed' => true
				            )
				        );                         
				        $mail->SMTPSecure = 'ssl';                           
				        $mail->Port = 465;                                   

				        $mail->setFrom('mcanthony98@gmail.com');
				        
				        //Recipients
				        $mail->addAddress('tiniplustech@gmail.com');              
				        $mail->addReplyTo('mcanthony98@gmail.com');
				       
				        //Content
				        $mail->isHTML(true);                                  
				        $mail->Subject = $subject;
				        $mail->Body    = $message;

				        $mail->send();

				 
				        $_SESSION['success'] = $result;
				        header('location: contact.php');

				    } 
				    catch (Exception $e) {
				        $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
				        header('location: contact.php');
				    }



	?>