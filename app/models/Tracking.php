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

    public static function totalTime($obj)
    {
        $total = 0;
        $check = 0;
        $test = 0;
        $stopButton = 0;
        $db = StartTime::findFirst();
        $setTime = $db->time;
        date_default_timezone_set('Asia/Bishkek');
        foreach ($obj as $data) {
            if($data->end_time == null){
                $time_diff = strtotime(date('H:i:s', time())) - strtotime($data->start_time);
                $stopButton = 1;
            }
            else {
                $time_diff = strtotime($data->end_time) - strtotime($data->start_time);
            }
            $total = $total + $time_diff;
            $time = strtotime($setTime);
            $late_time = date('H:i', $time);
            if ($data->start_time > $late_time and $check ==0) {
                $check = 1; $test=1;
            } 
            else {
                $test = 0;
            }
        }
        $hour = floor($total/60/60);
        $minute = floor($total/60-$hour*60);
        return ['hour' => $hour, 'minute' => $minute, 'totalWorkMonth' => $total, 'check' => $test, 'stopButton'=>$stopButton];
    }

    public static function totalWorkMonthTime($total)
    {
        $hour = floor($total/60/60);
        $minute = floor($total/60-$hour*60);
        return ['hour' => $hour, 'minute' => $minute, 'totalWorkMonth' => $total];
    }



    public static function lessTime($obj)
    {
        $minuteWork = $obj['hour']*60+$obj['minute'];
        $totalHour = 9;
        $dinnerLength =0;
        $workLength = ($totalHour  - $dinnerLength)*60;
        $less = $workLength - $minuteWork;
        $hour = floor($less/60);
        $minute = floor($less-$hour*60);
        return ['hour' => $hour, 'minute' => $minute];
    }

    //----------------------------------------------------------
    public static function getData($select_month, $users) {
        $month = [];
        $notWorkingDays=0;
        $days = [
            'Sunday', 'Monday', 'Tuesday', 'Wednesday',
            'Thursday', 'Friday', 'Saturday'
        ];        

        $number = cal_days_in_month(CAL_GREGORIAN, $select_month, 2020);
        for ($i = 1; $i <= $number; $i++) {
            $dataByUser = [];
            $time = strtotime('2020/'.$select_month.'/'.$i);
            $day = date("w", $time);
            $weekday =  $days[$day];
            if($day == 0 || $day == 6){
                $notWorkingDays++;
            }
            $j = NotWorkDays::findFirst([
                "date = :day:",
                'bind' => ['day' => date("Y-m-d", $time)]
            ]);
            if($j == true) {
                $j=$i;
            }
            else {
                $j=0;
            }
            foreach ($users as $user){
                $tracking = Tracking::find([
                    "day = :day: AND user_id = :user_id:",
                    'bind' => ['day' => date("Y-m-d", $time), 'user_id' => $user->id]
                ]);
                $stop = 0;
                $id=0;
                $id_edit = 0;
                foreach ($tracking as $arr){
                    if($arr->end_time == null){
                        $stop = 1; 
                        $id = $arr->id;
                    }
                    $id_edit = $arr->id;
                }
                $totalTimeDay = Tracking::totalTime($tracking);
                $lessTimeDay = Tracking::lessTime($totalTimeDay);
                array_push($dataByUser, ['trackingByUser'=>$tracking,
                                        'totalTimeDay'=>$totalTimeDay,
                                        'lessTimeDay'=>$lessTimeDay,
                                        'stopButtonStatus'=>$stop,
                                        'id'=>$id,
                                        'id_edit'=>$id_edit,
                                        'id_user'=>$user->id,
                                        'day'=>date("d"),
                                        ]);
            }
            $tracking = Tracking::find([
                "day = :day: AND user_id = :user_id:",
                'bind' => ['day' => date("Y-m-d", $time), 'user_id' => 1]
            ]);          
            array_push($month, [
                'weekday'=>$weekday, 
                'number'=> $i,
                'notWork'=>$j,
                'day'=>$day,
                'tracking'=>$dataByUser]);
        }
        return ['month' => $month,
            'totalDays' => $number,
            'notWorkingDays' => $notWorkingDays
            ];
    }
}