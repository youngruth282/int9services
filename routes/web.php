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

Route::get('/', function () {
    return view('welcome');
    // return view('Equip.register2');

});
Route::get('/test', function () {
    // return view('welcome');
    return view('Equip.register2');

});
Route::get('atest','MemappController@index');
Route::get('btest','EquipController@index');


// 裝備課程報名
// https://int9.bolcc.taipei/services/equip/A01000140/10809
// 配合的 model 為 Eq , Regyoyo
// use \App\Equip;
// use \App\EqCourse;
// use \App\EqCheck;
// use \App\Regyoyo;
Route::get('register/{tran_no}/{tran_id2}/{tran_nid?}','EquipController@register');
Route::post('check','EquipController@check')->name('services.check');


// 2019/09/02 組員認證 https://int.llc.org.tw/memapp/index.php?A=".$tid."&B=g&C=".$req_id
// https://int9.bolcc.taipei/services/memapp/3333/g/888 填寫
// https://int9.llc.org.tw/memapp/3333/n/888 不同意
// 配合的 model 為 Mem...
// use \App\Member;
// use \App\MemappTeam;
// use \App\MemTeam;
// use \App\MemTeamLogin;
// use \App\Memapp;

Route::get('memapp/{tid}/{type}/{req_id}','MemappController@register')->name('services.memapp');
// Route::get('memapp','MemappController@index')->name('services.memapp');
Route::post('memsend','MemappController@check')->name('services.memsend');


// ************** 以下本為 MediaCenter 讀取聖經經文、大綱、小組材料、講員照片等  **************
// ************** 後台功能，但預備搬到 int2，與其他系統一致 **************
// 配合的 model 為 MD_ , DB_
// use \App\MD_WActiv;
// use \App\MD_WACont;
// use \App\MD_WABible;
// use \App\DB_CBible;
// use \App\MD_CellDocs;

Route::get('dbible/{bno}/{sch}/{snu}/{ech}/{enu}','DBibleController@show')->name('services.dbible');
// Route::get('sermonct/{Wcode}/{Date}','SermonCTController@show')->name('services.sermonct');
Route::get('sermonct/{WNo}/{Date}','SermonCTController@show')->name('services.sermonct');

Route::get('celldocsList','CellDocsController@show')->name('services.celldocs');
Route::get('upload/{wdate}/{wid}','CellDocsController@upload')->name('services.upload');
Route::post('savefile','CellDocsController@savefile')->name('services.savefile');
Route::get('clearFile/{wdate}/{wid}','CellDocsController@clearFile')->name('services.clearFile');

Route::get('uploWAuthor/{wdate}/{wid}/{wno}','CellDocsController@uploWAuthor')->name('services.uploWAuthor');
Route::post('savePict','CellDocsController@savePict')->name('services.savePict');
Route::get('wauthor','CellDocsController@wauthor')->name('services.wauthor');

// 2019/11/
Route::get('memInvite/{req_id}','MemappController@mailInvite')->name('services.memInvite');
