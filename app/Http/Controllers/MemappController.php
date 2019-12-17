<?php
// 小組長管理 
// 新增組員功能 小組長寄邀請信給組員、接受組員回覆是否接受(同意則填寫)、檢查表格填寫內容、完成後寄確認信通知小組長

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
        $m= "OK";
        $class = "rounded2";
        return view('Equip.showMsg', compact('m', 'class'));

    }

    public function register($tid, $type, $req_id)
    {

        $m= "OK";
        $class = "rounded2";

        /**檢查小組狀態*************************/
        if (MemTeamLogin::where(['tid'=>$tid, 'granted'=> 'Y'])->count() == 1 ){
            $data = MemTeamLogin::where(['tid'=>$tid, 'granted'=> 'Y'])->first();
            $mlid = $data->mlid;
        }else{
            // dd($data);
            $m= "NS";
            return view('Memapp.showMsg', compact('m', 'class'));
        } 
        /**確認申請單*************************/
        if (Memapp::where(['tid'=>$tid, 'req_id'=>$req_id, 'mlid'=>$mlid])->count() != 1 ){
            $m= "NA";//找不到申請紀錄
            return view('Memapp.showMsg', compact('m', 'class'));
        }
        $memapp = Memapp::where(['tid'=>$tid, 'req_id'=>$req_id, 'mlid'=>$mlid])->first();
        if ($memapp->answer=='Y'){
            $m= "N2";//重複申請
            return view('Memapp.showMsg', compact('m', 'class'));
        }
        /**查詢牧區小組資料以供顯示*************************/
        if (MemappTeam::where(['tid'=>$tid])->count() != 1 ){
            $m= "NC";//找不到牧區小組
            return view('Memapp.showMsg', compact('m', 'class'));
        };
        if ($type == 'n'){//拒絕
            Memapp::where(['req_id'=>$req_id])->update(['answer'=>'n', 'answer_ts'=>Carbon::now()]);
            $m= "NQ";
            return view('Memapp.showMsg', compact('m', 'class'));
        }
        $team = MemappTeam::where(['tid'=>$tid])->first();
        // dd($team);
        return view('Memapp.appForm', compact('tid', 'type', 'req_id', 'team', 'mlid', 'memapp', 'team'));
    }

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
        $per_bap_ok=$request->reg_ifbap;
        $per_bapdate_str=$request->reg_bapdate_str;
		if ($per_bap_ok=="Y" and $per_bapdate_str==""){
            return redirect()->back()->withInput()->withErrors(['bapdate' => '請輸入受洗日期']);
        }

        $per_no = $request->reg_pid;
        $per_name = $request->reg_name;
        //=======檢查小組狀態
        if (!(MemTeamLogin::where(['mlid'=>$mlid, 'granted'=> 'Y'])->exists())){// 找不到
            $m='SS';//抱歉，權限尚未開啟
            return view('Memapp.showMsg', compact('m', 'class'));
        }else{
            if (MemTeamLogin::where(['mlid'=>$mlid, 'granted'=> 'Y'])->count() > 1) {
            // 多於一個，有錯誤
            $m='SN';//抱歉，權限尚未開啟
            return view('Memapp.showMsg', compact('m', 'class'));
            }
        }
        //=====檢查是否已有該會友(身分證號)資料
        if (Member::where(['per_no' => $per_no])->count() > 0){
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
        $mem->save();
        $pid = $mem->pid;
        MemTeam::create(['mlid'=>$mlid, 'pid'=>$mem->pid]);
        $m = 'Y';
        $class="rounded";

        //**================****send mail */
        $memapp = Memapp::where(['req_id'=>$req_id])->first();
// dd($memapp[0]->newmem_name);
        //=======信件的內容(即表單填寫的資料)
        // $CCmail = 'ruth.yang@breadoflife.taipei';
        // $CCmail = 'young.ruth@gmail.com';
        //--------------------------------------
        //===寄件者
        $ts = microtime();
        $ts5 = substr($ts, -5);
        $from = ['email'=>'bolcc@green.mailcloud.tw',
        'name'=>'台北靈糧堂 牧養處',
        'subject'=>'台北靈糧堂 「小組組員登錄」確認信'.$ts5
        ];

        //======填寫 小組長 為收信人信箱 
        $email = $memapp->leader_email;
        if (preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) { 
        }else{// email帳號不合理
            $email = "ruth.yang@breadoflife.taipei";
        }// 就不寄通知給小組長
        
        $to = ['email' => $email,
        'name'=> '小組長' /*,
    'bcc'=>$CCmail*/ ];// 此處密件寄送仍未成功

        $data = ['newmem_name' => $memapp->newmem_name,
            'leader_name' => $memapp->leader_name
        ];
        \Mail::send(['html' => 'emails.notice_mail'], $data,function ($message) use ($from, $to) {
            $message->from($from['email'], $from['name']);
            $message->to($to['email'], $to['name']);//->bcc($to['bcc']);
            $message->subject($from['subject']);
        });
        
        //=======================================
        Memapp::where(['req_id'=>$req_id])->update(['answer'=>'Y', 'answer_ts'=>Carbon::now(), 'pid' => $pid]);
                
        return view('Memapp.showMsg', compact('m', 'class'));

    }
    public function mailInvite(Request $request)
    {//https://int.bolcc.tw/mem/user 小組組員 登錄邀請函
        // 取代 https://int2.bolcc.tw/zMailer/memappMailer.php?req_id=915

        $memapp = Memapp::where(['req_id'=>$request->req_id])->firstOrFail();
        $tid=$memapp->tid;
        $newmem_name=$memapp->newmem_name;
        $leader_name=$memapp->leader_name;
        $email=$memapp->newmem_email;

        //===寄件者
        $ts = microtime();
        $ts5 = substr($ts, -5);
        $from = ['email'=>'bolcc@green.mailcloud.tw',
        'name'=>'台北靈糧堂 牧養處',
        'subject'=>'台北靈糧堂 「小組組員登錄」邀請函'.$ts5
        ];

        //======填寫收信人信箱 
        if (preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) { 
        }else{// email帳號不合理
            $email = "ruth.yang@breadoflife.taipei";
        }// 就不寄通知給小組長
        
        $to = ['email' => $email,
        'name'=> '小組組員' /*,
    'bcc'=>$CCmail*/ ];// 此處密件寄送仍未成功
        $ok_url ='https://int9.bolcc.taipei/services/memapp/'.$tid.'/g/'.$request->req_id;
        $notok_url ='https://int9.bolcc.taipei/services/memapp/'.$tid.'/n/'.$request->req_id;

        $data = ['newmem_name' => $newmem_name,
            'leader_name' => $leader_name,
            'ok_url' => $ok_url,
            'notok_url' => $notok_url
        ];
        \Mail::send(['html' => 'emails.invite_mail'], $data,function ($message) use ($from, $to) {
            $message->from($from['email'], $from['name']);
            $message->to($to['email'], $to['name']);//->bcc($to['bcc']);
            $message->subject($from['subject']);
        });
        
                
        return redirect('https://int.bolcc.tw/mem/user');
    }
}
