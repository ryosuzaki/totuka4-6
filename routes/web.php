<?php

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
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//
Route::resource('group', 'Group\GroupController',['except' => [
    'index',
]]);
//
Route::resource('group_info_base','Group\GroupInfoBaseController',['except' => [
]]);
//info_idが決まればgroupが一意
Route::resource('group.info_base.group_info', 'Group\GroupInfoController',['except' => [
    'index',
]])->shallow();

//role_idが決まればgroupが一意
Route::resource('group.group_role', 'Group\GroupRoleController',['except' => [
    
]])->shallow();



//
Route::resource('user','UserController',['except' => [
    'index','create', 'store', 
]]);

Route::resource('user_info_base','UserInfoBaseController',['except' => [
]]);

Route::resource('user.info_base.user_info','UserInfoController',['except' => [
    'index',
]])->shallow();



//
Route::resource('question','Questionnaire\QuestionController',['except' => [
]]);

Route::resource('user.question.answer','Questionnaire\AnswerController',['except' => [
]])->shallow();


    

