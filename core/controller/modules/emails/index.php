<?php

class Modules_Emails_Index extends CoreController {

	public function init() {

		$modules = $this->getModule();
		$list = new List_Frameview();
		
		$user = users::getMe();
		
		$login = $user['email_login'];
		$password = $user['email_password'];
		$host = "{imap.gmail.com:993/imap/ssl}INBOX";
		
		$client = new MyMail();
		$client->setUsername($login);
		$client->setPassword($password);
		$client->setHost($host);
		
		
		$mres = $client->getNew();
		
		$listContent = "<pre>";
		$listContent .= print_r($user, 1);
		$listContent .= print_r($mres, 1);
		$listContent .= "</pre>";
		
		$this->assign('listContent', $listContent);
	}
}
