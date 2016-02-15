<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 15.02.2016
 * Time: 22:00
 */

include_once Mage::getModuleDir('controllers', 'Mage_Adminhtml') . DS . 'Sales' . DS . 'OrderController.php';

class Cybernetikz_Salesreport_Adminhtml_Sales_OrderController extends Mage_Adminhtml_Sales_OrderController
{

    public function editFieldAction()
    {

        $postData = $this->getRequest()->getPost();

        //Mage::log('WACI_SalesExt_Adminhtml_Sales_OrderController::ordEditAction'.print_r($postData, true) );

        $id = $this->getRequest()->getParam('order_id');
        $order = Mage::getModel('sales/order')->load($id);
        $order->setRef($postData['ref']);

        $order->save();

        // return to sales_order view
        Mage::app()->getResponse()->setRedirect(Mage::helper('adminhtml')->getUrl("adminhtml/sales_order/view", array('order_id'=> $id)));

    }

}