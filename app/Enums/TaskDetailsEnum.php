<?php

namespace App\Enums;


use App\Models\Priority;
use App\Models\Status;

class TaskDetailsEnum{

    public static function statuses(){

        $status=Status::all();

        return $status;
    }


    public static function priorities(){

        $priority=Priority::all();

        return $priority;

    }


}