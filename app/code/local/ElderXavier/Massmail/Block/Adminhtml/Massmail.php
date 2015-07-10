<?php

class ElderXavier_Massmail_Block_Adminhtml_Massmail extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_massmail';
        $this->_blockGroup = 'massmail';
        $this->_headerText = Mage::helper('massmail')->__('Send E-Mail Manager');
        $this->_addButtonLabel = Mage::helper('massmail')->__('Add Item');  


        parent::__construct();
    }
}