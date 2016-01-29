<?php

/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 28.01.2016
 * Time: 22:13
 */
class Veeble_Giftregistry_Block_Item extends Mage_Core_Block_Template
{
    public function getItems($registry)
    {
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        if ($customer) {
            $giftTable =  Mage::getSingleton('core/resource')->getTableName('veeble_giftregistry/item');

            $collection = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToSelect(array('name', 'url', 'small_image', 'price', 'short_description'));

            $collection->getSelect()->join(array("g"=>$giftTable), "e.entity_id=g.product_id AND registry_id=".$registry->getId(), array("g.registry_id", "g.item_id"));
            return $collection;
        } else {
            return false;
        }
    }
}