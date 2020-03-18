<?php


class ErrorsController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Oops!');
        parent::initialize();
    }

    public function show404Action()
    {
        print_die("1");
    }

    public function show401Action()
    {

    }

    public function show500Action()
    {

    }
}
