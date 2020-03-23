<?php

use Phalcon\Http\Request;

class AdminController extends ControllerBase
{

    public function indexAction()
    {
        $this->tag->setTitle('Admin panel');

        $name = $this->session->get('name');
        $id = $this->session->get('id');
        if (!$name) {
            return $this->dispatcher->forward(
                [
                    "controller" => "user",
                    "action" => "index",
                ]
            );
        }
        $request = new Request();
        if ($this->request->isPost()) {
            $select_month = $request->getPost('select_month');
        } else {
            $select_month = date("m");
        }
        

        date_default_timezone_set('Asia/Bishkek');
        $today = date("d");
        $months = [
            'December', 'January', 'February', 'March', 'April',
            'May', 'June', 'July', 'August', 'September', 'October', 'November'
        ];
        $todayMonth = $months[intval($select_month)];

        $users = User::find();

        $monthData = Tracking::getData($select_month, $users);

        $this->view->users = $users;
        $this->view->data = $monthData['month'];
        $this->view->totalDays = $monthData['totalDays'];
        $this->view->totalWorkingDays = $monthData['totalDays'] - $monthData['notWorkingDays'];
        $this->view->today = $today;
        $this->view->todayMonth = $todayMonth;
        $this->view->numTodayMonth = date("m");
        $this->view->numSelectMonth = $select_month;
    }


    public function lateAction()
    {
        $this->tag->setTitle('Страница опозданий');

        $arr = [];
        $users = User::find();
        $number = cal_days_in_month(CAL_GREGORIAN, 3, 2020);
        for ($i = 1; $i <= $number; $i++) {
            $lateArr = [];
            foreach ($users as $user) {
                $date = strtotime('2020/'.'3'.'/'.$i);
                $date = date("Y-m-d", $date);
                $lateDb = Late::find([
                    "user_id = :user: AND date = :date:",
                    'bind' => ['user' => $user->id, 'date' =>$date ]
                ]);
                array_push($lateArr, ['lateDb'=>$lateDb]);
            }            
            array_push($arr, ['i'=>$i, 'lateArr'=>$lateArr]);
        }
        $this->view->dates = $arr;
        $this->view->startTime = StartTime::findFirst()->time;
        $this->view->users = $users;
    }


    public function changelateAction()
    {
        $users = User::find();
        $setTime = $this->request->getPost('settime');
        
        if ((StartTime::find())) {
            $dbTime = new StartTime();           
        }
        else {
            $dbTime = StartTime::find(); 
        }

        $dbTime->id =1;
        $dbTime->time = $setTime;
        $dbTime->save();

        $monthData = Late::getData($users);
        $late_data = Late::find();
        $late_data->delete();
        foreach ($monthData['totalLateTime'] as $object) {
            foreach ($object['arr'] as $obj) {
                $late_data = new Late();
                $late_data->user_id = $obj['user_id'];
                $late_data->date = $obj['date'];
                $late_data->time = $obj['time'];
                $late_data->save();
            }
        }
        exit(json_encode($monthData['totalLateTime']));
    }


    public function deleteLateAction()
    {
        $id = $this->request->getPost('id');
        $late_data = Late::findFirst([
            "id = :id:",
            'bind' => ['id' => $id]
        ]);              
        $late_data->delete();
        exit(json_encode('1'));
    }


    public function newuserAction()
    {
        $this->tag->setTitle('Страница нового пользователя');
    }


    public function addToDbAction()
    {
        if ($this->request->isPost()) {
            $user_data = new User();
            $user_data->login = $this->request->getPost('login');
            $user_data->name = $this->request->getPost('name');
            $user_data->email = $this->request->getPost('email');
            $user_data->password = sha1($this->request->getPost('password'));
            $user_data->role = 1;
            $user_data->status = 1;
            $user_data->save();

            $this->flash->success('New user saved');
            return $this->dispatcher->forward(
                [
                    "controller" => "admin",
                    "action" => "newuser",
                ]
            );
        }
    }


    public function deleteuserAction()
    {
        $this->tag->setTitle('Удаление пользователя');
        $users = User::find();
        $this->view->users = $users;
    }


    public function changeStatusAction()
    {
        $id = $this->request->getPost('id');
        $active = $this->request->getPost('active');
        $user_data = User::findFirst([
            "id = :id:",
            'bind' => ['id' => $id]
        ]);
        $user_data->status = $active;
        $user_data->save();
        exit(json_encode($user_data));
    }


    public function notWorkDaysAction()
    {
        $notWork_data = NotWorkDays::find();
        $this->view->notWork = $notWork_data;
    }


    public function deleteNotWorkAction()
    {
        $id = $this->request->getPost('id');
        $notWork_data = NotWorkDays::findFirst([
            "id = :id:",
            'bind' => ['id' => $id]
        ]);
        $notWork_data->delete();
        exit(json_encode($notWork_data));
    }


    public function repeatNotWorkAction()
    {
        $id = $this->request->getPost('id');
        $active = $_POST['active'];
        $notWork_data = NotWorkDays::findFirst([
            "id = :id:",
            'bind' => ['id' => $id]
        ]);
        $notWork_data->every_year = $active;
        $notWork_data->save();
        exit(json_encode());
    }

    public function addNotWorkAction()
    {
        $date = $this->request->getPost('date');
        $active = $this->request->getPost('active');
        $notWork_data = new NotWorkDays();
        $notWork_data->date = $date;
        $notWork_data->every_year = $active;
        $notWork_data->save();
        exit(json_encode($active ));
    }

    public function updateTimeAction()
    {
        $id = $this->request->getPost('id');
        $time = $this->request->getPost('time');
        $time_data = Tracking::findFirst([
            "id = :id:",
            'bind' => ['id' => $id]
        ]);
        $time_data->start_time = $time;
        $time_data->save();
        exit(json_encode($time_data));
    }
}

