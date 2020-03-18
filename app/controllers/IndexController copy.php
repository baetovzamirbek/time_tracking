<?php
use Phalcon\Http\Request;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->tag->setTitle('Time tracking tool');

        $name = $this->session->get('name');
        $id = $this->session->get('id');
        if(!$name) {
            return $this->dispatcher->forward(
                [
                    "controller" => "user",
                    "action"     => "index",
                ]
            );
        }

        $request = new Request();
        if($this->request->isPost()) {
            $select_month = $request->getPost('select_month');
        }
        else {
            $select_month = date("m");
        }

        date_default_timezone_set('Asia/Bishkek');
        $today = date("d");
        $months = [
            'December', 'January', 'February', 'March', 'April',
            'May', 'June', 'July', 'August', 'September','October', 'November'
        ];
        $todayMonth = $months[ intval($select_month)];

        $this->view->today = $today;
        $this->view->todayMonth = $todayMonth;
        $this->view->numTodayMonth = date("m");
        $this->view->numSelectMonth = $select_month;

        //$monthData = $this->handler->getMonthData($select_month, $id);
        $monthData = Tracking::getMonthData($select_month, $id);
        $this->view->data = $monthData['month'];
        $this->view->totalDays = $monthData['totalDays'];
        $this->view->totalWorkingDays = $monthData['totalDays'] - $monthData['notWorkingDays'];
        $this->view->monthTotalTime = $monthData['totalWorkMonth'];
        $this->view->countLateTime = $monthData['totalLateTime'];
    }

    public function startAction()
    {
        $this->view->disable();
        $id = $this->session->get('id');
        date_default_timezone_set('Asia/Bishkek');
        $tracking = new Tracking();
        $tracking->day = date("Y-m-d");
        $tracking->start_time = date('H:i:s', time());
        $tracking->user_id = $id;
        $tracking->save();
        exit(json_encode($tracking->start_time));
    }

    public function stopAction()
    {
        $this->view->disable();
        $id =$_POST['id'];        
        $tracking = Tracking::findFirst([
            "id = :id:",
            'bind' => ['id' => $id]
        ]);
        date_default_timezone_set('Asia/Bishkek');
        $tracking->end_time = date('H:i:s', time());
        $tracking->save();
        exit(json_encode($tracking->end_time));
    }
}