<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends AppModel {
    protected $table = "schedules";
    protected $guarded = array('group', 'extend_date', 'month', 'sabado', 'domingo', 'weekdays');

    public function place() {
        return $this->BelongsTo('App\Place');
    }
    public function scopeJoinPlace($query) {
        $query->join('places', ['places.id'=>'schedules.place_id']);
    }
    public function getDayDisplayAttribute() {
        return ($this->day != null) ? date('d/m/Y', strtotime($this->day)) : self::getWeekdayName($this->weekday);
    }
    public static function getWeekdayName($value = null){
        switch ($value) {
            case 0:
                return "Domingo";
                break;
            case 1:
                return "Segunda";
                break;
            case 2:
                return "Terça";
                break;
            case 3:
                return "Quarta";
                break;
            case 4:
                return "Quinta";
                break;
            case 5:
                return "Sexta";
                break;
            case 6:
                return "Sábado";
                break;
            default :
                return null;
                break;
        }
    }
}
