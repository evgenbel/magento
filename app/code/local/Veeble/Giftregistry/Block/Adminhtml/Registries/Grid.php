<?php

/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 30.01.2016
 * Time: 16:04
 */
class Veeble_Giftregistry_Block_Adminhtml_Registries_Grid extends
    Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('registriesGrid');
        $this->setDefaultSort('event_date');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('veeble_giftregistry/entity')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $customers = array();
        $helper = Mage::helper('customer');
        foreach(Mage::getModel('customer/customer')->getCollection()->addAttributeToSelect(array('firstname', 'lastname')) as $item){
            $customers[$item->getId()] = $helper->getFullCustomerName($item);
        }

        $this->addColumn('customer_id', array(
            'header' => Mage::helper('veeble_giftregistry')->__('Customer'),
            'index' => 'customer_id',
            'sortable' => false,
            'type'  => 'options',
            'options' => $customers,
        ));
        $this->addColumn('entity_id', array(
            'header' => Mage::helper('veeble_giftregistry')->__('Id'),
            'width' => 50,
            'index' => 'entity_id',
            'sortable' => false,
        ));
        $this->addColumn('event_location', array(
            'header' => Mage::helper('veeble_giftregistry')->__('Location'),
            'index' => 'event_location',
            'sortable' => false,
        ));
        $this->addColumn('event_date', array(
            'header' => Mage::helper('veeble_giftregistry')->__('Event Date'),
            'index' => 'event_date',
            'sortable' => false,
        ));
        $this->addColumn('type_id', array(
            'header' => Mage::helper('veeble_giftregistry')->__('Event Type'),
            'index' => 'type_id',
            'sortable' => false,
            'type'  => 'options',
            'options' => Mage::getSingleton('veeble_giftregistry/type')->getOptionArray(),
        ));
        $this->addColumn('status', array(
            'header' => Mage::helper('veeble_giftregistry')->__('Status'),
            'index' => 'status',
            'sortable' => false,
            'type'  => 'options',
            'options' => Mage::getSingleton('veeble_giftregistry/entity')->getStatuses(),
        ));
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array
        ('id' => $row->getEntityId()));
    }

    protected function _prepareMassaction(){
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->
        setFormFieldName('registries');
        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('veeble_giftregistry')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('veeble_giftregistry')->__('Are you sure?')
        ))->addItem('disabled', array(
            'label' => Mage::helper('veeble_giftregistry')->__('Disable'),
            'url' => $this->getUrl('*/*/massDisable'),
            'confirm' => Mage::helper('veeble_giftregistry')->__('Are you sure?')
        ))->addItem('enable', array(
            'label' => Mage::helper('veeble_giftregistry')->__('Enable'),
            'url' => $this->getUrl('*/*/massEnable'),
            'confirm' => Mage::helper('veeble_giftregistry')->__('Are you sure?')
        ));
        return $this;
    }
}