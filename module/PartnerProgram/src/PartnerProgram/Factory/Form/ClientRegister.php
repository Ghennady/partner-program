<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 16:27
 */

namespace PartnerProgram\Factory\Form;


use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ClientRegister implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new Form();
        $name = new Text('name', ['label' => 'Client Name']);
        
        $partnerId = new Text('partnerId', ['label' => 'Partner id']);

        $submit = new Submit('register');
        $submit->setValue('Register');

        $form->add($name);
        $form->add($partnerId);
        $form->add($submit);

        return $form;
    }
}