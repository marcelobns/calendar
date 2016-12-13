<?php
/**
* @author PHP Bonus Framework
*/
namespace Source\Modules;

class Schedules extends AppController {
    function add($day = null, $group = null){
        if($this->request("post")){
            $schedule = $_POST['schedule'];

            if(!empty($schedule['extend_date'])){
                $dayStart = date_create($schedule['day']);
                $dayEnd = date_create($schedule['extend_date']);
                $interval = date_diff($dayStart, $dayEnd)->format('%a');
                $dayAdd = $dayStart;
                for($i=0; $i <= $interval; $i++) {
                    $save = true;
                    $dayString = date_format($dayAdd, 'Y-m-d');
                    if(date('N', strtotime($dayString)) == 6 && !$_POST['schedule']['sabado']){
                        $save = false;
                    }
                    if(date('N', strtotime($dayString)) == 7 && !$_POST['schedule']['domingo']){
                        $save = false;
                    }
                    if($save){
                        $schedule = new model\Schedule();
                        $schedule->fill($_POST['schedule']);
                        $schedule->day = date_format($dayAdd, 'Y-m-d');
                        $schedule->save();
                    }
                    date_add($dayAdd, date_interval_create_from_date_string("1 days"));
                }
                return $this->redirect();
            } else {
                $schedule = new model\Schedule();
                $schedule->fill($_POST['schedule']);

                if($schedule->save()){
    				return $this->redirect();
    			}
            }
		}
        $this->view->data['places'] = model\Place::where("group_id", $group)->orderBy("name")->get();
        $this->view->data['schedule']['day'] = $day;
        $this->view->data['schedule']['group'] = $group;
        $this->render('schedules/add', 'none');
    }
    function edit($id) {
        $this->view->data['schedule'] = model\Schedule::where("id", $id)->first();
        $this->render('schedules/edit', 'none');
    }
    function delete(){
        if($this->request("post") && isset($_POST['schedule']['id'])){
            if(model\Schedule::where('id', $_POST['schedule']['id'])->delete()){
                return $this->redirect();
            }
        }
    }
    function check($place_id, $dayStart, $dayEnd, $hourStart, $hourEnd){
        $result = model\Schedule::whereRaw("place_id = $place_id and day between '$dayStart' and '$dayEnd' AND (	('$hourStart' between hour_start and hour_end) OR ('$hourEnd' between hour_start and hour_end) OR (hour_start between '$hourStart' and '$hourEnd') OR (hour_end between '$hourStart' and '$hourEnd'))")->get();
        header('Content-type: application/json');
        echo json_encode($result);
    }
}
