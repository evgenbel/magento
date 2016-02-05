<?php
/**
 * Created by PhpStorm.
 * User: Evgenii
 * Date: 05.02.2016
 * Time: 10:27
 */

class Mdg_Giftregistry_Model_Api_Registry_Rest_Admin_V1 extends
    Mage_Catalog_Model_Api2_Product_Rest {
 /**
  * @return stdClass
  */
    public function _retrieve()
    {
        $registryCollection = Mage::getModel('veeble_giftregistry/entity')->getCollection();
        return $registryCollection;
    }
}
