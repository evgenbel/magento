<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 27.01.2016
 * Time: 21:03
 */

class Veeble_Giftregistry_Model_Mysql4_Item extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('veeble_giftregistry/item', 'item_id');
    }
}