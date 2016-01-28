<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 27.01.2016
 * Time: 21:05
 */

class Veeble_Gifregisrty_Model_Mysql4_Entity extends Mage_Core_Model_Mysql4_Abstract{
    function _construct()
    {
        $this->_init('veeble_giftregistry/entity', 'entity_id');
    }
}