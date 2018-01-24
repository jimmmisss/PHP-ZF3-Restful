<?php
/**
 * Created by PhpStorm.
 * User: Wesley
 * Date: 14/08/2017
 * Time: 08:25
 */

namespace User\Service\Factory;

use Interop\Container\ContainerInterface;

class AuthenticationServiceFactory {

    public function __invoke(ContainerInterface $container)
    {
        // TODO: Implement __invoke() method.
        return $container->get('doctrine.authenticationservice.orm_default');
    }

}