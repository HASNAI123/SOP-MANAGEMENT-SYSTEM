<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySopRequest;
use App\Http\Requests\StoreSopRequest;
use App\Http\Requests\UpdateSopRequest;
use App\Sop;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;





class SopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sops = Sop::all();

        return view('admin.sops.index', compact('sops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        
        
        return view('admin.sops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

       
       $file=$request->file('sop_file');
       $filename= $file->getClientOriginalName();
       $filename= time(). '.' .$filename;
       $path=$file->storeas('public',$filename);
       $path=public_path($filename);

       
       $accepted=$request->accepted_by;
       $uploaded=$request->uploaded_by;
       $sop_title=$request->sop_title;
       $business_unit=$request->business_unit;
       $effective_date=$request->effective_date;
       //$modified="mujeeb";
 
       Sop::create([
        'accepted_by'=>$accepted,
        'uploaded_by'=>$uploaded,
           'Sop_file'=>$filename,
           'sop_title'=>$sop_title,
           'business_unit'=>$business_unit,
           'effective_date'=>$effective_date,
           

       ]);

     

      
       return redirect()->route('admin.sops.index');
    }



    

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sop $sop)
    {
        return view('admin.sops.show', compact('sop'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sop $sop)
    {
        
        return view('admin.sops.edit', compact('sop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {   
        

       
        
        //$user_name = Auth::user()->name;

        //$id=$sop->id;

        $file=$request->file('sop_file');
       $filename= $file->getClientOriginalName();
       $filename= time(). '.' .$filename;
       $path=$file->storeas('public',$filename);
       $path=public_path($filename);

        $sop = sop::find($id)
        ->update([
                  'Modified_by'=>$request->edited_by,
                  'Modified_date'=> now()->toDateString('Y-m-d'),
                  'sop_title'=>$request->sop_title,
                  'business_unit'=>$request->business_unit,
                  'effective_date'=>$request->effective_date,
                  'Sop_file'=>$filename,
                  
                  

    ]);



        

        return redirect()->route('admin.sops.index');
    }
    
    public function download($sop_file){
        
     $path = storage_path('./app/public/'.$sop_file);
     
      $headers = ['Content-Type: application/pdf'];

      $fileName = time().'.pdf';

      return response()->download($path, $fileName, $headers);

      
}

  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        

        $sop->delete();

        return back();
    }

    public function massDestroy(MassDestroySopRequest $request)
    {
        Sop::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function generate()
    {
        return view('admin.sops.generate');
    }
}



