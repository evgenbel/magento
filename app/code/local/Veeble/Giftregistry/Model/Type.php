<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 27.01.2016
 * Time: 20:58
 */

class Veeble_Giftregistry_Model_Type extends Mage_Core_Model_Abstract
{
    public function __construct()
    {
        $this->_init('veeble_giftregistry/type');
        parent::_construct();
    }
}