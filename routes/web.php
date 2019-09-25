<?php
//https://int9.bolcc.taipei/services/equip/A01000140/10809

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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('equip','EquipController@index')->name('services.index');

Route::get('register/{tran_no}/{tran_id2}/{tran_nid?}','EquipController@register');

Route::post('equip','EquipController@check')->name('services.check');

// Route::post('check','EquipController@store')->name('services.check');

// Route::get('ajax_regen_captcha', function(){
//     return captcha_src();
// });

// 2019/09/02 組員認證 https://int.llc.org.tw/memapp/index.php?A=".$tid."&B=g&C=".$req_id
// https://int9.llc.org.tw/memapp/3333/g/888
Route::get('memapp/{tid}/{type}/{req_id}','MemappController@register')->name('services.memapp');
// Route::get('memapp','MemappController@index')->name('services.memapp');
Route::post('memsend','MemappController@check')->name('services.memsend');


// Route::post('register2','EquipController@register2')->name('register2');
// Route::get('register2','EquipController@register2')->name('services.register2');
// Route::post('equip2','EquipController@check2')->name('services.check2');

Route::get('dbible/{bno}/{sch}/{snu}/{ech}/{enu}','DBibleController@show')->name('services.dbible');
// Route::get('sermonct/{Wcode}/{Date}','SermonCTController@show')->name('services.sermonct');
Route::get('sermonct/{WNo}/{Date}','SermonCTController@show')->name('services.sermonct');
