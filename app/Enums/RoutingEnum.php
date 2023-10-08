<?php

namespace App\Enums;







use App\Http\Controllers\Management\TaskController;
use App\Http\Controllers\Management\WorkspaceController;

class RoutingEnum{

    const NAME=['Workspaces','Tasks'];
//    const VALUE=['list'=>'index','create'=>'create'];
    const Clases=[WorkspaceController::class,TaskController::class];

       public static function routeing(){

           return  array_combine(self::NAME, self::Clases);
       }

}
