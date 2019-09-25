<?php
//<iframe src="https://int.llc.org.tw/EquipN/equip.php?no=A01000140&id=10809" frameborder="0" width="100%" height="420px"></iframe>

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use \App\Member;
use \App\MemappTeam;
use \App\MemTeam;
use \App\MemTeamLogin;
use \App\Memapp;

class MemappController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //https://int9.llc.org.tw/memapp/3333/g/888
        $tid = 3333;
        $type = 'g';
        $req_id = 886;
        if ($type == 'n'){//拒絕
            // 暫時先
            $m= "OK";
            $class = "round2";
            return view('Equip.showMsg', compact('m', 'class'));
        }
        /**檢查小組狀態*************************/
        $data = MemTeamLogin::where(['tid'=>$tid, 'granted'=> 'Y'])->get();
        // dd($data[0]->mlid);
        if ($data) $mlid = $data[0]->mlid;
        else dd($data);
        /**確認申請單*************************/
        $memapp = Memapp::where(['tid'=>$tid, 'req_id'=>$req_id, 'mlid'=>$mlid])->get();
        if (!$memapp) dd('dd');
        /**查詢牧區小組資料以供顯示*************************/
        $team = MemappTeam::where(['tid'=>$tid])->get();
        if (!$team) dd('d2d');
        // dd($memapp);
        return view('Memapp.register', compact('tid', 'type', 'req_id', 'team', 'mlid', 'memapp', 'team'));
    }

    public function register($tid, $type, $req_id)
    {
        $m= "OK";
        $class = "round2";
        if ($type == 'n'){//拒絕
            $m= "NQ";
            return view('Equip.showMsg', compact('m', 'class'));
        }

        /**檢查小組狀態*************************/
        $data = MemTeamLogin::where(['tid'=>$tid, 'granted'=> 'Y'])->get();

        if ($data) $mlid = $data[0]->mlid;
        else{
            // dd($data);
            $m= "NS";
            return view('Equip.showMsg', compact('m', 'class'));
        } 
        /**確認申請單*************************/
        $memapp = Memapp::where(['tid'=>$tid, 'req_id'=>$req_id, 'mlid'=>$mlid])->get();
        if (!$memapp){
            $m= "NA";//找不到申請紀錄
            return view('Equip.showMsg', compact('m', 'class'));
        }
        if ($memapp[0]->answer=='Y'){
            $m= "N2";//重複申請
            return view('Equip.showMsg', compact('m', 'class'));
        }
        /**查詢牧區小組資料以供顯示*************************/
        $team = MemappTeam::where(['tid'=>$tid])->get();
        if (!$team){
            $m= "NC";//找不到牧區小組
            return view('Equip.showMsg', compact('m', 'class'));
        };
        // dd($memapp);
        return view('Memapp.register', compact('tid', 'type', 'req_id', 'team', 'mlid', 'memapp', 'team'));
    }

    /*
    因為 view_post_courses 是收費課程，只檢查，但不會有報名的需要
    */
    public function check(Request $request)
    {
        // dd($request);
        $tid = $request->A;
        $mlid = $request->B;
        $req_id = $request->C;
        $class="rounded2";
        $m = 'OK';

        $rules = [
            'reg_name' => 'required|min:2|max:30',
            'reg_email' => 'required|email|max:50',
            'reg_pid' => 'required|size:10',
            'reg_sex' => 'required|size:1',
            'reg_birth' => 'required|min:2|max:10',
            'reg_mobil' => 'required|min:2|max:30',
            'reg_zip' => 'required|min:3|max:6',
            'reg_address' => 'required|min:2|max:100',
            'captcha' => 'required|captcha'
        ];
        
        $messages = [
            'required' => ' :attribute 格式錯誤',
        ];
        
        $attributes = [
            'reg_name' => '姓名',
            'reg_email' => 'email',
            'reg_pid' => '身分證號',
            'reg_sex' => '性別',
            'reg_birth' => '出生日',
            'reg_mobil' => '手機號碼',
            'reg_zip' => '郵遞區號',
            'reg_address' => '地址',
            'captcha' => '驗證碼'
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages, $attributes);

        // dd($validator);
        //----------------------------------------
        if ($validator->fails()) {
            // $type = 'g';
            // return redirect('memapp', compact('tid','type', 'req_id'))->withInput()->withErrors($validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $per_no = $request->reg_pid;
        $per_name = $request->reg_name;
        //=======檢查小組狀態
        $data = MemTeamLogin::where(['mlid'=>$mlid, 'granted'=> 'Y'])->get();
        // dd($data);
        if (!$data){
            $m='SS';//抱歉，權限尚未開啟
            return view('Memapp.showMsg', compact('m', 'class'));
        }
        //=====檢查是否已有該會友(身分證號)資料
        $count = Member::where(['per_no' => $per_no])->count();
        if ($count > 0){
            $m="S2";//會友資料已存在
            return view('Memapp.showMsg', compact('m', 'class'));
        }
        //====目前沒有該會友資料
        $per_equip=$request->reg_equip1.$request->reg_equip2.$request->reg_equip3.$request->reg_equip4;
        $per_equip.=$request->reg_equip61.$request->reg_equip62.$request->reg_equip63.$request->reg_equip64;

        if ($request->jobother){
            $job_class="Z".$request->jobother;
        }else{
            $job_class=$request->jobclass;
        }
        $sch_class=$request->schclass;
		$sch_name=$request->schname;
        
        $mem = new Member;

        $mem->per_no=$per_no;
        $mem->per_name = $per_name;
        $mem->per_sex = $request->reg_sex;
        $mem->per_birth = $request->reg_birth;
        $mem->per_bap_ok = $request->reg_ifbap;
        $mem->per_bapdate_str = $request->reg_bapdate_str;
        $mem->per_mobil = $request->reg_mobil;
        $mem->per_htel = $request->reg_htel;
        $mem->per_off_tel = $request->reg_otel;
        $mem->per_email = $request->reg_email;
        $mem->per_zip = $request->reg_zip;
        $mem->per_address = $request->reg_address;
        $mem->per_equip = $per_equip;
        $mem->job_class = $job_class;
        $mem->sch_class = $sch_class;
        $mem->sch_name = $sch_name;
        // $mem->save();

        // MemTeam::create(['mlid'=>$mlid, 'pid'=>$mem->pid]);
        $m = 'Y';
        $class="rounded";

        //**================****send mail */
        $memapp = Memapp::where(['req_id'=>$req_id])->get();
// dd($memapp[0]->newmem_name);
        //=======信件的內容(即表單填寫的資料)
        $CCmail = 'ruth.yang@breadoflife.taipei';
        //--------------------------------------
        //===寄件者
        $from = ['email'=>'bolcc@green.mailcloud.tw',
        'name'=>'台北靈糧堂 牧養處',
        'subject'=>'台北靈糧堂 「小組組員登錄」確認信'
        ];

        //======填寫收信人信箱
        $email = $memapp[0]->leader_email;
        $to = ['email' => $CCmail,//$email,
        'name'=> '小組長' /*,
        'bcc'=>$CCmail*/];
        $data = ['newmem_name' => $memapp[0]->newmem_name,
            'leader_name' => $memapp[0]->leader_name
        ];
        \Mail::send(['html' => 'emails.notice_mail'], $data,function ($message) use ($from, $to) {
            $message->from($from['email'], $from['name']);
            $message->to($to['email'], $to['name']);//->bcc($to['bcc']);
            $message->subject($from['subject']);
        });
        
        //=======================================
        // $memapp->update(['answer'=>'Y', 'answer_ts'=>Carbon::now()]);
                
        return view('Memapp.showMsg', compact('m', 'class'));

    }
}
