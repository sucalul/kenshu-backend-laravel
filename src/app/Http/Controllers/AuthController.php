<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signupIndex()
    {
        //
        return view('signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
        ];
        $this->validate($request, $rules);

        $email = $request->get('email');
        // 画像がない時はデフォルトで1入れる
        if (empty($_FILES['profile_image']['name'])) {
            $profile_resource_id = 1;
        } else {
            $profile_resource_id = uniqid();
            $uploaded_path = 'img/users/' . $profile_resource_id . '.png';
            // fileの移動
            move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploaded_path);
        }

        User::create([
            'name' => $request->get('name'),
            'email' => $email,
            'password' => password_hash($request->get('password'), PASSWORD_DEFAULT),
            'profile_resource_id' => $profile_resource_id,
        ]);

        // sessionに$emailを入れる
        // これをみてログインしてるか確認する
        session(['EMAIL' => $email]);
        return redirect('/articles');
    }
}
