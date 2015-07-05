<?php
 
class ElderXavier_Massmail_Adminhtml_MassmailController extends Mage_Adminhtml_Controller_Action
{
 
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('massmail/send')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Mass Mail'));                        
        return $this;
    }   
   
    public function indexAction() {
        $this->_initAction();                              
        $this->getLayout()->getBlock('head')->setTitle($this->__('Mass Mail / Send'));
        $this->renderLayout();
    }
 
    public function editAction()
    { 
           // Mage::register('massmail_data', $massmailModel);
        $this->_initAction();         
        $this->loadLayout()
            ->_setActiveMenu('massmail/edit')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Mass Mail'));            
           
            if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
                $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
            }
            
            $this->getLayout()->getBlock('head')->setTitle($this->__('Mass Mail / Edit'));            
            $this->_addContent($this->getLayout()->createBlock('massmail/adminhtml_massmail_edit'));            
            $this->renderLayout();
       
    }
   
    public function newAction()
    {
        $this->_forward('edit');
    }
   
    public function saveAction()
    {
        echo "ok save";

        var_dump($_REQUEST);
        /*
        if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
                $massmailModel = Mage::getModel('massmail/massmail');
               
                $massmailModel->setId($this->getRequest()->getParam('id'))
                    ->setTitle($postData['title'])
                    ->setContent($postData['content'])
                    ->setStatus($postData['status'])
                    ->save();
               
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setmassmailData(false);
        */        
          //      $this->_redirect('*/*/');
        /*    return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setmassmailData($this->getRequest()->getPost());
        */
               // $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
        /*        return;
            }
        }
        */
        //$this->_redirect('*/*/');
    }   
   
    /**
     * Product grid for AJAX request.
     * Sort and filter result for example.
     */
    
    /*public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('massmail/adminhtml_massmail_grid')->toHtml()
        );
    }
    */
    public function testeAction()
    {
        echo "ok save<br>";

        var_dump($_REQUEST);
    }
}