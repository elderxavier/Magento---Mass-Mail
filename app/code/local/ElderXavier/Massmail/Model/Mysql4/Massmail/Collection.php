<?php
 
class ElderXavier_Massmail_Model_Mysql4_Massmail_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('massmail/massmail');
    }
}