<?php
// 小組材料 本要轉址至此，但目前與後台功能一起放在 int2
// https://int9.bolcc.taipei/services/dbible/42/9/12/9/17
// ***************** $php artisan storage:link *********************

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\MD_CellDocs;
use \App\MD_WActiv;
use Illuminate\Support\Facades\Storage;//for storage::delete()

class CellDocsController extends Controller
{
	protected $wauthor_path = 'public/celldoc';
	protected $celldocs_path = 'public/celldocs';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
		// B.WCode ='W2' and date_part('year',age('now',A.WDate)) =0 and date_part('month',age('now',A.WDate))
		// $cdocs = MD_CellDocs::leftJoin('WActivity', 'WActivity.wno','watype.wno')
		// ->selectRaw('distinct WActivity.WNo,WActivity.WDate,WActivity.WTitle,WActivity.WAuther,watype.WName,watype.WCode')
		// ->where("watype.WCode ='W2' and date_part('year',age('now',WActivity.WDate)) =0 and date_part('month',age('now',WActivity.WDate)) between 0 and 3")->orderBy('WActivity.WDate', 'desc')->get();
		$cdocs = MD_CellDocs::All();//ViewInfo()->get();
		// dd($cdocs);
		// foreach ($cdocs as $cdoc){
		// 	$fname=date("ymd", strtotime($cdoc->wdate));
		// 	$name='W'.$fname.'.docx';
		// 	if(Storage::exists('public/celldocs/'.$name)) {
		// 		$cdocArray[]=1;
		// 	} else {
		// 		$cdocArray[]=0;
		// 	}
	
		// }
		return view('mediaCenter.cellDocsList', compact('cdocs'));//, 'cdocArray'));
	}
	public function upload($wdate, $wid)
    {
		// $cdocs = MD_CellDocs::All();//ViewInfo()->get();
		return view('mediaCenter.cellDocsUpload', compact('wdate', 'wid'));
    }

    public function savefile(Request $request)
    {
        // $this->validate($request, [
        //     'celldoc' => 'doc|nullable|max:1999',
        // ]);
        
		// ini_set('memory_limit','4096M');

	// dd($request);
		// Handle File Upload
		if ($request->hasFile('celldoc')) {
			$file = $request->file('celldoc');
			$filenameWithExt =$file->getClientOriginalName();
			if ( $file->isValid()) { //判斷檔案是否有效

			//Get just filename
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			//Get just extension
			$extension = $file->getClientOriginalExtension();
            if ($extension == 'docx') {
				$fname=date("ymd", strtotime($request->wdate));
                //Filename to store
                $fileNameToStore = 'W'.$fname.'.'.$extension;
                //Upload Image
                $path = $file->storeAs($this->celldocs_path, $fileNameToStore);
            }else{
				dd('抱歉，請輸入docx檔案');
			}
			// MD_WActiv::where('wid', $request->wid)->update(['wdoc'=>'1']);
		}

        return redirect()->route('services.celldocs');
		}
	}

    public function clearFile($wdate, $wid)
    {
		$fname=date("ymd", strtotime($wdate));
		$name='W'.$fname.'.docx';
		if(Storage::exists($this->celldocs_path.'/'.$name)) {
			Storage::delete($this->celldocs_path.'/'.$name);
		} else {
			dd('no');
		}
		// dd($name);
		// MD_WActiv::where('wid', $wid)->update(['wdoc'=>'0']);

		return redirect()->route('services.celldocs');
	}


	public function uploWAuthor($wdate, $wid, $wno)
    {
		return view('mediaCenter.wAuthorUpload', compact('wdate', 'wid', 'wno'));
    }

    public function savePict(Request $request)
    {
        // $this->validate($request, [
        //     'celldoc' => 'doc|nullable|max:1999',
        // ]);
        
		// ini_set('memory_limit','4096M');

	// dd($request);
		// Handle File Upload
		if ($request->hasFile('wauthor') and $request->hasFile('wauthorL')) {
			$file = $request->file('wauthor');
			$filenameWithExt =$file->getClientOriginalName();
			if ( $file->isValid()) { //判斷檔案是否有效

                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //Get just extension
                $extension = $file->getClientOriginalExtension();
                if ($extension == 'jpg') {
                    $fname=date("ymd", strtotime($request->wdate))."_".$request->wno;
                    //Filename to store
                    $fileNameToStore = $fname.'.'.$extension;
                    if (Storage::exists($this->wauthor_path.'/'.$fileNameToStore)) {
                        Storage::delete($this->wauthor_path.'/'.$fileNameToStore);
                    }
                    //Upload Image
                    $path = $file->storeAs($this->wauthor_path, $fileNameToStore);
                } else {
                    dd('抱歉，請輸入 jpg 檔案');
                }
            }

			$file = $request->file('wauthorL');
			$filenameWithExt =$file->getClientOriginalName();
			if ( $file->isValid()) { //判斷檔案是否有效

			//Get just filename
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			//Get just extension
			$extension = $file->getClientOriginalExtension();
            if ($extension == 'jpg') {
				$fname=date("ymd", strtotime($request->wdate))."_".$request->wno;
                //Filename to store
                $fileNameToStore2 = $fname.'L.'.$extension;
				if(Storage::exists($this->wauthor_path.'/'.$fileNameToStore2)) {
					Storage::delete($this->wauthor_path.'/'.$fileNameToStore2);
				}
                //Upload Image
                $path = $file->storeAs($this->wauthor_path, $fileNameToStore2);
            }else{
				dd('抱歉，請輸入 jpg 檔案');
			}
			MD_WActiv::where('wid', $request->wid)->update(['wapic'=>'1']);
		}
		$wdate = $request->wdate;
		return view('mediaCenter.wAuthorList', compact('wdate','fileNameToStore', 'fileNameToStore2'));//, 'cdocArray'));
		}
	}

}
