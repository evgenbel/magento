<?php

/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 27.01.2016
 * Time: 20:58
 */
class Veeble_Giftregistry_Model_Mysql4_Type extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('veeble_giftregistry/type', 'type_id');
    }
}