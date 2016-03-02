<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 02.03.2016
 * Time: 22:12
 */

class Veeble_Giftregistry_Test_Mink_Registry extends JR_Mink_Test_Mink
{
    public function testAddProductToRegistry()
    {
        $this->section('TEST ADD PRODUCT TO REGISTRY');
        $this->setCurrentStore('default');
        $this->setDriver('goutte');
        $this->context();
        // Go to homepage
        $this->output($this->bold('Go To the Homepage'));
        $url = Mage::getStoreConfig('web/unsecure/base_url');
        $this->visit($url);
        $category = $this->find('css', '#nav .nav-1-1 a');
        if (!$category) {
            return false;
        }
        // Go to the Login page
        $links = $this->findAll('css', 'div.links li');
        if ($links) {
            foreach($links as $link){
                $a = $link->find('css','a');

                if ($a->getAttribute('title')=='Log In'){
                    $this->visit($a->getAttribute('href'));
                    break;
                }
            }
        }
        $login = $this->find('css', '#email');
        $pwd = $this->find('css', '#pass');
        $submit = $this->find('css', '#send2');
        if ($login && $pwd && $submit) {
            $email = 'evgenbel@bk.ru';
            $password = 'Abra123';
            $this->output(sprintf("Try to authenticate '%s' with password '%s'", $email, $password));
            $login->setValue($email);
            $pwd->setValue($password);
            $submit->click();
            $this->attempt(
                $this->find('css', 'div.welcome-msg'),
                'Customer successfully logged in',
                'Error authenticating customer'
            );
        }
        // Go to the category page
        $this->output($this->bold('Go to the category list'));
        $this->visit($category->getAttribute('href'));
        $product = $this->find('css', '.category-products li a');
        if (!$product) {
            return false;
        }
        // Go to product view
        $this->output($this->bold('Go to product view'));
        $this->visit($product->getAttribute('href'));
        $form = $this->find('css', '#product_registry_form');
        $registry = $this->find('css', '#registry_id');
        $submit = $form->find('css', 'button');
        if ($form) {
            $registry->setValue(5);
            $submit->click();
            $this->attempt(
                $this->find('css', '.success-msg'),
                'Product added to gift registry successfully',
                'Error adding product to gift registry'
            );
        }
    }
}