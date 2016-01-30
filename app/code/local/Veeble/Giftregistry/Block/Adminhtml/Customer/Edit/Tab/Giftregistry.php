<?php

/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 30.01.2016
 * Time: 13:28
 */
class Veeble_Giftregistry_Block_Adminhtml_Customer_Edit_Tab_Giftregistry extends Mage_Adminhtml_Block_Template
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function __construct()
    {
        $this->setTemplate('veeble/giftregistry/customer/main.phtml');
        parent::_construct();
    }

    public function getCustomerId()
    {
        return Mage::registry('current_customer')->getId();
    }

    public function getTabLabel()
    {
        return $this->__('GiftRegistry List');
    }

    public function getTabTitle()
    {
        return $this->__('Click to view the customer Gift Registries');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}