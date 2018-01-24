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
use User\Controller\UserRestController;
use User\Entity\Users;
use User\Entity\UsersTypes;

class UserRestControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {

        $entityManager = $container->get(EntityManager::class);
        $users = $entityManager->getRepository(Users::class);
        $repositoryType = $entityManager->getRepository(UsersTypes::class);

        return new UserRestController($entityManager, $users, $repositoryType);

    }
}