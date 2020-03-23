<?php
use Phalcon\Http\Request;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->tag->setTitle('Time tracking tool');
        $name = $this->session->get('name');
        $id = $this->session->get('id');
        $role = $this->session->get('role');

        if($role == 1) {
            $role = 'partials/user';
        }
        else {
            $role = 'partials/guest';
        }
        if($role == 2) {
            return $this->dispatcher->forward(
                     [
                         "controller" => "admin",
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

        $this->view->username = $name;
        $this->view->user_id = $id;
        $this->view->users = $users;
        $this->view->data = $monthData['month'];
        $this->view->totalDays = $monthData['totalDays'];
        $this->view->totalWorkingDays = $monthData['totalDays'] - $monthData['notWorkingDays'];
        $this->view->today = $today;
        $this->view->todayMonth = $todayMonth;
        $this->view->numTodayMonth = date("m");
        $this->view->numSelectMonth = $select_month;
        $this->view->role = $role;
    }

    public function stopAction()
    {
        $this->view->disable();
        $id = $this->request->getPost('id');
        $tracking = Tracking::findFirst([
            "id = :id:",
            'bind' => ['id' => $id]
        ]);
        date_default_timezone_set('Asia/Bishkek');
        $tracking->end_time = date('H:i:s', time());
        $tracking->save();
        exit(json_encode($tracking->end_time));
    }

    public function startAction()
    {
        $id = $this->request->getPost('id');
        $tracking_data = new Tracking();
        date_default_timezone_set('Asia/Bishkek');
        $tracking_data->start_time = date('H:i:s', time());
        $tracking_data->user_id = $id;
        $tracking_data->day = date('Y:m:d', time());
        $tracking_data->save();
        exit(json_encode($tracking_data));
    }
}