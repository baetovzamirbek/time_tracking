<?php

class UserController extends ControllerBase
{

    public function indexAction()
    {
        $this->tag->setDefault('user', '');
        $this->tag->setDefault('password', '');
        $this->tag->setTitle('Sign Up/Sign In');        
    }

    public function logoutAction()
    {
        $this->session->destroy();
        $this->flash->success('Goodbye!');
        return $this->dispatcher->forward(
            [
                "controller" => "user",
                "action"     => "index",
            ]
        );
    }

    public function changeAction()
    {
        $this->tag->setTitle('Change a password');
    }
}

