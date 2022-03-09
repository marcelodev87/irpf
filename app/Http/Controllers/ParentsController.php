<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParentsRequest;
use App\Models\Declaration;
use App\Models\Parents;
use Illuminate\Http\Request;

class ParentsController extends Controller
{
    public function index($id)
    {
        $declaration = Declaration::where('id', $id)->first();
        return view('app.parents.index',[
            'declaration' => $declaration
        ]);
    }

    public function store(ParentsRequest $request)
    {
        $createParent = new Parents();
        $createParent->fill($request->all());

        $description = $createParent->description;

        if(is_array($description)){
            $createParent->description = implode(", ", $request->description);
        }else{
            $createParent->description = $request->description;
        }

        $createParent->save();

        $declaration = Declaration::where('id', $request->declaration_id)->first();
        $parents = Parents::where('declaration_id', $request->declaration_id)->get();

        return redirect()->route('declaration.year',[
            'document' => session('document'),
            'parents' => $parents,
            'declaration' => $declaration
        ]);
    }
}
