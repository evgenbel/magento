<?php

/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 30.01.2016
 * Time: 13:16
 */
class Veeble_Giftregistry_Adminhtml_GiftregistryController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id', null);
        $registry = Mage::getModel('veeble_giftregistry/entity');

        if ($id) {
            $registry->load((int) $id);
            if ($registry->getId()) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if ($data) {
                    $registry->setData($data)->setId($id);
                }
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('awesome')->__('The Gift Registry does not exist'));
                $this->_redirect('*/*/');
            }
        }
        Mage::register('registry_data', $registry);
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($this->getRequest()->getPost())
        {
            try {
                $data = $this->getRequest()->getPost();
                $id = $this->getRequest()->getParam('id');
                if ($data && $id) {
                    $registry = Mage::getModel('veeble_giftregistry/entity')->load($id);
                    $registry->addData($data);
                    $registry->save();
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                }
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('veeble_giftregistry')->__('An error occurred while saving the registry data. Please review the log and try again.' . $this->getRequest()->getParam('id'))
                );
                Mage::logException($e);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return $this;
            }
        }
        $this->_redirect('*/*');
    }

    public function newAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function massDeleteAction()
    {
        $registryIds = $this->
        getRequest()->getParam('registries');
        if(!is_array($registryIds)) {
            Mage::getSingleton('adminhtml/session')->
            addError(Mage::helper('veeble_giftregistry')->
                __('Please select one or more registries.'));
        } else {
            try {
                $registry = Mage::getModel('veeble_giftregistry/entity');
                foreach ($registryIds as $registryId) {
                    $registry->reset()
                        ->load($registryId)
                        ->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__
                    ('Total of %d record(s) were deleted.',
                        count($registryIds))
                );
            } catch (Exception $e) {
                Mage::getSingleton
                ('adminhtml/session')->
                addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massDisableAction()
    {
        $registryIds = $this->getRequest()->getParam('registries');
        if(!is_array($registryIds)) {
            Mage::getSingleton('adminhtml/session')->
            addError(Mage::helper('veeble_giftregistry')->
                __('Please select one or more registries.'));
        } else {
            try {
                $registry = Mage::getModel('veeble_giftregistry/entity');
                foreach ($registryIds as $registryId) {
                    $item = $registry->load($registryId);
                    $item->disable();
                    $item->save();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__
                    ('Total of %d record(s) were deleted.',
                        count($registryIds))
                );
            } catch (Exception $e) {
                Mage::getSingleton
                ('adminhtml/session')->
                addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');

    }

    public function massEnableAction()
    {
        $registryIds = $this->getRequest()->getParam('registries');
        if(!is_array($registryIds)) {
            Mage::getSingleton('adminhtml/session')->
            addError(Mage::helper('veeble_giftregistry')->
                __('Please select one or more registries.'));
        } else {
            try {
                $registry = Mage::getModel('veeble_giftregistry/entity');
                foreach ($registryIds as $registryId) {
                    $item = $registry->load($registryId);
                    $item->enable();
                    $item->save();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__
                    ('Total of %d record(s) were deleted.',
                        count($registryIds))
                );
            } catch (Exception $e) {
                Mage::getSingleton
                ('adminhtml/session')->
                addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');

    }
}