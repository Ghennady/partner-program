<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 16:20
 */

namespace PartnerProgram\Controller;

use PartnerProgram\Service\PartnerIdStorage;
use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ClientController extends AbstractActionController
{
    /**
     * @var Form
     */
    private $formRegister;

    /**
     * @var \PartnerProgram\Service\Client
     */
    private $clientService;

    /**
     * @var PartnerIdStorage
     */
    private $partnerIdStorage;

    /**
     * @return PartnerIdStorage
     */
    private function getPartnerIdStorage()
    {
        return $this->partnerIdStorage;
    }

    /**
     * @param PartnerIdStorage $partnerIdStorage
     */
    public function setPartnerIdStorage(PartnerIdStorage $partnerIdStorage)
    {
        $this->partnerIdStorage = $partnerIdStorage;
    }

    /**
     * @return \PartnerProgram\Service\Client
     */
    private function getClientService()
    {
        return $this->clientService;
    }

    /**
     * @param \PartnerProgram\Service\Client $clientService
     */
    public function setClientService(\PartnerProgram\Service\Client $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * @return Form
     */
    private function getFormRegister()
    {
        return $this->formRegister;
    }

    /**
     * @param Form $formRegister
     */
    public function setFormRegister(\Zend\Form\Form $formRegister)
    {
        $this->formRegister = $formRegister;
    }

    public function indexAction()
    {
        $form = $this->getFormRegister();
        $clientService = $this->getClientService();
        if ($this->getRequest()->isPost()) {
            $form->setData($this->params()->fromPost());
            if ($form->isValid()) {
                $values = $form->getData();
                $this->getPartnerIdStorage()->setPartnerId($values['partnerId']);
                $clientService->register($values['name']);
                return $this->redirect()->toRoute('client');
            }
        }
        return new ViewModel(
            [
                'form' => $form,
                'clients' => $clientService->getClients(),
            ]
        );
    }
}
