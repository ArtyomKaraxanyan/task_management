<?php

namespace App\Enums;


use App\Models\Priority;
use App\Models\Status;

class TaskDetailsEnum{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function statuses(){

        $status=Status::all();

        return $status;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public static function priorities(){

        $priority=Priority::all();

        return $priority;

    }


}
