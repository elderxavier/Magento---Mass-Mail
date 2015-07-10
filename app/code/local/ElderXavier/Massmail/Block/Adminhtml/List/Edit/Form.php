<?php
 
class ElderXavier_Massmail_Block_Adminhtml_List_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
                                        'id' => 'saveedit_form',
                                        'action' => $this->getUrl('*/*/editsave', array('id' => $this->getRequest()->getParam('id'))),                                        
                                        'method' => 'post',
                                     )
        );
        
        $fieldset   = $form->addFieldset('description_template', array(
            'legend'    => Mage::helper('massmail')->__("Edit Template"),
            'class'     => 'fieldset-wide-new',
        ));
        
        $fieldset->addField('template_id', 'text', array(
            'label'     => Mage::helper('massmail')->__('Template ID:'),
            'class'     => 'required-entry',
            'required'  => true,
            'readonly'  => false,
            'style'     => 'background-color: transparent;',
            'name'      => 'template_id',
        ));
        
        $fieldset->addField('template_name', 'text', array(
            'label'     => Mage::helper('massmail')->__('Template Name'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'template_name',
        ));

        $fieldset->addField('fromemail', 'text', array(
            'label'     => Mage::helper('massmail')->__('From (Email)'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'fromemail',
        ));

        $fieldset->addField('reply', 'text', array(
            'label'     => Mage::helper('massmail')->__('Reply-To (email)'),            
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'reply',
        ));

        $fieldset->addField('subject', 'text', array(
            'label'     => Mage::helper('massmail')->__('Subject'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'subject',
        ));        
        
        /*$fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('massmail')->__('Status'),
            'name'      => 'status',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('massmail')->__('Active'),
                ),
 
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('massmail')->__('Inactive'),
                ),
            ),
        ));*/
        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config');
        $fieldset->addField('description', 'editor', array(
            'name'      => 'description',
            'label'     => Mage::helper('massmail')->__('Description'),
            'title'     => Mage::helper('massmail')->__('Description'),
            'style'     => 'height: 600px; width: 800px;',
            'wysiwyg'   => true,
            'required'  => true,
            'config'    => $wysiwygConfig
        ));

        /*
        $fieldset->addField('description', 'editor', array(
            'name'      => 'content',
            'label'     => Mage::helper('massmail')->__('Description'),
            'title'     => Mage::helper('massmail')->__('Description'),
            'style'     => 'height: 600px; width: 800px;',
            'wysiwyg'   => true,
            'required'  => true,
        ));
        */
        $this->setForm($form);
        $form->setUseContainer(true);        
        //$this->getRequest()->getParam('template_id');
        //$this->getRequest()->getPost('template_id');

        if ( Mage::getSingleton('adminhtml/session')->getMassmailData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getMassmailData());
            Mage::getSingleton('adminhtml/session')->setMassmailData(null);
        } elseif ( Mage::registry('massmail_data') ) {
            $form->setValues(Mage::registry('massmail_data')->getData());
        }
        $this->getRequest()->getPost('template_id');
        //$this->getRequest()->getPost('template_id');
        
        return parent::_prepareForm();
    }
}
