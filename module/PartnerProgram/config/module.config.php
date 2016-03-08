<?php
return [
    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'partner_programm_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/PartnerProgram/Entity',
                ],
            ],

            'orm_default' => [
                'drivers' => [
                    'PartnerProgram\Entity' => 'partner_programm_driver'
                ]
            ]
        ]
    ],
    'service_manager' => [
        'initializers' => [
            \PartnerProgram\Service\EntityManagerInitializer::class,
        ],
        'factories' => [
            'formRegister' => \PartnerProgram\Factory\Form\ClientRegister::class,
            'formBalance' => \PartnerProgram\Factory\Form\BalanceOperation::class,
            \PartnerProgram\Service\Partner::class => \PartnerProgram\Factory\Service\PartnerFactory::class,
            \PartnerProgram\Service\PartnerIdStorage::class => \PartnerProgram\Factory\Service\PartnerIdStorageFactory::class,
            \PartnerProgram\Service\Commission::class => \PartnerProgram\Factory\Service\CommissionFactory::class,
            \PartnerProgram\Service\Commission\State\SecondState::class => \PartnerProgram\Factory\Service\Commission\State\SecondStateFactory::class,
            \PartnerProgram\Service\Commission\State\FirstState::class => \PartnerProgram\Factory\Service\Commission\State\FirstStateFactory::class,
            \PartnerProgram\Service\Commission\State::class => \PartnerProgram\Factory\Service\Commission\StateFactory::class,
        ],
        'invokables' => [
            \PartnerProgram\Service\Client::class => \PartnerProgram\Service\Client::class,
            'idGenerator' => \PartnerProgram\IdGenerate\UniqueId::class,
            \Zend\Session\Container::class => \Zend\Session\Container::class,
            \PartnerProgram\Service\Balance\Operation::class => \PartnerProgram\Service\Balance\Operation::class,
            'formulaSecondLevel' => \PartnerProgram\Service\Commission\BaseFormula::class,
            'formulaFirstLevel' => \PartnerProgram\Service\Commission\BaseFormula::class,
            \PartnerProgram\Service\Commission\OperationValidator::class => \PartnerProgram\Service\Commission\OperationValidator::class,
        ],
        'shared' => [
            'formRegister' => false,
            'formBalance' => false,
        ]
    ],
    'controllers' => [
        'factories' => [
            'PartnerProgram\Controller\Client' => \PartnerProgram\Factory\Controller\ClientControllerFactory::class,
            'PartnerProgram\Controller\Balance' => \PartnerProgram\Factory\Controller\BalanceControllerFactory::class,
        ]
    ],
    'router' => [
        'routes' => [
            'client' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/client[/:action]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'PartnerProgram\Controller',
                        'controller' => 'client',
                        'action'        => 'index',
                    ),
                ),
            ),
            'balance' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/balance/:clientId[/:action]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'PartnerProgram\Controller',
                        'controller' => 'Balance',
                        'action'        => 'index',
                    ),
                ),
            ),
        ]
    ],
    'view_manager' => [
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ],
    'view_helpers' => [
        'factories' => [
            'partnerProgram' => \PartnerProgram\Factory\View\PartnerFactory::class,
        ]
    ],
];