<?php

/**
 * Created by PhpStorm.
 * User: Evgenii
 * Date: 28.01.2016
 * Time: 9:57
 */
class Veeble_Giftregistry_IndexController extends Mage_Core_Controller_Front_Action
{
    public function preDispatch()
    {
        parent::preDispatch();
        if (!Mage::getSingleton('customer/session')->authenticate($this)) {
            $this->getResponse()->setRedirect(Mage::helper('customer')->getLoginUrl());
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
        }
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function deleteAction()
    {
        try {
            $registryId = $this->getRequest()->getParam('registry_id');
            if ($registryId && $this->getRequest()->isPost()) {
                if ($registry = Mage::getModel('veeble_giftregistry/entity')->load($registryId)) {
                    $registry->delete();
                    $successMessage = Mage::helper('veeble_giftregistry')->__('Gift registry has been succesfully deleted.');
                    Mage::getSingleton('core/session')->addSuccess($successMessage);
                } else {
                    throw new Exception("There was a problem deleting the registry");
                }
            }
        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
    }

    public function newAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function editAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function newPostAction()
    {
        try {
            $data = $this->getRequest()->getParams();
            $registry = Mage::getModel('veeble_giftregistry/entity');
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            if ($this->getRequest()->isPost() && !empty($data)) {
                $data['event_date'] = date('Y-m-d');
                $registry->updateRegistryData($customer, $data);
                $registry->save();
                $successMessage = Mage::helper('veeble_giftregistry')->__('Registry Successfully Created');
                Mage::getSingleton('core/session')->addSuccess($successMessage);
            } else {
                throw new Exception("Insufficient Data provided");
            }
        } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
        $this->_redirect('*/*/');
    }

    public function editPostAction()
    {
        try {
            $data = $this->getRequest()->getParams();
            $registry = Mage::getModel('veeble_giftregistry/entity');
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            if ($this->getRequest()->isPost() && !empty($data)) {
                $registry->load($data['registry_id']);
                if ($registry) {
                    $registry->updateRegistryData($customer, $data);
                    $registry->save();
                    $successMessage = Mage::helper('veeble_giftregistry')->__('Registry Successfully Created');
                    Mage::getSingleton('core/session')->addSuccess($successMessage);
                } else {
                    throw new Exception("Invalid Registry Specified");
                }
            } else {
                throw new Exception("Insufficient Data provided");
            }
        } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
        $this->_redirect('*/*/');
    }
}