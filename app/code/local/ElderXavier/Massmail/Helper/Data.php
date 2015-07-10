<?php

class ElderXavier_Massmail_Helper_Data extends Mage_Core_Helper_Abstract {	

	public function getIdsArray()
	{
		try {
			$read = Mage::getSingleton('core/resource')->getConnection('core_read');
			$sql        = 'SELECT massmail_id FROM massmail';
			$rows       = $read->fetchAll($sql);
			return $rows;
		} catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());                
                return;
        }
	}


	public function getTemplatesArray()
	{
		try {
			$resource = Mage::getSingleton('core/resource');
			$readConnection = $resource->getConnection('core_read');
			$query = 'SELECT * FROM massmail';
			$sql   = $readConnection->prepare($query);		
			return $sql;
		} catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());                
                return;
        }
	}

	public function sendMails($email_to, $subject, $message)
	{
		$mail = mail($email_to, $subject, $message,
			"MIME-Version: 1.0" . "\r\n".
			"Content-type: text/html; charset=utf-8" . "\r\n".
			 "From: ".Mage::app()->getStore()->getFrontendName()." <".$email_to.">\r\n"
			."Reply-To: ".$email_to."\r\n"
		."X-Mailer: PHP/" . phpversion());
	
		if($mail)
		{
			return true;			
		}else{
			return false;
		}	
	}

	public function validateEmail($email){
		$regex = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';
	
		if($email == '') { 
			return false;
		} else {
			$string = preg_replace($regex, '', $email);
		}
	
		return empty($string) ? true : false;
	}
	public function getTeste()
	{
		echo 'ok helper';
	}

	

}
