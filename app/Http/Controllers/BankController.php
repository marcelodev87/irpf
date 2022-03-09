<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankRequest;
use App\Models\Bank;
use App\Models\User;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $bank)
    {
        //dd($bank);
        $bank = Bank::where('id', $bank)->first();
        //dd($bank);
        return view('app.users.bank',[
            'bank' => $bank
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(BankRequest $request)
    {
        $bank = Bank::where('id', $request->id)->first();
        $bank->fill($request->all());
        //dd($request->all(), $bank);

        if(!$bank->save()){
            return redirect()->back()->withInput()->with(['color' => 'danger', 'message' => 'Erro! Entre em contato conosco por telefone: 21 2667-1431']);
        }

        return redirect()->route('dashboard', session('document') )->with(['color' => 'success', 'message' => 'Dados Atualizados com sucesso!']);
    }
}
