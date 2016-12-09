<?php
/**
* @author PHP Bonus Framework
*/
namespace Source\Modules;

class Schedules extends AppController {
    function add($day = null, $group = null){
        if($this->request("post")){
            $schedule = new model\Schedule();
            $schedule->fill($_POST['schedule']);
            echo "<pre>";
            var_dump($schedule);
            return false;

            if($schedule->save()){
				return $this->redirect();
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
}
