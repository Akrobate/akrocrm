<?php


/**
 * @brief		Classe permettant de gerer les mails
 * @details		Petit client Imap pour gestion des mails 
 *				optimisé pour gmail pour le moment
 *
 * @author		Artiom FEDOROV
 */
 
 
class MyMail {

	private $hostname;
	private $username;
	private $password;


	function __construct() {		
		//$this->hostname = MAIL_HOST;
		//$this->username = MAIL_USER;
		//$this->password = MAIL_PASSWORD;
	}
	
	
	/**
	 * @brief		setteur du login 
	 * @param	username	prend en parametre le login
	 * @return	this	renvoi l'objet courant
	 */
	
	public function setUsername($username) {
		$this->username = $username;
		return $this;
	}
	

	/**
	 * @brief		setteur du password de la messagerie 
	 * @param	pw	prend en parametre le password
	 * @return	this	renvoi l'objet courant
	 */
	
	public function setPassword($pw) {
		$this->password = $pw;
		return $this;
	}
	
	
	/**
	 * @brief		setteur du host de la messagerie 
	 * @param	host	prend en parametre le host
	 * @return	this	renvoi l'objet courant
	 */
	
	public function setHost($host) {
		$this->hostname = $host;
		return $this;
	}
	
	
	/**
	 * @brief		Methode qui releve tous les nouveaux mails
	 * @param	host	Releve tous les nouveaux mails
	 * @return	array 	Renvoi le tableau contenant l'ensemble des mails
	 */
	
	public function getNew() {
		$res = array();

		/* try to connect */
		$inbox = imap_open($this->hostname,$this->username,$this->password)
			 or die('Cannot connect to Gmail: ' . imap_last_error());
			 
		$emails = imap_search($inbox,'ALL');
		
		if ($emails) {
	
		  foreach($emails as $email_number) {

			$overview = imap_fetch_overview($inbox,$email_number,0);
			$data['message'] = imap_fetchbody($inbox,$email_number,2);
			$data['date'] = $overview[0]->date;
			$data['from'] = $overview[0]->from;
			$data['subject'] = $overview[0]->subject;
			$data['id'] = $overview[0]->message_id;
			$data['obj'] = $overview[0];
			
			preg_match('#<(.*)>#', $data['from'], $data['from']) ;
			$data['from'] = trim($data['from'][1]);
			$res[] = $data;
		  }
		}

		/* close the connection */
		imap_close($inbox);

		return $res;
		/* put the newest emails on top */
		//rsort($emails);
	}
	
	
	/**
	 * @brief		Methode qui releve tous les nouveaux mails et les efface
	 * @details		Releve tous les nouveaux mails et les supprime de la boite
	 * @param	realydelete	si true alors on vide la corbeille des mails
	 *						si false alors les mails sont conservés dans la corbeille
	 * @return	array 	Renvoi le tableau contenant l'ensemble des mails
	 */
	
	public function getAllAndRemove($realydelete = true) {
		$res = array();

		/* try to connect */
		$inbox = imap_open($this->hostname,$this->username,$this->password)
			or die('Cannot connect to mailbox: ' . imap_last_error());
			
		$emails = imap_search($inbox,'ALL');
		
		if ($emails) {
	
		  foreach($emails as $email_number) {

			$overview = imap_fetch_overview($inbox,$email_number,0);
			$data['message'] = imap_fetchbody($inbox,$email_number,2);
			$data['date'] = $overview[0]->date;
			$data['from'] = $overview[0]->from;
			$data['subject'] = $overview[0]->subject;
			
			preg_match('#<(.*)>#', $data['from'], $data['from']) ;
			$data['from'] = trim($data['from'][1]);
			$res[] = $data;
			if ($realydelete) {
				imap_delete($inbox, $email_number);
			}
		  }
		}
		
		if ($realydelete) {
			imap_expunge($inbox);
		}
		
		imap_close($inbox);

		return $res;
	}
	
	
	
	
	public function removeOne($num) {

		$inbox = imap_open($this->hostname, $this->username, $this->password)
			 or die('Cannot connect to Gmail: ' . imap_last_error());
		$emails = imap_search($inbox,'ALL');
		$mbox = $inbox;
		
		$check = imap_mailboxmsginfo($mbox);
		//echo "Nombre de messages avant effacement : " . $check->Nmsgs . "<br />\n";
		imap_delete($mbox, $num);
		$check = imap_mailboxmsginfo($mbox);
		//echo "Nombre de messages après effacement : " . $check->Nmsgs . "<br />\n";
		imap_expunge($mbox);
		$check = imap_mailboxmsginfo($mbox);
		//echo "Nombre de messages après imap_expunge : " . $check->Nmsgs . "<br />\n";
		
		imap_close($mbox);
	}
	
	
	public function SendTemplatedMail($tplname, $data) {
	
		$msg = $this->MailTemplate($tplname, $data);
		//return $this->sendMail($data['to'], $data['subject'], $msg);
		return $this->sendMailGmail($data['to'], $data['subject'], $msg);
	}
	
	
	
	public function sendMail($to, $subject, $message) {
	
		//$inbox = imap_open($this->hostname, $this->username, $this->password)
			// or die('Cannot connect to Gmail: ' . imap_last_error());
	
		$status = imap_mail ($to , $subject , $message);
		return $status;
	}
	
	
	public function MailTemplate($tplname, $data) {
	
		// Variable md comme maildata
		$md = $data;
		ob_start();
			include(PATH_TEMPLATES . "mails/". $tplname .".php");
		$template_content = ob_get_contents();
		ob_end_clean();
		return $template_content;
	
	}
	
	
	public function sendMailGmail($to, $title, $message) {
		
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = "ssl://smtp.gmail.com"; 
			$mail->SMTPDebug = 1;                     
            // 2 = messages only
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "ssl";
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465;

			$mail->Username   = $this->username; 
			$mail->Password   = $this->password;
		
			$fromMail =  $this->username;	
			$toMail = $to;
			
			$mail->SetFrom($fromMail, "user name");
						
			$mail->Subject = $title;

			//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			$mail->MsgHTML($message);
			$mail->AddAddress($toMail, $toMail);
			//$mail->AddAttachment("images/phpmailer.gif");      // attachment

			if(!$mail->Send()) {
			  $result = $mail->ErrorInfo;
			} else {
			  $result = true;
			}   
			
			return $result;	
		}
		
		
	
		
		
		
		
}


