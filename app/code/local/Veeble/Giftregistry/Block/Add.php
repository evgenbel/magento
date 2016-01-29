<?php

/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 28.01.2016
 * Time: 22:13
 */
class Veeble_Giftregistry_Block_Add extends Mage_Core_Block_Template
{
    public function getCustomerRegistryCollection()
    {
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        if ($customer) {
            $collection = Mage::getModel('veeble_giftregistry/entity')->getCollection()
                ->addFieldToFilter('customer_id', $customer->getId());
            return $collection;
        } else {
            return false;
        }
    }
}