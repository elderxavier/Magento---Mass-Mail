<?php
 
class ElderXavier_Massmail_Adminhtml_MassmailController extends Mage_Adminhtml_Controller_Action
{
 
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('massmail/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }   
   
    public function indexAction() {
        $this->_initAction();       
        //$this->_addContent($this->getLayout()->createBlock('massmail/adminhtml_massmail'));
        $this->renderLayout();
    }
 
    public function editAction()
    {
        $massmailId     = $this->getRequest()->getParam('id');
       // $massmailModel  = Mage::getModel('massmail/massmail')->load($massmailId);
 
       // if ($massmailModel->getId() || $massmailId == 0) {
 
           // Mage::register('massmail_data', $massmailModel);
 
            $this->loadLayout();
            $this->_setActiveMenu('massmail/items');
           
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
           
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('massmail/adminhtml_massmail_edit'));
            
            //$this->_addContent($this->getLayout()->createBlock('massmail/adminhtml_massmail_edit'))
              //   ->_addLeft($this->getLayout()->createBlock('massmail/adminhtml_massmail_edit_tabs'));
               
            $this->renderLayout();
       // } else {
        //    Mage::getSingleton('adminhtml/session')->addError(Mage::helper('massmail')->__('Item does not exist'));
        //    $this->_redirect('*/*/');
        //}
    }
   
    public function newAction()
    {
        $this->_forward('edit');
    }
   
    public function saveAction()
    {
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
 
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setmassmailData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }
   
    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $massmailModel = Mage::getModel('massmail/massmail');
               
                $massmailModel->setId($this->getRequest()->getParam('id'))
                    ->delete();
                   
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
    /**
     * Product grid for AJAX request.
     * Sort and filter result for example.
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('massmail/adminhtml_massmail_grid')->toHtml()
        );
    }
}