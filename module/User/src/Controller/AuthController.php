<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{

    /**
     * @var AuthenticationServiceInterface
     */
    private $authService;

    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * @var EntityRepository
     */
    private $repositoryType;

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(AuthenticationServiceInterface $authService, EntityManager $entityManager,
                                EntityRepository $repository, EntityRepository $repositoryType)
    {
        $this->authService = $authService;
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->repositoryType = $repositoryType;
    }

    public function userAction(){

        $users = $this->repository->findAll();
        return new ViewModel(['usuario' => $users]);

    }

}
