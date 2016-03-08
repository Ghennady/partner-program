<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 08.03.16
 * Time: 9:21
 */

namespace PartnerProgram\Controller;

use PartnerProgram\Service\Balance\Operation as BalanceOperationService;
use PartnerProgram\Service\Client as ClientService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BalanceController extends AbstractActionController
{
    /**
     * @var BalanceOperationService
     */
    private $balanceOperationService;

    /**
     * @var ClientService
     */
    private $clientService;

    /**
     * @var \Zend\Form\Form
     */
    private $balanceForm;

    /**
     * @return BalanceOperationService
     */
    private function getBalanceOperationService()
    {
        return $this->balanceOperationService;
    }

    /**
     * @param BalanceOperationService $balanceOperationService
     */
    public function setBalanceOperationService(BalanceOperationService $balanceOperationService)
    {
        $this->balanceOperationService = $balanceOperationService;
    }

    public function indexAction()
    {
        $client = $this->getClientService()->find($this->params('clientId'));
        $form = $this->getBalanceForm();

        if ($this->getRequest()->isPost()) {
            $form->setData($this->params()->fromPost());
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getBalanceOperationService()->changeBalance($client, $data['reason'], $data['amount'], 'User operation');

                return $this->redirect()->toRoute('balance', ['clientId' => $client->getId()]);
            }
        }

        return new ViewModel(
            [
                'form' => $form,
                'client' => $client,
                'operations' => $this->getBalanceOperationService()->findByClient($client)
            ]
        );

    }

    /**
     * @return ClientService
     */
    private function getClientService()
    {
        return $this->clientService;
    }

    /**
     * @param ClientService $clientService
     */
    public function setClientService(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * @return \Zend\Form\Form
     */
    private function getBalanceForm()
    {
        return $this->balanceForm;
    }

    /**
     * @param \Zend\Form\Form $balanceForm
     */
    public function setBalanceForm(\Zend\Form\Form $balanceForm)
    {
        $this->balanceForm = $balanceForm;
    }
}