<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 08.03.16
 * Time: 9:43
 */

namespace PartnerProgram\Factory\Form;


use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BalanceOperation implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new Form();

        $operationType = new Select(
            'reason',
            [
                'value_options' => [
                    [
                        'value' => \PartnerProgram\Entity\Balance\Reason::WITHDRAWAL,
                        'label' => 'Снятие'
                    ],
                    [
                        'value' => \PartnerProgram\Entity\Balance\Reason::REFILL,
                        'label' => 'Пополнение'
                    ],
                    [
                        'value' => \PartnerProgram\Entity\Balance\Reason::GIFT,
                        'label' => 'Подарок'
                    ],
                ]
            ]
        );
        $amount = new Text('amount', ['label' => 'Сумма']);

        $submit = new Submit('submit');
        $submit->setValue('submit');

        $form->add($amount);
        $form->add($operationType);
        $form->add($submit);

        return $form;
    }

}