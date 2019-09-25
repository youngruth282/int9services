<?php
//<iframe src="https://int.llc.org.tw/EquipN/equip.php?no=A01000140&id=10809" frameborder="0" width="100%" height="420px"></iframe>

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Equip;
use \App\Course;
use \App\MemCheck;
use \App\Regyoyo;
// use Config;

class EquipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tran_no = 'A01000140';
        $tran_id2 = 10809;
        $tran_nid = 0;
        return view('Equip.register', compact('tran_no', 'tran_id2', 'tran_nid'));
    }
    public function register($tran_no, $tran_id2, $tran_nid=0)
    {//跟曉萍確認一下，是否equip.view_post_courses都是付費的，不能由此報名
        $m = 'NC';//'抱歉，找不到此課程!'
        $class="rounded2";
        if ($tran_no and $tran_id2) {
            $today = date('Y-m-d');
            $count = Equip::where(['tran_no' => $tran_no, 'tran_id2'=> $tran_id2])->where('enrollment_end','>=',$today)->count();
            if ($count == 0){//ND 報名期限已過，目前暫不使用
                // dd('抱歉，找不到此課程!');
                return view('Equip.showMsg', compact('m', 'class'));
            } 
        }else{
            // dd('抱歉有誤');
            return view('Equip.showMsg', compact('m', 'class'));
        } 
        return view('Equip.register', compact('tran_no', 'tran_id2', 'tran_nid'));
    }

/*
    public function register($tran_no, $tran_id2, $tran_nid=0)
    {
        $m = 'NC';//'抱歉，找不到此課程!'
        $class="rounded2";
        if ($tran_no and $tran_id2) {
            $count = Equip::where(['tran_no' => $tran_no, 'tran_id2'=> $tran_id2])->count();
            if ($count == 0) {
                if ($tran_nid>0) {
                    $count = Course::where(['tran_no' => $tran_no, 'tran_id2'=> $tran_id2, 'tran_noid'=> $tran_nid])->count();
                } else {
                    $count = Course::where(['tran_no' => $tran_no, 'tran_id2'=> $tran_id2])->count();
                }
                if ($count == 0){
                    // dd('抱歉，找不到此課程!');
                    return view('Equip.showMsg', compact('m', 'class'));
                } 
            }
        }else{
            // dd('抱歉有誤');
            return view('Equip.showMsg', compact('m', 'class'));
        } 
        return view('Equip.register', compact('tran_no', 'tran_id2', 'tran_nid'));
    }
*/
    /*
    因為 view_post_courses 是收費課程，只檢查，但不會有報名的需要
    */
    public function check(Request $request)
    {
        $m = 'OK';
        $class="rounded2";

        $rules = [
            'email' => 'required|email',
            'id4' => 'required|digits:4',
            'captcha' => 'required|captcha'
        ];
        
        $messages = [
            'required' => ' :attribute 錯誤',
        ];
        
        $attributes = [
            'email' => 'email',
            'id4' => '身份證末四碼',
            'captcha' => '驗證碼'
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages, $attributes);

        // $validator = \Validator::make($request->all(), [
        //     'email' => 'required|email',
        //     'id4' => 'required|digits:4',
        //     'captcha' => 'required|captcha'
        // ]);        
        // dd($request);
        //----------------------------------------
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $tran_no = $request->no;
        $tran_id2 = $request->id2;
        $tran_nid = $request->nid;
        $email = $request->email;
        $id4 = $request->id4;
        
        // dd($tran_no);
        if ($tran_no and $tran_id2) {
            $today = date('Y-m-d');
            $equip = Equip::where(['tran_no' => $tran_no, 'tran_id2'=> $tran_id2])->where('enrollment_end','>=',$today)->get();
            // dd($count);
            if (!$equip){//ND 報名期限已過，目前暫不使用
                $m="ND";//dd('抱歉，找不到此課程!');課程已過報名日期
            }
        }else $m="NC";//dd('抱歉有誤');
        if ($m=='OK') {
            $member = MemCheck::where(['per_email' => $email, 'id4' => $id4])->get();
            if (!$member) {
                $member = MemCheck::where(['per_email' => $email])->get();
                if ($member) {
                    $m="NP";//dd('抱歉，找不到該email+id4!');
                }else{
                    $m="NM";//dd('抱歉，找不到該email!');
                }
            }
        }
        if ($m=='OK'){
            $indata = ['y_tran_cid' => $equip[0]->tran_cid, 'y_pid' => $member[0]->pid];
            $rs = Regyoyo::create($indata);
            if ($rs){
                $m = 'Y';
                $class="rounded";
            }
    
        }
        return view('Equip.showMsg', compact('m', 'class'));
    }


}
