<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 27.01.2016
 * Time: 21:01
 */

class Veeble_Giftregistry_Model_Mysql4_Item_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('veeble_giftregistry/item');
        parent::_construct();
    }
}