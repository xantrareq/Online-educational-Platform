<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangePass extends Controller
{

    public function __invoke(User $user)
    {
        $request = request();

        $data = $request->validate([
            'pass' => 'string|max:100',
            'new_pass' => 'string|min:8|max:100',
            'new_pass2' => 'string|min:8|max:100',
        ]);

        if(Hash::check($data['pass'],$user->password)){

            if($data['new_pass']===$data['new_pass2']){
                $user -> update(['password'=>Hash::make($data['new_pass'])]);
                return redirect('/pass_changed');
            }
        }
        return redirect('/home');
    }

}
