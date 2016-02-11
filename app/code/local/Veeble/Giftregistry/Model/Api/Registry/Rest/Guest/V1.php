<?php
/**
 * Created by PhpStorm.
 * User: Evgenii
 * Date: 05.02.2016
 * Time: 10:27
 */

class Veeble_Giftregistry_Model_Api_Registry_Rest_Guest_V1 extends
    Mage_Catalog_Model_Api2_Product_Rest {
 /**
  * @return stdClass
  */
    public function _retrieve()
    {
        $productId = $this->getRequest()->getParam('registry_id');
        $registryCollection = Mage::getModel('veeble_giftregistry/entity')->load($productId);
        return $registryCollection->toArray();
    }

    public function _retrieveCollection(){
        $registryCollection = Mage::getModel('veeble_giftregistry/entity')->getCollection();
        $items = $registryCollection->load();
        return $items->toArray()['items'];
    }
}
