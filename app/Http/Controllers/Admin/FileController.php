<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Declaration;
use App\Models\File;
use App\Models\Parents;
use App\Models\User;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index($id, $declaration)
    {
        //dd($declaration);
        $declaration = Declaration::where('id', $declaration)->first();
        $user = User::select('id', 'name', 'document')->where('id', $id)->first();

        return view('admin.files.index',[
            'declaration' => $declaration,
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        for ($i = 0; $i < count($request->allFiles()['file']); $i++){
            //dd($i);
            $file = $request->allFiles()['file'][$i];

            $saveFile = new File();
            $saveFile->declaration_id = $request->id;
            $saveFile->description = $request->description;
            $saveFile->path = $file->store('files/'.$request->document);
            $saveFile->save();
            unset($saveFile);
        }

        $parents = Parents::where('declaration_id', $request->id)->get();

        return redirect()->route('admin.admin.declarations.index',[
            'declaration' => $request->id,
            'parents' => $parents,
            'id' => $request->user_id
        ]);
    }
}
