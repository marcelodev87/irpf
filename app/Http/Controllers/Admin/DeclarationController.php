<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Declaration;
use App\Models\File;
use App\Models\Parents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeclarationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $declaration)
    { //dd($declaration);
        $declaration = Declaration::where('id', $declaration)->first();
        $declarationResume = explode(';', $declaration->description);

        if(!is_array($declarationResume)){
            $declarationResume = " ";
        }


        $user = User::select('id', 'name', 'document')->where('id', $declaration->user_id)->first();
        $files = File::where('declaration_id', $declaration->id)->get();
        $url = "https://etikasolucoes.com.br/irpf/storage/app/";

        $parents = Parents::where('declaration_id', $declaration->id)->get();
        return view('admin.declarations.index',[
            'declaration' => $declaration,
            'declarationResume' => $declarationResume,
            'files' => $files,
            'parents' => $parents,
            'user' => $user,
            'url' =>$url
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

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

        return redirect()->route('admin.admin.declarations.index',[
            'declaration' => $createDeclaration->id,
            'id' => $createDeclaration->user_id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::select('id', 'name', 'document')->where('id', $id)->first();
        $declarations = Declaration::where('user_id', $id)->orderBy('id', 'DESC')->get();
        return view('admin.declarations.show', [
            'declarations' => $declarations,
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
