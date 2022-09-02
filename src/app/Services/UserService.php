<?php

namespace App\Services;


use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserService
{
    /** @var Request $request */
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function login()
    {
        /** @var User $user */
        $user = User::where('name', '=', $this->request->input('name'))
            ->where('password', '=', sha1($this->request->input('password')))
            ->first();

        if ($user !== null) {
            $token = Str::random(20);
            $user->remember_token = $token;
            if ($user->save() === false) {
                throw new Exception('Error per saving user!');
            }

            Auth::login($user);

            session()->put('user_id', $user->id);

            return $user;
        }

        return null;
    }

    public function logout()
    {
        /** @var User $user */
        $user = Auth::user();
        $userName = $user->name;

        if ($userName !== null) {
            /** @var User $user */
            $user = User::where('name', '=', $userName)->first();
            if ($user !== null) {
                $user->remember_token = '';
                if ($user->save() === false) {
                    throw new \RuntimeException('Error per save user!');
                }

                Auth::logout();

                return true;
            }
        }

        return false;
    }

    public function register()
    {
        $user = new User();
        if ($user->checkUserExists($this->request->input('email'))) {
            return false;
        }

        $user->name = $this->request->input('name');
        $user->password = sha1($this->request->input('password'));
        $user->email = $this->request->input('email');
        $user->remember_token = Str::random(20);
        if ($user->save() === false) {
            throw new \RuntimeException('Error per register user!');
        }

        $user->assignRole('user');

        return true;
    }
}
