<?php

/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 26.01.2016
 * Time: 22:42
 */
class Veeble_Giftregistry_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function getEventTypes()
    {
        $collection = Mage::getModel('veeble_giftregistry/type')->getCollection();
        return $collection;
    }

    public function isRegistryOwner($registryCustomerId)
    {
        $currentCustomer = Mage::getSingleton('customer/session')->getCustomer();
        if ($currentCustomer && $currentCustomer->getId() == $registryCustomerId) {
            return true;
        }
        return false;
    }
}