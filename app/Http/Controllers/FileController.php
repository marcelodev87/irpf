<?php

namespace App\Http\Controllers;

use App\Models\Declaration;
use App\Models\File;
use App\Models\Parents;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index($id, $declaration)
    {
        //dd($declaration);
        $declaration = Declaration::where('id', $declaration)->first();

        return view('app.files.index',[
            'declaration' => $declaration
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

        return redirect()->route('declaration.year',[
            'declaration' => $request->id,
            'parents' => $parents,
            'document' => session('document')
        ]);
    }
}
