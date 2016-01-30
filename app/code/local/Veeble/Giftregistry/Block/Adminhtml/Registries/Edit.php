<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 30.01.2016
 * Time: 17:12
 */

class Veeble_Giftregistry_Block_Adminhtml_Registries_Edit extends
    Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct(){
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'veeble_giftregistry';
        $this->_controller = 'adminhtml_registries';
        $this->_mode = 'edit';
        $this->_updateButton('save', 'label', Mage::helper('veeble_giftregistry')->__('Save Registry'));
        $this->_updateButton('delete', 'label',Mage::helper('veeble_giftregistry')->__('Delete Registry'));
    }

    public function getHeaderText(){
        if(Mage::registry('registries_data') &&
            Mage::registry('registries_data')->getId())
            return Mage::helper('veeble_giftregistry')->__("Edit Registry '%s'", $this->escapeHtml(Mage::registry('registries_data')->getTitle()));
        return Mage::helper('veeble_giftregistry')->__('Add Registry');
    }
}