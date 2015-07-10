<?php
 
class ElderXavier_Massmail_Block_Adminhtml_List_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('massmailGrid');
        // This is the primary key of the database
        $this->setDefaultSort('massmail_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('massmail/massmail')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {
        $this->addColumn('massmail_id', array(
            'header'    => Mage::helper('massmail')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'massmail_id',
        ));        

        $this->addColumn('template_id', array(
            'header'    => Mage::helper('massmail')->__('Template ID'),
            'align'     =>'center',
            'width'     => '200px',
            'index'     => 'template_id',
        ));

        $this->addColumn('template_name', array(
            'header'    => Mage::helper('massmail')->__('Title'),
            'align'     =>'left',
            'index'     => 'template_name',
        ));
 
        /*
        $this->addColumn('content', array(
            'header'    => Mage::helper('<module>')->__('Item Content'),
            'width'     => '150px',
            'index'     => 'content',
        ));
        */
 
        $this->addColumn('created_time', array(
            'header'    => Mage::helper('massmail')->__('Creation Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'created_time',
        ));
 
        $this->addColumn('update_time', array(
            'header'    => Mage::helper('massmail')->__('Update Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'update_time',
        ));   
 
 
        $this->addColumn('status', array(
 
            'header'    => Mage::helper('massmail')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                1 => 'Active',
                0 => 'Inactive',
            ),
        ));
 
        return parent::_prepareColumns();
    }
    
    protected function _prepareMassaction()
    {
        $sql = Mage::helper('massmail')->getTemplatesArray();
        $sql->execute();
        $data  = $sql->fetchAll(PDO::FETCH_ASSOC |PDO::FETCH_COLUMN, 1);
        //$sql->setFetchMode(PDO::FETCH_ASSOC);        
        //$data->fetchAll(PDO::FETCH_COLUMN, 1);

        array_unshift($groups, array('label'=> '', 'value'=> ''));
        $this->setMassactionIdField('email');        
        $this->getMassactionBlock()->addItem('delete_emails', array(
             'label'    => Mage::helper('massmail')->__('Delete emails'),
             'url'      => $this->getUrl('*/*/massdelete'),                                  
        ));

 
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
 
    public function getGridUrl()
    {
      return $this->getUrl('*/*/grid', array('_current'=>true));
    }
 
 
}