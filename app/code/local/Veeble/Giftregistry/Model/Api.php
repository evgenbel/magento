<?php

/**
 * Created by PhpStorm.
 * User: Evgenii
 * Date: 05.02.2016
 * Time: 9:37
 */
class Veeble_Giftregisty_Model_Api extends Mage_Api_Model_Resource_Abstract
{
    public function getRegistryList($customerId = null)
    {
        $registryCollection = Mage::getModel('veeble_giftregistry/entity')->getCollection();
        if (!is_null($customerId)) {
            $registryCollection->addFieldToFilter('customer_id', $customerId);
        }
        return $registryCollection;
    }

    public function getRegistryInfo($registryId)
    {
        if (!is_null($registryId)) {
            $registry = Mage::getModel('veeble_giftregistry/entity')->load($registryId);
            if ($registry) {
                return $registry;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getRegistryItems($registryId)
    {
        if (!is_null($registryId)) {
            $registryItems = Mage::getModel('veeble_giftregistry/item')->getCollection();
            $registryItems->addFieldToFilter('registry_id', $registryId);
            return $registryItems;
        } else {
            return false;
        }

    }

    public function getRegistryItemInfo($registryItemId)
    {
        if (!is_null($registryItemId)) {
            $registryItem = Mage::getModel('veeble_giftregistry/item')->load($registryItemId);
            if ($registryItem) {
                return $registryItem;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}