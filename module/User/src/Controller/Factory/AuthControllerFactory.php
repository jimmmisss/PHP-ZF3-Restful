<?php
/**
 * Created by PhpStorm.
 * User: Wesley
 * Date: 15/08/2017
 * Time: 16:51
 */

namespace User\Controller\Factory;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use User\Controller\AuthController;
use User\Entity\Users;
use User\Entity\UsersTypes;
use Zend\Authentication\AuthenticationServiceInterface;

class AuthControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {

        $authService = $container->get(AuthenticationServiceInterface::class);

        $entityManager = $container->get(EntityManager::class);
        $repository = $entityManager->getRepository(Users::class);
        $repositoryType = $entityManager->getRepository(UsersTypes::class);

        return new AuthController($authService, $entityManager, $repository, $repositoryType);

    }
}