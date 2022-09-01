<?php

namespace App\Http\Controllers;


use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\StatisticService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function login(Request $request): string
    {
        $user = User::where('name', '=', $request->input('name'))
            ->where('password', '=', sha1($request->input('password')))
            ->first();

        if ($user !== null) {
            $token = Str::random(20);
            $user->remember_token = $token;
            if ($user->save() === false) {
                throw new Exception('Error per saving user!');
            }

            Auth::login($user);

            session()->put('user_name', $user->name);
            session()->put('user_id', $user->id);

            (new StatisticService($request))->addStatistics();



            return view('home')
                ->with('success', 'Hello ' . $user->name . ', You successfully login!');
        }

        return redirect()->back(301)->withErrors('Incorrect username or password!');
    }

    /**
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function logout(Request $request)
    {
        $userName = session()->get('user_name');
        if ($userName !== null) {
            $user = User::where('name', '=', $userName)->first();
            if ($user !== null) {
                $user->remember_token = '';
                if ($user->save() === false) {
                    throw new \RuntimeException('Error per save user!');
                }

                (new StatisticService($request))->addStatistics();

                Auth::logout();

                return view('home')->with('success', 'You successfully logged out!');
            }
        }

        return view('home');
    }

    /**
     * @param RegisterRequest $request
     * @return string
     * @throws Exception
     */
    public function register(RegisterRequest $request): string
    {
        $user = new User();
        if ($user->checkUserExists($request->input('email'))) {
            return view('home')->with('error', 'This user is already exists!');
        }

        $user->name = $request->input('name');
        $user->password = sha1($request->input('password'));
        $user->email = $request->input('email');
        $user->remember_token = Str::random(20);
        if ($user->save() === false) {
            throw new \RuntimeException('Error per register user!');
        }

        $user->assignRole('user');

        Auth::login($user);
        (new StatisticService($request))->addStatistics();
        Auth::logout();

        return view('home')->with('success', 'Thanks for your registration!');
    }
}
