<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Bank;
use App\Models\Declaration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $declarations = Declaration::orderBy('id', 'DESC')->get();
        return view('admin.dashboard.index', [
            'users' => $users,
            'declarations' => $declarations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd('xxx');
        return view('admin.users.create');
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

        $rules = [
            'name' => 'required|min:3|max:191',
            'document' => 'min:11|max:14|unique:users',
            'document_voter' => 'nullable|min:8|max:12',
            'date_of_birth' => 'required|date_format:d/m/Y',
            'civil_status' => 'nullable|min:3|max:12',

            // Income
            'occupation' => 'nullable|min:3|max:50',

            // Address
            'zipcode' => 'nullable|min:8|max:9',
            'street' => 'nullable|min:5',
            'number' => 'nullable|min:1',
            'complement' => 'nullable|min:1',
            'neighborhood' => 'nullable|min:3',
            'city' => 'nullable|min:3',
            'state' => 'nullable|max:2',

            // Contact
            'telephone' => 'nullable|min:10|max:15',
            'cell' => 'nullable|min:10|max:15',
            'email' => 'email|unique:users'
        ];
        $messages = [
            'name.min' => 'O campo NOME deve possuir no mímino 3 letras!',
            'name.required' => 'O campo NOME é obrigatório!',

            'document.unique' => 'O campo CPF é obrigatório!',
            'document.min' => 'Insira um CPF válido!',

            'email.required' => 'O campo EMAIL é obrigatório!',
            'email.unique' => 'Este EMAIL igual a esse! Tente entrar com outro email.',
            'email.email' => 'Insira um EMAIL válido.',

            'date_of_birth.required' => 'O campo DATA DE NASCIMENTO é obrigatório!',

            'document_voter.min' => 'O campo TÍTULO DE ELEITOR deve possuir no mímino 8 números!',
            'document_voter.max' => 'O campo TÍTULO DE ELEITOR deve possuir no máximo 12 números!',

            'civil_status.min' => 'O campo ESTADO CIVIL deve possuir no mímino 3 letras!',
            'civil_status.max' => 'O campo ESTADO CIVIL deve possuir no máximo 12 letras!',

            'occupation.min' => 'O campo PROFISSÃO deve possuir no mímino 3 letras!',
            'occupation.min' => 'O campo PROFISSÃO deve possuir no máximo 50 letras!',

            'zipcode.min' => 'O campo CEP deve possuir no mímino 8 números!',
            'zipcode.max' => 'O campo CEP deve possuir no máximo 9 números!',

            'street.min' => 'O campo RUA deve possuir no mímino 3 letras!',
            'number.min' => 'O campo NÚMERO deve possuir no mímino 1 número!',
            'complement.min' => 'O campo COMPLEMENTO deve possuir no mímino 1 número!',
            'neighborhood.min' => 'O campo BAIRRO deve possuir no mímino 3 letras!',
            'city.min' => 'O campo CIDADE deve possuir no mímino 3 letras!',
            'state.max' => 'O campo ESTADO deve possuir apenas 2 letras!',

            'telephone.min' => 'O campo TELEFONE deve possuir no mímino 10 números!',
            'telephone.max' => 'O campo TELEFONE deve possuir no máximo 13 números!',

            'cell.min' => 'O campo CELULAR deve possuir no mímino 10 números!',
            'cell.max' => 'O campo CELULAR deve possuir no máximo 13 números!',
        ];

        $value = $request->except('document');
        //removendo pontos e traço e criando a chave para validação.
        $value['document'] = str_replace(['.', '-'], '', $request->input('document'));
        $validator = Validator::make($value, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

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

        //dd($userCreate);

        $users = User::all();
        $declarations = Declaration::orderBy('id', 'DESC')->get();
        return view('admin.dashboard.index', [
            'users' => $users,
            'declarations' => $declarations
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $bank = Bank::where('user_id', $user)->first();
        $user = User::find($user);
        return response()->json(['bank' => $bank, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        $user->fill($request->all());
        if (!$user->save()) {
            return redirect()->back()->withInput()->withErrors(['color' => 'danger', 'message' => 'Erro! Entre em contato conosco por telefone: 21 2667-1431']);
        }
        return redirect()->route('admin.admin.user.edit', $id)->with(['color' => 'success', 'message' => 'Dados Atualizados com sucesso!']);
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
