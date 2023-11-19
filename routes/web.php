<?php

use App\Http\Controllers\Management\WorkspaceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Management\TaskController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Auth::routes();



Route::group(['middleware' => 'auth'], function () {

 Route::get('/', [App\Http\Controllers\Management\DashboardController::class, 'index'])->name('task_management');

    Route::controller(TaskController::class)->group(function () {
        Route::get('/task/finish/show/{task}', 'taskFinishShow')->name('tasks.finish.show');
        Route::post('/task/finish/{task}', 'taskFinish')->name('tasks.finish');
        Route::post('/task/sort', 'taskSort')->name('tasks.sort');
    });

    Route::controller(WorkspaceController::class)->group(function () {
        Route::put('/workspace/access/{workspace}', 'access')->name('workspaces.access');
        Route::delete('/workspace/access/destroy/{access}', 'accessDestroy')->name('workspaces.destroy_access');
        Route::get('/workspace/border/{workspace}', 'border')->name('workspaces.border');
    });

foreach (\App\Enums\RoutingEnum::routeing() as $key => $value){
    Route::resource(strtolower($key), $value);
}
});

