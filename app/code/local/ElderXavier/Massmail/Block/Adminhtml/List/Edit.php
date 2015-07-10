<?php
 
class ElderXavier_Massmail_Block_Adminhtml_List_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
               
        $this->_objectId = 'id_list';
        $this->_blockGroup = 'massmail';
        $this->_controller = 'adminhtml_list';        
        //$this->_updateButton('save', 'label', Mage::helper('massmail')->__('Save'));
        $this->_removeButton('save');        
        $this->_updateButton('back','onclick','setLocation(\'' . $this->getUrl('*/*/list') . '\')');        

        $this->_addButton('save', array(
            'label'     => Mage::helper('massmail')->__('Save'),
            'onclick'   => 'document.getElementById('.$this->htmlEscape("'saveedit_form'").').submit();',
            'class'     => 'save'
        ), 5, 100, 'header');        
    }
 
    public function getHeaderText()
    {
        if( Mage::registry('massmail_data') && Mage::registry('massmail_data')->getId() ) {
            return Mage::helper('massmail')->__("Edit Template '%s'", $this->htmlEscape(Mage::registry('massmail_data')->getData("template_name")));
        } else {
            return Mage::helper('massmail')->__('Edit Template');
        }
        
        return;
    }
}