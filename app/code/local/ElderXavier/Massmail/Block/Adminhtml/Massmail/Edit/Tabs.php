<?php
 
class ElderXavier_Massmail_Block_Adminhtml_Massmail_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
 
    public function __construct()
    {
        parent::__construct();
        $this->setId('massmail_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('massmail')->__('Template Information')); 
    }
 
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('massmail')->__('Settings Template'),
            'title'     => Mage::helper('massmail')->__('Settings Template'),            
            'active' => true,            
        ));
       //'content'   => $this->getLayout()->createBlock('massmail/adminhtml_massmail_edit_tab_form')->toHtml(),
        return parent::_beforeToHtml();
    }
}