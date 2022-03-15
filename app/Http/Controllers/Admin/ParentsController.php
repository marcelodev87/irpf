<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParentsRequest;
use App\Models\Declaration;
use App\Models\Parents;
use App\Models\User;
use Illuminate\Http\Request;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $declaration)
    {
        $declaration = Declaration::where('id', $declaration)->first();
        $user = User::select( 'id', 'name', 'document')->where('id', $id)->first();
        return view('admin.parents.index', [
            'declaration' => $declaration,
            'user' => $user
        ]);
    }

    public function store(ParentsRequest $request)
    {
        //dd($request->all());
        $createParent = new Parents();
        $createParent->fill($request->all());

        $description = $createParent->description;

        if(is_array($description)){
            $createParent->description = implode("; ", $request->description);
        }else{
            $createParent->description = $request->description;
        }

        $createParent->save();

        //$declaration = Declaration::where('id', $request->declaration_id)->first();
        $parents = Parents::where('declaration_id', $request->declaration_id)->get();

        return redirect()->route('admin.admin.declarations.index',[
            'parents' => $parents,
            'declaration' => $request->declaration_id,
            'id' => $request->user_id
        ]);
    }
}
