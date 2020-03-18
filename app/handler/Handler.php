<?php

class Handler
{
   
    public static function totalTime($obj)
    {
        $total = 0;
        $check = 0;
        $test = 0;
        $stopButton = 0;
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
            $time = strtotime('09:05:00');
            $late_time = date('H:i:s', $time);
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

    public function getMonthData($select_month, $id)
    {
        $days = [
            'Sunday', 'Monday', 'Tuesday', 'Wednesday',
            'Thursday', 'Friday', 'Saturday'
        ];
        $month = [];
        $notWorkingDays=0;
        $totalWorkMonth = 0;
        $countLate = 0;
        $number = cal_days_in_month(CAL_GREGORIAN, $select_month, 2020);
        for ($i = 1; $i <= $number; $i++) {
            $time = strtotime('2020/'.$select_month.'/'.$i);
            $day = date("w", $time);
            $weekday =  $days[$day];

            $tracking = Tracking::find([
                "day = :day: AND user_id = :user_id:",
                'bind' => ['day' => date("Y-m-d", $time), 'user_id' => $id]
            ]);

            $totalTimeDay = Tracking::totalTime($tracking);
            $totalWorkMonth = $totalWorkMonth + $totalTimeDay['totalWorkMonth'];
            $countLate += $totalTimeDay['check'];
            $lessTime = Tracking::lessTime($totalTimeDay);
            array_push($month, [
                'weekday'=>$weekday, 'number'=> $i, 'day'=>$day,
                'tracking'=>$tracking, 'totalTimeDay'=>$totalTimeDay,
                'lessTime'=>$lessTime]);
            if($day == 0 || $day == 6){
                $notWorkingDays++;
            }
        }
        $totalWork = Tracking::totalWorkMonthTime($totalWorkMonth);
        return ['month' => $month,
            'totalDays' => $number,
            'notWorkingDays' => $notWorkingDays,
            'totalWorkMonth'=>$totalWork,
            'totalLateTime' =>$countLate,
            ];
    }

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

            foreach ($users as $user){
                $tracking = Tracking::find([
                    "day = :day: AND user_id = :user_id:",
                    'bind' => ['day' => date("Y-m-d", $time), 'user_id' => $user->id]
                ]);
                $totalTimeDay = Tracking::totalTime($tracking);
                $lessTimeDay = Tracking::lessTime($totalTimeDay);
                array_push($dataByUser, ['trackingByUser'=>$tracking,
                                        'totalTimeDay'=>$totalTimeDay,
                                        'lessTimeDay'=>$lessTimeDay,
                                        ]);
            }
            $tracking = Tracking::find([
                "day = :day: AND user_id = :user_id:",
                'bind' => ['day' => date("Y-m-d", $time), 'user_id' => 1]
            ]);          
            array_push($month, [
                'weekday'=>$weekday, 
                'number'=> $i, 
                'day'=>$day,
                'tracking'=>$dataByUser]);
        }
        return ['month' => $month,
            'totalDays' => $number,
            'notWorkingDays' => $notWorkingDays
            ];
    }
}
