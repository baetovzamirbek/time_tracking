<?php

use Phalcon\Http\Request;

class AdminController extends ControllerBase
{

    public function indexAction()
    {
        $this->tag->setTitle('Admin panel');

        $name = $this->session->get('name');
        $id = $this->session->get('id');
        //print_die($name);
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
        $db = StartTime::findFirst();        
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
        $this->view->startTime = $db->time;
        $this->view->users = $users;
    }


    public function changelateAction()
    {
        $users = User::find();
        $setTime =$_POST['settime']; 

        
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
        $db = Late::find();              
        $db->delete();
        foreach ($monthData['totalLateTime'] as $object) {
            foreach ($object['arr'] as $obj) {
                $db = new Late();          
                $db->user_id = $obj['user_id'];
                $db->date = $obj['date'];
                $db->time = $obj['time'];
                $db->save();
            }
        }
        exit(json_encode($monthData['totalLateTime']));
    }


    public function deleteLateAction()
    {
        $id = $_POST['id']; 
        $db = Late::findFirst([
            "id = :id:",
            'bind' => ['id' => $id]
        ]);              
        $db->delete();
        exit(json_encode('1'));
    }


    public function newuserAction()
    {
        $this->tag->setTitle('Страница нового пользователя');
    }


    public function addToDbAction()
    {
        if ($this->request->isPost()) {
            $db = new User();             
            $db->login = $this->request->getPost('login');
            $db->name = $this->request->getPost('name');
            $db->email = $this->request->getPost('email');
            $db->password = sha1($this->request->getPost('password'));
            $db->role = 1;
            $db->status = 1;
            $db->save();

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
        $id = $_POST['id']; 
        $active = $_POST['active'];
        $db = User::findFirst([
            "id = :id:",
            'bind' => ['id' => $id]
        ]);
        $db->status = $active;
        $db->save();
        exit(json_encode($db));
    }


    public function notWorkDaysAction()
    {
        $notWork = NotWorkDays::find();
        $this->view->notWork = $notWork;
    }


    public function deleteNotWorkAction()
    {
        $id = $_POST['id'];
        $db = NotWorkDays::findFirst([
            "id = :id:",
            'bind' => ['id' => $id]
        ]);              
        $db->delete();
        exit(json_encode($id));
    }


    public function repeatNotWorkAction()
    {
        $id = $_POST['id']; 
        $active = $_POST['active'];
        $db = NotWorkDays::findFirst([
            "id = :id:",
            'bind' => ['id' => $id]
        ]);
        $db->every_year = $active;
        $db->save();
        exit(json_encode());
    }

    public function addNotWorkAction()
    {
        $date = $_POST['date'];
        $active = $_POST['active'];
        $db = new NotWorkDays();       
        $db->date = $date;
        $db->every_year = $active;
        $db->save();
        exit(json_encode($active ));
    }

    public function updateTimeAction()
    {
        $id = $_POST['id'];
        $time = $_POST['time'];
        $db = Tracking::findFirst([
            "id = :id:",
            'bind' => ['id' => $id]
        ]);
        $db->start_time = $time;
        $db->save();
        exit(json_encode($db));
    }

    
}

