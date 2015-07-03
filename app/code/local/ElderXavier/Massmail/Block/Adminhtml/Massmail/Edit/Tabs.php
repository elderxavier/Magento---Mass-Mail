<?php
 
class ElderXavier_Massmail_Block_Adminhtml_Massmail_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
 
    public function __construct()
    {
        parent::__construct();
        $this->setId('massmail_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('massmail')->__('News Information'));
    }
 
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('massmail')->__('Item Information'),
            'title'     => Mage::helper('massmail')->__('Item Information'),
            'content'   => $this->getLayout()->createBlock('massmail/adminhtml_massmail_edit_tab_form')->toHtml(),
        ));
       
        return parent::_beforeToHtml();
    }
}