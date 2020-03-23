<?php

use Phalcon\Http\Request;

class AdminController extends ControllerBase
{
    public function indexAction()
    {
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

        if ((StartTime::find())) {
            $dbTime = new StartTime();
        }
        else {
            $dbTime = StartTime::find();
        }

        $dbTime->id =1;
        $dbTime->time = $this->request->getPost('settime');
        $dbTime->save();

        $monthData = $this->handler->getLateData($users);
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
        $user_data = User::findFirst([
            "id = :id:",
            'bind' => ['id' => $id]
        ]);
        $user_data->status = $this->request->getPost('active');
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
        $notWork_data = NotWorkDays::findFirst([
            "id = :id:",
            'bind' => ['id' => $id]
        ]);
        $notWork_data->every_year = $this->request->getPost('active');
        $notWork_data->save();
        exit(json_encode($notWork_data));
    }

    public function addNotWorkAction()
    {
        $notWork_data = new NotWorkDays();
        $notWork_data->date = $this->request->getPost('date');
        $notWork_data->every_year = $this->request->getPost('active');
        $notWork_data->save();
        exit(json_encode($notWork_data));
    }

    public function updateTimeAction()
    {
        $id = $this->request->getPost('id');
        $time_data = Tracking::findFirst([
            "id = :id:",
            'bind' => ['id' => $id]
        ]);
        $time_data->start_time = $this->request->getPost('time');
        $time_data->save();
        exit(json_encode($time_data));
    }
}