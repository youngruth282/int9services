<?php
// 主日信息經文 http://www.llc.org.tw/DBible/BibleTxt.php?BNo=44&Sch=19&Snu=1&Ech=22&Enu=30
// https://int9.bolcc.taipei/services/dbible/42/9/12/9/17

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\DB_CBible;

class DBibleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($bno,$sch,$snu, $ech,$enu)
    {
		$ctexts = DB_CBible::SrchBible($bno,$sch,$snu, $ech,$enu)->get();
		// $bibleno = $ctexts[0]->BibleCode();
		// dd($ctexts);
		return view('mediaCenter.bibletxt', compact('ctexts'));
        /*$dbnameBK="pgDBS";

        	$sql_str = "select A.CName,B.Chapter,B.number,B.CText";
	$sql_str.= " from BibleCode A,CBible B";
	$sql_str.= " where A.BibleNo=B.BibleNo and B.BibleNo='$BNo'";
	if ($Sch == $Ech) {
		$sql_str.= " and B.Chapter=$Sch and B.Number between $Snu and $Enu";
	} elseif ($Ech-$Sch == 1) {
		$sql_str.= " and ((B.Chapter=$Sch and B.Number>=$Snu";
		$sql_str.= ") or (B.Chapter=$Ech and B.Number<=$Enu))";
	} else {
		$sql_str.= " and ((B.Chapter=$Sch and B.Number>=$Snu";
		$sql_str.= ") or (B.Chapter=$Ech and B.Number<=$Enu)";
		$sql_str.= " or B.Chapter between ".($Sch+1)." and ".($Ech-1).")";
	}
	$sql_str.= " order by B.Chapter,B.Number";

	$rs=select_sql($sql_str,$dbnameBK);
*/
    }

}
