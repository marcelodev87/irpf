<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeclarationRequest;
use App\Models\Declaration;
use App\Models\File;
use App\Models\Parents;
use App\Models\User;
use Illuminate\Http\Request;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class DeclarationsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeclarationRequest $request)
    {
        $verifyDeclaration = Declaration::where('year', $request->year)->where('user_id', $request->user_id)->first();

        if($verifyDeclaration){
            return redirect()->back()->with([
                'color' => 'danger',
                'message' => 'Você já possui uma declaração cadastrada para o ano de '.$request->year.'! Realize o cadastro correto.']);
        }

        $createDeclaration = new Declaration;
        $createDeclaration->fill($request->all());

        if(!empty($request->description)){
            $createDeclaration->description = implode("; ", $request->description);
        }else{
            $createDeclaration->description = "";
        }

        $createDeclaration->save();

        $parents = Parents::where('declaration_id', $createDeclaration->id)->get();
        $files = File::where('declaration_id', $createDeclaration->id)->get();

        return redirect()->route('declaration.year',[
            'declaration' => $createDeclaration->id,
            'parents' => $parents,
            'document' => session('document'),
            'files' => $files
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Declaration  $declaration
     * @return \Illuminate\Http\Response
     */
    public function show($id, $declaration)
    {
        $declaration = Declaration::where('id', $declaration)->first();
        $parents = Parents::where('declaration_id', $declaration->id)->get();
        $files = File::where('declaration_id', $declaration->id)->get();

        $declarationResume = explode(';', $declaration->description);

        //dd($declarationResume);

        return view('app.declarations.index', [
            'declaration' => $declaration,
            'parents' => $parents,
            'files' => $files,
            'declarationResume' => $declarationResume
        ]);
    }

}
