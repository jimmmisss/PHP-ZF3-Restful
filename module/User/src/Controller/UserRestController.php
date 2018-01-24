<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use User\Service\ProcessJson;
use Zend\Hydrator\ClassMethods;
use Zend\Mvc\Controller\AbstractRestfulController;

class UserRestController extends AbstractRestfulController {

    /**
     * @var EntityRepository
     */
    private $users;

    /**
     * @var EntityRepository
     */
    private $repositoryType;

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager,
                                EntityRepository $users, EntityRepository $repositoryType)
    {
        $this->entityManager = $entityManager;
        $this->users = $users;
        $this->repositoryType = $repositoryType;
    }

    // LISTA TODOS OS USUÁRIOS
    public function getList(){

        $data = $this->users->findAll();

        $response = new ProcessJson([
            "users"
        ], $data);

        return $response->process();
    }

    // LISTA APENAS UM USUÁRIO
    public function get($id){

        $data = $this->users->find($id);

        $response = new ProcessJson([
            "users"
        ], $data);

        return $response->process();

    }

    public function create($data){

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header("Content-Type: application-json; charset=utf-8");

        $data = file_get_contents('php://input');

        if (isset($data)) {
            $this->entityManager->persist($data);
            $this->entityManager->flush();
        }

    }

}