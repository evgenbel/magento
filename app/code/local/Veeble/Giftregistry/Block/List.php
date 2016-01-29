<?php

/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 28.01.2016
 * Time: 22:13
 */
class Veeble_Giftregistry_Block_List extends Mage_Core_Block_Template
{
    public function getCustomerRegistries()
    {
        $collection = null;
        if (!$collection = $this->getData('customer_registries')){
            $currentCustomer = Mage::getSingleton('customer/session')->getCustomer();
            if ($currentCustomer) {
                $collection = Mage::getModel('veeble_giftregistry/entity')->getCollection()
                    ->addFieldToFilter('customer_id', $currentCustomer->getId());
            }
        }

        return $collection;
    }
}