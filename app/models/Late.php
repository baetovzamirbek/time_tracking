<?php

class Late extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $user_id;

    /**
     *
     * @var string
     */
    public $date;

    /**
     *
     * @var string
     */
    public $start;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("time");
        $this->setSource("late");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'late';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Late[]|Late|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Late|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public static function getData($users) 
    {        
        $lateArr = [];
        $number = cal_days_in_month(CAL_GREGORIAN, 3, 2020);
        foreach ($users as $user){
            $arr = [];
            $countLate = 0;
            for ($i = 1; $i <= $number; $i++) {
                $time = strtotime('2020/3/'.$i);
                $tracking = Tracking::find([
                    "day = :day: AND user_id = :user_id:",
                    'bind' => ['day' => date("Y-m-d", $time), 'user_id' => $user->id]
                ]);
                $totalTimeDay = Tracking::totalTime($tracking);
                $countLate += $totalTimeDay['check'];
                if($totalTimeDay['check'] ==1) {
                    $date = date('Y:m:d', $time);
                    $db = Tracking::findFirst([
                        "user_id = :user: AND day = :date:",
                        'bind' => ['user' => $user->id, 'date' =>$date ]
                    ]);
                    array_push($arr, ['user_id' => $user->id, 'date'=> $date, 'time' => $db->start_time]);
                }                
            }
            array_push($lateArr, ['late' => $countLate, 'user_id' => $user->id, 'arr'=>$arr]);
        }
        return [
            'totalLateTime' =>$lateArr,
            ];
    }

}
