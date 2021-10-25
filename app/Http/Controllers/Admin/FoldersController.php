<?php

namespace App\Http\Controllers\Admin;


use App\Folder;

use App\Generatesop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFoldersRequest;
use App\Http\Requests\Admin\UpdateFoldersRequest;
use App\Http\Resources\Admin\generatesopResource;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class FoldersController extends Controller
{
    /**
     * Display a listing of Folder.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('folder_access')) {
        //     return abort(401);
        // }
        // if ($filterBy = Input::get('filter')) {
        //     if ($filterBy == 'all') {
        //         Session::put('Folder.filter', 'all');
        //     } elseif ($filterBy == 'my') {
        //         Session::put('Folder.filter', 'my');
        //     }
        // }

        // if (request('show_deleted') == 1) {
        //     if (! Gate::allows('folder_delete')) {
        //         return abort(401);
        //     }
        //     $folders = Folder::onlyTrashed()->get();
        // } else {
        //     $folders = Folder::all();
        // }
        $folders = folder::all();
        return view('admin.folders.index', compact('folders'));
    }

    /**
     * Show the form for creating new Folder.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (! Gate::allows('folder_create')) {
        //     return abort(401);
        // }
        
        // $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.folders.create');
    }

    /**
     * Store a newly created Folder in storage.
     *
     * @param  \App\Http\Requests\StoreFoldersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (! Gate::allows('folder_create')) {
        //     return abort(401);
        // }
        // $folder = Folder::create($request->all());

        $title=$request->folder_title;


        folder::create([

            'title'=>$title,

        ]);

        return redirect()->route('admin.folders.index');
    }


    /**
     * Show the form for editing Folder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (! Gate::allows('folder_edit')) {
        //     return abort(401);
        // }
        
        // $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        // $folder = Folder::findOrFail($id);

        return view('admin.folders.edit', compact('folder', 'created_bies'));
    }

    /**
     * Update Folder in storage.
     *
     * @param  \App\Http\Requests\UpdateFoldersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( request $request,$id)
    {
         

          
        DB::table('folders')
        ->where('id', $id)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('title' => $request->folder_title));  // update the record in the DB. 


        return redirect()->route('admin.folders.index');
    }


    /**
     * Display Folder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)

    {
        
         
       $generatesop=DB::table('generatesops')->where('folder',$id)->get();

       


        return view('admin.folders.show', compact('generatesop'));
    }
              

 
    


    /**
     * Remove Folder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $folder = Folder::findOrFail($id);
        $folder->delete();

        return redirect()->route('admin.folders.index');
    }


    public function files($title)
    {
        $folder = Folder::findOrFail($title);
            
             

            return view('admin.folders.files');
    }

    

    /**
     * Delete all selected Folder at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('folder_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Folder::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Folder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('folder_delete')) {
            return abort(401);
        }
        $folder = Folder::onlyTrashed()->findOrFail($id);
        $folder->restore();

        return redirect()->route('admin.folders.index');
    }

    /**
     * Permanently delete Folder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('folder_delete')) {
            return abort(401);
        }
        $folder = Folder::onlyTrashed()->findOrFail($id);
        $folder->forceDelete();

        return redirect()->route('admin.folders.index');
    }
}
