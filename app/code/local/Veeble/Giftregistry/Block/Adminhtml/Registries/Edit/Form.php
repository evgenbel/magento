<?php

/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 30.01.2016
 * Time: 17:44
 */
class Veeble_Giftregistry_Block_Adminhtml_Registries_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $websites = Mage::app()->getWebsites();
        $resW = array();
        foreach($websites as $k=>$website){
            $resW[$k] = $website->getName();
        }
        $customers = array();
        $helper = Mage::helper('customer');
        foreach(Mage::getModel('customer/customer')->getCollection()->addAttributeToSelect(array('firstname', 'lastname')) as $item){
            $customers[$item->getId()] = $helper->getFullCustomerName($item);
        }
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array
            ('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $form->setUseContainer(true);
        $this->setForm($form);
        if (Mage::getSingleton('adminhtml/session')->getFormData()) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData();
            Mage::getSingleton('adminhtml/session')->setFormData(null);
        } elseif (Mage::registry('registry_data'))
            $data = Mage::registry('registry_data')->getData();

        $fieldset = $form->addFieldset('registry_form',
            array('legend' => Mage::helper('veeble_giftregistry')->__('Gift Registry information')));

        $fieldset->addField('customer_id', 'select', array(
            'label' => Mage::helper('veeble_giftregistry')->__('Customer Id'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'customer_id',
            'values'    =>  $customers
        ));

        $fieldset->addField('type_id', 'select', array(
            'label' => Mage::helper('veeble_giftregistry')->__('Type Id'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'type_id',
            'values'    =>  Mage::getModel('veeble_giftregistry/type')->getOptionArray()
        ));
        $fieldset->addField('website_id', 'select', array(
            'label' => Mage::helper('veeble_giftregistry')->__('Website Id'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'website_id',
            'values'    => $resW
        ));

        $fieldset->addField('event_location', 'text', array(
                'label' => Mage::helper('veeble_giftregistry')->__('Event Location'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'event_location',
            ));
        $fieldset->addField('event_date', 'date', array(
            'label' => Mage::helper('veeble_giftregistry')->__('Event Date'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'event_date',
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'format' => 'dd.M.yyyy'// Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
        ));
        $fieldset->addField('event_country', 'text', array(
            'label' => Mage::helper('veeble_giftregistry')->__('Event Country'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'event_country',
        ));
        $form->setValues($data);
        return parent::_prepareForm();
    }
}