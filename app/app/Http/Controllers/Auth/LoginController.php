<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Seta as chaves e valores necessários para o login
     * as chaves representam as colunas do banco que deven ser verificadas
     * e o valor o registro no banco
     * Neste caso intenção é adicionar a verificação status do usuário 1( ativp )
     * Só autentica usuários com status ativo
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     * @overide
     */
    protected function credentials(\Illuminate\Http\Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        return array_add($credentials, 'status', '1');
    }

    /**
     * Retorna o 'path' para onde deverá ser redirecionado
     * após ser autenticado com sucesso
     *
     *
     * @override
     */
    protected function redirectTo()
    {
        // TODO: logica futura aqui para determinar o redirecionamento
        return '/dashboard';
    }

}
