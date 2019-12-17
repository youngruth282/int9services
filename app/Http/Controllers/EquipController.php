<?php
// 官網裝備課程報名，轉址至此
//<iframe src="https://int.llc.org.tw/EquipN/equip.php?no=A01000110&id=10811" frameborder="0" width="100%" height="420px"></iframe>

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Equip;
use \App\EqCourse;
use \App\EqCheck;
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
    {// 測試
        // dd("OK");
        // return view('Equip.register2');
        $tran_no = 'A10000500';
        $tran_id2 = 10812;
        $tran_nid = 0;
        if ($tran_no and $tran_id2){
            $today = date('Y-m-d');
            if (Equip::where(['tran_no' => $tran_no, 'tran_id2'=> $tran_id2])->where('enrollment_end','>=',$today)->count() != 1){
                if ($tran_nid){
                    if (EqCourse::where(['tran_no' => $tran_no, 'tran_id2'=> $tran_id2, 'tran_noid'=> $tran_nid])->where('enrollment_end', '>=', $today)->count() != 1) {
                        $m="ND";//dd('抱歉，找不到此課程!');課程已過報名日期
                    }else{
                        $tran_cid = $tran_nid;
                    }

                }else{
                    if (EqCourse::where(['tran_no' => $tran_no, 'tran_id2'=> $tran_id2])->where('enrollment_end','>=',$today)->count() != 1){
                        $m="ND";//dd('抱歉，找不到此課程!');課程已過報名日期
                    }else{
                        $equip = EqCourse::where(['tran_no' => $tran_no, 'tran_id2'=> $tran_id2])->where('enrollment_end','>=',$today)->first();
                        $tran_cid = $equip->tran_cid;
                    }
                }
                
            }else{
                $equip = Equip::where(['tran_no' => $tran_no, 'tran_id2'=> $tran_id2])->where('enrollment_end','>=',$today)->first();
                $tran_cid = $equip->tran_cid;
            }
        }else $m="NC";

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
    因為 view_post_courses 是收費課程，只檢查，但不會有報名的需要
    */
    public function check(Request $request)
    {
        $m = 'OK';//一開始、繼續的 flag
        $class="rounded2";

        $rules = [
            'captcha' => 'required|captcha'
        ];
        
        $messages = [
            'required' => ' :attribute 錯誤',
            'captcha' => ' :attribute 錯誤'
        ];
        
        $attributes = [
            'captcha' => '驗證碼'
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            $m = 'ER';
            return view('Equip.showMsg', compact('m', 'class'));
        }
        $tran_no = $request->no;
        $tran_id2 = $request->id2;
        $tran_nid = $request->nid;
        $email = $request->email;
        $id4 = $request->id4;
        $tran_cid = 0;

        if ($tran_no and $tran_id2){
            $today = date('Y-m-d');
            if (Equip::where(['tran_no' => $tran_no, 'tran_id2'=> $tran_id2])->where('enrollment_end','>=',$today)->count() != 1){
                if ($tran_nid){
                    if (EqCourse::where(['tran_no' => $tran_no, 'tran_id2'=> $tran_id2, 'tran_noid'=> $tran_nid])->where('enrollment_end', '>=', $today)->count() != 1) {
                        $m="ND";//dd('抱歉，找不到此課程!');課程已過報名日期
                    }else{
                        $tran_cid = $tran_nid;
                    }

                }else{
                    if (EqCourse::where(['tran_no' => $tran_no, 'tran_id2'=> $tran_id2])->where('enrollment_end','>=',$today)->count() != 1){
                        $m="ND";//dd('抱歉，找不到此課程!');課程已過報名日期
                    }else{
                        $equip = EqCourse::where(['tran_no' => $tran_no, 'tran_id2'=> $tran_id2])->where('enrollment_end','>=',$today)->first();
                        $tran_cid = $equip->tran_cid;
                    }
                }
                
            }else{
                $equip = Equip::where(['tran_no' => $tran_no, 'tran_id2'=> $tran_id2])->where('enrollment_end','>=',$today)->first();
                $tran_cid = $equip->tran_cid;
            }
        }else $m="NC";
        // dd($tran_no);
        if ($m=='OK') {
            if (EqCheck::where(['per_email' => $email, 'id4' => $id4])->count() != 1){// 找不到該email+id4 或多個 有問題
                if (!(EqCheck::where(['per_email' => $email])->exists())){
                    $m="NP";//dd('抱歉，找不到該email!');
                }else{
                    $m="NM";//dd('抱歉，找不到該email!+id4');
                }
            }
        }
        // dd($tran_no);
        if ($m=='OK'){
            $member = EqCheck::where(['per_email' => $email, 'id4' => $id4])->first();
            $indata = ['y_tran_cid' => $tran_cid, 'y_pid' => $member->pid];
            $rs = Regyoyo::create($indata);
            if ($rs){
                $m = 'Y';
                $class="rounded";
            }
    
        }
        // dd($tran_no);
        return view('Equip.showMsg', compact('m', 'class'));
    }


}
