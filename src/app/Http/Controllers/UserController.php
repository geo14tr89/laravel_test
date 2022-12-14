<?php

namespace App\Http\Controllers;


use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('statistic');
    }

    /**
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function login(Request $request): string
    {
        $userService = new UserService($request);
        $user = $userService->login();
        if ($user !== null) {
            return view('home')
                ->with('success', 'Hello ' . $user->name . ', You successfully login!');
        }

        return view('home')->with('error', 'Incorrect username or password!');
    }

    /**
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function logout(Request $request)
    {
        $userService = new UserService($request);
        if ($userService->logout() === true) {
            return view('home')->with('success', 'You successfully logged out!');
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
        $userService = new UserService($request);
        if ($userService->register() === true) {
            return view('home')->with('success', 'Thanks for your registration!');
        }

        return view('home')->with('error', 'This user is already exists!');
    }
}
