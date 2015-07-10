<?php

class ElderXavier_Massmail_Block_Adminhtml_List extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_list';
        $this->_blockGroup = 'massmail';
        $this->_headerText = Mage::helper('massmail')->__('Item Manager');
        
        parent::__construct();
    }
}