<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct( User $user)
    {
        $this->user = $user;
    }

    public function showAdminUsers(Request $request, User $user){
        if(!(Auth::user()->role)){ // Check if admin access or not
            return redirect('user');
        }else{ // if admin access then show all users
            $data = [];
            $data['users'] = $this->user->all()->where('role', '=', 1); // Show all admin users
            return view('allusers/admins',$data); // first parameter is the folder name, the second one is the filename
        }
    }

    public function showNormalUsers(Request $request, User $user){
        if(!(Auth::user()->role)){ // Check if admin access or not
            return redirect('user');
        }else{ // if admin access then show all users
            $data = [];
            $data['users'] = $this->user->all()->where('role', '=', 0); // Show all normal users (not admins)
            return view('allusers/users',$data); // first parameter is the folder name, the second one is the filename
        }
    }
    //
}
