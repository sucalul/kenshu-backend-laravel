<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewSignup()
    {
        return view('signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\SignupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function signup(SignupRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        // 画像がない時はデフォルトで1入れる
        if (empty($request->file('profile_image'))) {
            $profile_resource_id = 1;
        } else {
            $profile_resource_id = uniqid();
            $uploaded_path = 'img/users/' . $profile_resource_id . '.png';
            // fileの移動
            move_uploaded_file($request->file('profile_image'), $uploaded_path);
        }

        User::create([
            'name' => $request->get('name'),
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'profile_resource_id' => $profile_resource_id,
        ]);

        $credentials = ['email' => $email, 'password' => $password];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/articles');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function viewSignin()
    {
        return view('signin');
    }

    public function signin(SigninRequest $request){
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/articles');
        }

        return back()->withErrors([
            'email' => 'メールアドレスかパスワードが間違っています。',
        ]);
    }
}
