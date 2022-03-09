<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Bank;
use App\Models\Declaration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $document = str_replace(array('.', '-'), '', $request->document);
        $user = User::where(['document' => $document, 'email' => $request->email])->first();
       //dd($request->all(), $user, $document);

        session(['document' => $document]);
        //session(['email' => $request->email]);

        if($user){

            return redirect()->route('dashboard',[
             'document' => session('document')
            ]);
        }else{

            $neg = User::orWhere('document' , $document)->orWhere('email' , $request->email)->first();
            if(!$neg){
                return redirect()->route('user.create', ['document' => session('document'), 'email' => $request->email ]);
            }else{
                return redirect()->route('index')->with(['color' => 'danger', 'message' => 'Dados não conferem! Insira um CPF e um email válidos.']);
            }
            //------ NEW USER ---------------------
        }

    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('index');
    }

    public function index()
    {
        $user = User::where('document',session('document'))->first();
        $bank = Bank::where('user_id', $user->id)->first();
        // ----------------- DADOS PESSOAIS CAMPOS VAZIOS --------------
        $arr = array();

        //dd($user->date_of_birth);
        //$foneMask = "$(this).mask('(00) 0000-00009')"; //dd($foneMask);
        if(empty($user->name)) $arr[] = ["label" => " Nome Completo", "name" => "name", "format" => ""];
        if(empty($user->document_voter)) $arr[] = ["label" => " Título de Eleitor", "name" => "document_voter", "format" => ""];
        if(empty($user->date_of_birth)) $arr[] = ["label" =>" Data de Nascimento", "name" => "date_of_birth", "format" => "$(this).mask('00/00/0000');"];
        if(empty($user->civil_status)) $arr[] = ["label" =>" Estado Civil", "name" => "civil_status", "format" => ""];
        if(empty($user->occupation)) $arr[] = ["label" =>" Profissão", "name" => "occupation", "format" => ""];
        if(empty($user->street)) $arr[] = ["label" =>"Endereço", "name" => "street", "format" => ""];
        if(empty($user->number)) $arr[] = ["label" =>"Número", "name" => "number", "format" => ""];
        if(empty($user->complement) ?? isset($user->date_of_birth)) $arr[] = ["label" =>"Complemento", "name" => "complement", "format" => ""];
        if(empty($user->neighborhood)) $arr[] = ["label" =>"Bairro", "name" => "neighborhood", "format" => ""];
        if(empty($user->city)) $arr[] = ["label" =>"Cidade", "name" => "city", "format" => ""];
        if(empty($user->state)) $arr[] = ["label" =>"Estado", "name" => "state", "format" => ""];
        if(empty($user->zipcode)) $arr[] = ["label" =>"CEP", "name" => "zipcode", "format" => "$(this).mask('00000-000');"];
        if(empty($user->telephone)) $arr[] = ["label" =>"Telefone", "name" => "telephone", "format" => "$(this).mask('(00) 0000-00009');"];
        if(empty($user->cell)) $arr[] = ["label" =>"Celular", "name" => "cell", "format" => "$(this).mask('(00) 0000-00009');"];

        if(empty($arr)){
            $status = 'Parabéns! Seu cadastro está completo.';
            $color = 'dark';
            $button = '';
        }else{
            $status = 'Seu cadastro está incompleto. Restam as seguintes informações:';
            $color = 'danger';
            $button = '1';
        }
        // ----------------- DADOS PESSOAIS CAMPOS VAZIOS --------------

        $arr_bank = array();
        if(empty($bank->name)) $arr_bank[] = ["label" =>"Nome do Banco", "name" => "name"];
        if(empty($bank->agency)) $arr_bank[] = ["label" =>"Agência", "name" => "agency"];
        if(empty($bank->account)) $arr_bank[] = ["label" =>"Conta", "name" => "account"];
        if(empty($bank->type)) $arr_bank[] = ["label" =>"Tipo da Conta", "name" => "type"];

        if(empty($arr_bank)){
            $status_bank = 'Parabéns! Seus dados bancários estão completos.';
            $color_bank = 'dark';
            $button_bank = '';
        }else{
            $status_bank = 'Seu cadastro está incompleto. Restam as seguintes informações:';
            $color_bank = 'danger';
            $button_bank = "1";
        }

        $declarations = Declaration::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
        //dd($declarations);

        return view('app.dashboard.index',[
            'user' => $user,
            'declarations' => $declarations,
            'bank' => $bank,
            'array' => $arr,
            'array_bank' => $arr_bank,
            'status' => $status,
            'color' => $color,
            'button' => $button,
            'status_bank' => $status_bank,
            'color_bank' => $color_bank,
            'button_bank' => $button_bank
        ]);
    }

    public function create($document, $email)
    {
        return view('app.users.create',[
            'email' => $email,
            'document' => $document
        ]);
    }

    public function store(UserRequest $request)
    {
        //dd($request->all());
        //------ NEW USER ---------------------
        $userCreate = new User();
        $userCreate->fill($request->all());
        $userCreate->email_verified_at = now();
        $userCreate->password = Hash::make(now());
        $userCreate->remember_token = Str::random(10);
        //$userCreate->date_of_birth = date('Y-m-d');
        $userCreate->save();

            //------ NEW BANK ---------------------
            $bankCreate = new Bank();
            $bankCreate->user_id = $userCreate->id;
            $bankCreate->save();

            //------ NEW BANK ---------------------


        session(['document' => str_replace(array('.', '-'), '', $userCreate->document)]);

        return redirect()->route('dashboard',[
        'document' => session('document')
        ]);
        //return view('app.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('document', session('document'))->first();
        //dd($user);
        return view('app.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
        //dd($request->all());
        $user = User::where('id', $request->id)->first();
        //dd($user);
        $user->fill($request->all());

        if(!$user->save()){
            return redirect()->back()->withInput()->withErrors(['color' => 'danger', 'message' => 'Erro! Entre em contato conosco por telefone: 21 2667-1431']);
        }

        return redirect()->route('dashboard', session('document') )->with(['color' => 'success', 'message' => 'Dados Atualizados com sucesso!']);
    }

}
