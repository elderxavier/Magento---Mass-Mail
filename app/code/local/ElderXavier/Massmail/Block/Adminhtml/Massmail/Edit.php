<?php
 
class ElderXavier_Massmail_Block_Adminhtml_Massmail_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
               
        $this->_objectId = 'id';
        $this->_blockGroup = 'massmail';
        $this->_controller = 'adminhtml_massmail';        
        $this->_updateButton('save', 'label', Mage::helper('massmail')->__('Save'));                
        $this->_addButton('delete', array(
            'label'     => Mage::helper('massmail')->__('Delete'),
            'onclick'   => 'setLocation(\'' . $this->getUrl('*/*/') . '\')',
            'class'     => 'delete_button'
        ), -1, 100, 'header');
    }
 
    public function getHeaderText()
    {
        if( Mage::registry('massmail_data') && Mage::registry('massmail_data')->getId() ) {
            return Mage::helper('massmail')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('massmail_data')->getTitle()));
        } else {
            return Mage::helper('massmail')->__('Edit Mail Template');
        }
    }
}