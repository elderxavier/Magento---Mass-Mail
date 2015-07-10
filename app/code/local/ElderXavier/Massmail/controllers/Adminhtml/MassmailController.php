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
    
     public function listAction()
    {        
       // $this->_forward('edit');        
        $this->_initAction();         
        $this->loadLayout()
            ->_setActiveMenu('massmail/edit')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Mass Mail'));                                                                      
            $this->_addContent($this->getLayout()->createBlock('massmail/adminhtml_list'));             
            $this->renderLayout();            
    }

    public function editAction()
    { 
        $massmailId     = $this->getRequest()->getParam('id');
        $massmailModel  = Mage::getModel('massmail/massmail')->load($massmailId);
        
        Mage::register('massmail_data', $massmailModel);
        $this->_initAction();  
            $this->loadLayout();
            if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
                $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
            }
            $this->_setActiveMenu('massmail/items');           
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));           
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);              
            $this->_addContent($this->getLayout()->createBlock('massmail/adminhtml_list_edit'))
                 ->_addLeft($this->getLayout()->createBlock('massmail/adminhtml_list_edit_tabs'));

            
            $this->getLayout()->getBlock('head')->setTitle($this->__('Mass Mail / Edit'));
            $this->renderLayout();
       
    }
   
    public function newAction()
    {        
        $this->_initAction();         
        $this->loadLayout()
            ->_setActiveMenu('massmail/edit')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Mass Mail'));            
           
            if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
                $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
            }
            
            $this->getLayout()->getBlock('head')->setTitle($this->__('Mass Mail / New')); 
            $this->_addContent($this->getLayout()->createBlock('massmail/adminhtml_massmail_edit'))
                 ->_addLeft($this->getLayout()->createBlock('massmail/adminhtml_massmail_edit_tabs'));                       
            $this->renderLayout();       
    }
            
    
   
    public function saveAction()
    {        
        if ( $this->getRequest()->getPost() ) {
            try {                                                
                $massmailModel = Mage::getModel('massmail/massmail');
               
                $massmailModel
                    //->setId($this->getRequest()->getParam('id'))
                    ->setData('template_id',$this->getRequest()->getPost('template_id'))
                    ->setData('template_name',$this->getRequest()->getPost('template_name'))
                    ->setData('fromemail',$this->getRequest()->getPost('fromemail'))
                    ->setData('reply',$this->getRequest()->getPost('reply'))                    
                    ->setData('subject',$this->getRequest()->getPost('subject'))
                    ->setData('description',$this->getRequest()->getPost('description'))
                    ->setData('created_time',date('Y-m-d H:i:s'))
                    ->save();                                    
                $this->_redirect('*/*/list');
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Template was successfully saved'));
                //Mage::getSingleton('adminhtml/session')->setmassmailData(false);                
            
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                //Mage::getSingleton('adminhtml/session')->setmassmailData($this->getRequest()->getPost());                
            }
        }        
    }       

    public function editsaveAction()
    {          
        
        if ( $this->getRequest()->getPost() ) {
            try {                                
          
                $massmailModel = Mage::getModel('massmail/massmail');
               
                $massmailModel
                    ->setId($this->getRequest()->getParam('id'))
                    ->setData('template_id',$this->getRequest()->getPost('template_id'))
                    ->setData('template_name',$this->getRequest()->getPost('template_name'))
                    ->setData('fromemail',$this->getRequest()->getPost('fromemail'))
                    ->setData('reply',$this->getRequest()->getPost('reply'))                    
                    ->setData('subject',$this->getRequest()->getPost('subject'))
                    ->setData('description',$this->getRequest()->getPost('description'))
                    ->setData('created_time',date('Y-m-d H:i:s'))
                    ->save();                                                 
                $this->_redirect('*/*/list');
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Template was successfully saved'));
                //Mage::getSingleton('adminhtml/session')->setmassmailData(false);                
            
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                //Mage::getSingleton('adminhtml/session')->setmassmailData($this->getRequest()->getPost());                
            }
        } 
        
               
    }
    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $massmailModel = Mage::getModel('massmail/massmail');
               
                $massmailModel->setId($this->getRequest()->getParam('id'))
                    ->delete();                   
                $this->_redirect('*/*/list');
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Template was successfully deleted'));                
            } catch (Exception $e) {
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                
            }
        }
        
    }       

    public function sendAction()
    {        
        if( $this->getRequest()->getPost('massaction')) {
            try {
                $groupidcurtomes = $this->getRequest()->getPost('massaction');

                $customer = Mage::getModel('customer/customer');        
                $sql = Mage::helper('massmail')->getTemplatesArray();
                $sql->execute();
                $data  = $sql->fetchAll();
                $emailModel = $data[$this->getRequest()->getPost('template')];
                $logfile = "massmail".str_replace("-","",date("Y-m-d"));
                foreach ($groupidcurtomes as $key => $id) {
                    $customer->load($id);                    
                    $message = $mailmodel = str_replace('{{name}}', $customer->getName(), $emailModel['description']);
                    if(!Mage::helper('massmail')->sendMails($customer->getEmail(), $emailModel['subject'], $message)){                        
                        Mage::log("error send email for ".$customer->getEmail(), null, $logfile.".".log);
                    }
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('E-mails successfully sent'));
                $this->_redirect('*/*/index');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/index');                
            }
        }
        
    }       

    public function massdeleteAction()
    {
        echo "ok massdelete<br>"; 

        if( $this->getRequest()->getPost('massaction') ) {
            try {
                $groupidcurtomes = $this->getRequest()->getPost('massaction');                
                $massmailModel = Mage::getModel('massmail/massmail');

               foreach ($groupidcurtomes as $key => $id) {                                        
                        $massmailModel->setId($id)
                        ->delete();                      
                }  
                $this->_redirect('*/*/list');               
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('templates successfully deleted'));
                
            } catch (Exception $e) {
                $this->_redirect('*/*/list');
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                
            }
        }
        
    }         
    
}