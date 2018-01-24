<?php
/**
 * Created by PhpStorm.
 * User: Wesley
 * Date: 14/08/2017
 * Time: 11:07
 */

namespace User\Form;

use Zend\Form\Element\Password;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class LoginForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('login');

        $this->add([
           'name' => 'email',
           'type' => Text::class,
           'options' => [
               'label' => 'Usuário'
           ]
        ]);

        $this->add([
            'name' => 'password',
            'type' => Password::class,
            'options' => [
                'label' => 'Senha'
            ]

        ]);

        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => [
                'value' => 'Entrar',
                'id' => 'submitbutton'
            ]
        ]);

    }

}