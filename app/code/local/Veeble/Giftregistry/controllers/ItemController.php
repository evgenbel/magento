<?php

/**
 * Created by PhpStorm.
 * User: Evgenii
 * Date: 28.01.2016
 * Time: 9:57
 */
class Veeble_Giftregistry_ItemController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function deleteAction()
    {
        try {
            $data = $this->getRequest()->getParams();
            $product_id = $data['product_id'];
            $registry_id = $data['registry_id'];
            if ($registry_id && $product_id ) {
                $collection = Mage::getModel('veeble_giftregistry/item')->getCollection()
                    ->addFieldToFilter("product_id", $product_id)
                    ->addFieldToFilter("registry_id", $registry_id);
                foreach ($collection as $item) {
                    $item->delete();
                }
            }
        }catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
        $this->_redirect('*/*/');
    }

    public function editAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function addAction()
    {
        try {
            $data = $this->getRequest()->getParams();
            $registryItem = Mage::getModel('veeble_giftregistry/item');
            if($this->getRequest()->getPost() && !empty($data)) {
                $registryItem->setProductId($data['product_id']);
                $registryItem->setRegistryId($data['registry_id']);
                $registryItem->save();
                $successMessage =  Mage::helper('veeble_giftregistry')->__('Product Successfully Added to the Registry');
                Mage::getSingleton('core/session')->addSuccess($successMessage);
            }else{
                throw new Exception("Insufficient Data provided");
            }
        } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirectUrl($this->_getRefererUrl());
        }
        $this->_redirectUrl($this->_getRefererUrl());
    }

}