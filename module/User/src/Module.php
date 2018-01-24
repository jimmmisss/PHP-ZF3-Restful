<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User;

use User\Controller\AuthController;
use User\Controller\Factory\UserRestControllerFactory;
use User\Controller\UserRestController;
use User\Controller\Factory\AuthControllerFactory;
use User\Service\Factory\AuthenticationServiceFactory;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements ControllerProviderInterface, ServiceProviderInterface, ConfigProviderInterface
{
    const VERSION = '3.0.3-dev';

    public function onBootstrap(MvcEvent $e){

        $eventManager = $e->getApplication()->getEventManager();
        $container = $e->getApplication()->getServiceManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, function (MvcEvent $e) use ($container) {
            $match = $e->getRouteMatch();
            $authService = $container->get(AuthenticationServiceInterface::class);
            $routeName = $match->getMatchedRouteName();

            if ($authService->hasIdentity()) {
                return;
            } elseif (strpos($routeName, 'admin' !== false)) {
                $match->setParam('controller', AuthController::class)
                    ->setParam('action', 'legalizer-home');
            }
        }, 100);

    }

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'aliases' => [
                AuthenticationService::class => AuthenticationServiceInterface::class
            ],
            'factories' => [
                AuthenticationServiceInterface::class => AuthenticationServiceFactory::class
            ]
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                AuthController::class => AuthControllerFactory::class,
                UserRestController::class => UserRestControllerFactory::class,
            ]
        ];
    }

}
