<?php

/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 30.01.2016
 * Time: 15:03
 */
class Veeble_Giftregistry_Block_Adminhtml_Registries extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_registries';
        $this->_blockGroup = 'veeble_giftregistry';
        $this->_headerText = Mage::helper('veeble_giftregistry')->__('Gift Registry Manager');
        parent::__construct();
    }
}