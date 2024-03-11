<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function login(Request $request)
    {
        // Validação dos dados do request
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Verificar se as credenciais são válidas
        if (Auth::attempt($request->only('username', 'password'))) {
            // Autenticação bem-sucedida, retornar o usuário autenticado
            return response()->json(Auth::user());
        }

        // Autenticação falhou, retornar erro
        return response()->json(['message' => 'Credenciais inválidas'], 401);
    }

    public function register(Request $request)
    {
        // Validação dos dados do request
        $request->validate([
            'username' => 'required|unique:users|max:50',
            'password' => 'required|min:6',
        ]);

        // Criar o usuário
        $user = new User();
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));

        // Salvar o usuário
        $user->save();

        // Retornar o usuário criado
        return response()->json($user, 201);
    }

    /**
     * Criar um novo usuário.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Validar os dados do request
        $validatedData = $request->validate([
            'username' => 'required|unique:users|max:50',
            'password' => 'required|min:6',
        ]);

        // Criar o usuário
        $user = new User();
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));

        // Salvar o usuário
        $user->save();

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $requestData = $request->all();

        Utils::copyNoNullProperties($requestData, $user);
        $user->save();

        return response()->json($user);
    }
}
