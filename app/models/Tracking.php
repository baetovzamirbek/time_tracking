<?php

class Tracking extends \Phalcon\Mvc\Model
{
    public $id;
    public $start_time;
    public $end_time;
    public $user_id;

    public function initialize()
    {
        $this->setSchema("time");
        $this->setSource("tracking");
    }

    public function getSource()
    {
        return 'tracking';
    }

    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
}