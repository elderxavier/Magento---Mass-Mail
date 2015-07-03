<?php
 
class ElderXavier_Massmail_Model_Mysql4_Massmail extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {   
        $this->_init('massmail/massmail', 'massmail_id');
    }
}