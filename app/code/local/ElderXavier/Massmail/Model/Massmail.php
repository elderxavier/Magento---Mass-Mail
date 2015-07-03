<?php
 
class ElderXavier_Massmail_Model_Massmail extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('massmail/massmail');
    }
}