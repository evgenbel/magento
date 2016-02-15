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

    public function testAction()
    {
        $params = array(
            'siteUrl' => 'http://m2.magento192.invbl.ru/oauth',
            'requestTokenUrl' => 'http://m2.magento192.invbl.ru/oauth/initiate',
            'accessTokenUrl' => 'http://m2.magento192.invbl.ru/oauth/token',
            'authorizeUrl' => 'http://m2.magento192.invbl.ru/admin/',//This URL is used only if we authenticate as Admin user type
            'consumerKey' => '618ea092fdd7fc3710f968f58f0b2014',//Consumer key registered in server administration
            'consumerSecret' => '52dcbcbe68cae8373124b286a4e106b1',//Consumer secret registered in server administration
            'callbackUrl' => 'http://m2.magento192.invbl.ru/giftregistry/index/test2',//Url of callback action below
        );

        // Initiate oAuth consumer with above parameters
        $consumer = new Zend_Oauth_Consumer($params);
        // Get request token
        $requestToken = $consumer->getRequestToken();
        // Get session
        $session = Mage::getSingleton('core/session');
        // Save serialized request token object in session for later use
        $session->setRequestToken(serialize($requestToken));
        // Redirect to authorize URL
        $consumer->redirect();
        exit;
    }

    public function test2Action(){
        //oAuth parameters
        $params = array(
            'siteUrl' => 'http://m2.magento192.invbl.ru/oauth',
            'requestTokenUrl' => 'http://m2.magento192.invbl.ru/oauth/initiate',
            'accessTokenUrl' => 'http://m2.magento192.invbl.ru/oauth/token',
            'consumerKey' => '618ea092fdd7fc3710f968f58f0b2014',
            'consumerSecret' => '52dcbcbe68cae8373124b286a4e106b1'
        );

        // Get session
        $session = Mage::getSingleton('core/session');
        // Read and unserialize request token from session
        $requestToken = unserialize($session->getRequestToken());
        // Initiate oAuth consumer
        $consumer = new Zend_Oauth_Consumer($params);

        $acessToken = $consumer->getAccessToken($_GET, $requestToken);
        $restClient = $acessToken->getHttpClient($params);
        $restClient->setUri('http://m2.magento192.invbl.ru/api/rest/products');
        $restClient->setHeaders('Accept', 'application/json');
        $restClient->setMethod(Zend_Http_Client::GET);
        $response = $restClient->request();
        $body = $response->getBody();
        var_dump($body);
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
            if ($registryId) {
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
        $this->_redirect('*/*/');
    }

    public function newAction()
    {
        $this->_initModel();
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }
    public function editAction()
    {
        $this->_initModel();
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            try {
                $model = $this->_initModel();
                if($model === false)
                {
                    throw new Exception("There was a problem saving the registry");
                }
                $customer   = Mage::getSingleton('customer/session')->getCustomer();
                // Update the model with the form data
                $model->updateRegistryData($customer, $data);
                $model->save();
                Mage::getSingleton('core/session')
                    ->addSuccess($this->__('The gift registry has been saved.'));
                if ($redirectBack = $this->getRequest()->getParam('back', false)) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId(), 'store' => $model->getStoreId()));
                    return;
                }
            } catch (Mage_Core_Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('core/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $model->getId()));
                return;
            } catch (Exception $e) {
                Mage::getSingleton('core/session')->addError($this->__('There was an error trying to save the gift registry.'));
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/');
    }

    public function _initModel($param = 'registry_id')
    {
        $model = Mage::getModel('veeble_giftregistry/entity');
        $model->setStoreId($this->getRequest()->getParam('store', 0));
        if( $modelId = $this->getRequest()->getParam($param))
        {
            $model->load($modelId);
            if(!$model->getId())
            {
                Mage::throwException($this->__('There was a problem initializing the gift registry.'));
            }
        }
        Mage::register('current_giftregistry', $model);
        return $model;
    }

}