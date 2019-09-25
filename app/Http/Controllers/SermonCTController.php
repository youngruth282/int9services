<?php
//主日信息大綱http://www.llc.org.tw/mediaCenter/ContentTxt.php?WNo=6&WDate=2019/09/15
// http://www.llc.org.tw/mediaCenter/Details.php?W=W2&D=2019/09/08

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\MD_WActiv;
use \App\MD_WACont;
use \App\MD_WABible;
use \App\DB_CBible;

class SermonCTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($WNo,$Date)
    {
		$wactiv = MD_WActiv::where(['wno' => $WNo, 'wdate' => $Date])->first();
		// dd($wactiv);
		$wacont = MD_WACont::where(['wno' => $WNo, 'wdate' => $Date])->first();
		$wabibles = MD_WABible::where(['wno' => $WNo, 'wdate' => $Date])->get();
		// dd($wabibles);
		$BString1="";
		$bible_label=[];
		$bible_content=[];
		$i=0;
        foreach ($wabibles as $wabible) {
			$ctexts = DB_CBible::SrchBible($wabible->bibleno, $wabible->schapter, $wabible->snumber, $wabible->echapter, $wabible->enumber)->get();
			$BString1 .= '<font color="#FF8040"><b>'.$ctexts[0]->BibleCode->cname;
            if ($wabible->schapter == $wabible->echapter) {
                $BString1 .= $wabible->schapter .'章'. $wabible->snumber .'~'.$wabible->enumber.'節 </b></font>';
            }else{
                $BString1 .= $wabible->schapter .'章'. $wabible->snumber .'~'.$wabible->schapter .'章 '. $wabible->enumber.'節 </b></font>';
			}
			foreach($ctexts as $ctext){
				$bible_content[$i] = '<td><font color="#FF8040"><b>'. $ctext->chapter .' : '. $ctext->number .'</b></font></td>';
				$bible_content[$i] .= '<td><font color="#EEE">'. nl2br($ctext->ctext) .'</font></td>';
				$i++;
			}
			$bible_content[$i] = "<td colspan=2><hr></td>";
			$i++;
        }
		// dd($wabible);
		return view('mediaCenter.sermonCTxt', compact('wactiv', 'wacont', 'ctexts', 'wabible', 'BString1', 'bible_content', 'i'));
    }

}
