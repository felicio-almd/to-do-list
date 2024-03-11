<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticateTask
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();

        if (strpos($path, 'tasks/') === 0) {
            $authorization = $request->header('Authorization');

            if (!$authorization) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $credentials = base64_decode(substr($authorization, 6));
            list($username, $password) = explode(':', $credentials);

            $user = User::where('username', $username)->first();

            if (!$user || !password_verify($password, $user->password)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Define o usuário autenticado
            Auth::login($user);
        }

        return $next($request);
    }
}
