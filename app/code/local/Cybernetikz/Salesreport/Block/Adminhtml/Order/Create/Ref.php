<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 15.02.2016
 * Time: 21:24
 */

class Cybernetikz_Salesreport_Block_Adminhtml_Order_Create_Ref extends Mage_Adminhtml_Block_Template
{
    public function load(){
        $order = Mage::getModel('sales/order');
        return $order;
    }
    public function getOrder(){
        return Mage::registry('current_order');
    }

    public function getFormUrl(){
        return Mage::helper("adminhtml")->getUrl('*/sales_order/editField', array('order_id'=>$this->getOrder()->getId()) );
    }

}