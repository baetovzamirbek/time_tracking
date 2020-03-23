<?php
use Phalcon\Http\Request;
use app\handler;

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $this->tag->setTitle('Time tracking tool');

        $role = $this->session->get('role');

        $request = new Request();
        if ($this->request->isPost()) {
            $select_month = $request->getPost('select_month');
        } else {
            $select_month = date("m");
        }

        date_default_timezone_set('Asia/Bishkek');
        $todayMonth = MONTHS[intval($select_month)];

        $users = User::find();
        $monthData = $this->handler->getData($select_month, $users);

        $this->view->setVars([
            'months' => MONTHS,
            'username' => $this->session->get('name'),
            'user_id' => $this->session->get('id'),
            'users' => $users,
            'data' => $monthData['month'],
            'totalDays' => $monthData['totalDays'],
            'totalWorkingDays' => $monthData['totalDays'] - $monthData['notWorkingDays'],
            'today' => date("d"),
            'todayMonth' => $todayMonth,
            'numTodayMonth' => date("m"),
            'numSelectMonth' => $select_month,
            'role' => $role,
        ]);
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
        $tracking_data = new Tracking();
        date_default_timezone_set('Asia/Bishkek');
        $tracking_data->start_time = date('H:i:s', time());
        $tracking_data->user_id = $this->request->getPost('id');
        $tracking_data->day = date('Y:m:d', time());
        $tracking_data->save();
        exit(json_encode($tracking_data));
    }
}