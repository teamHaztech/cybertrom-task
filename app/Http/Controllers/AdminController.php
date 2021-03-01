<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Resource;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function users()
    {
        $users = User::paginate(5);
        return view('admin.users.index',compact('users'));
    }

    public function changeRole($userId){
        $user = User::findOrFail($userId);
        if($user->role->id == 1){
            $user->update([
                'role_id'=> 2
            ]);
        }else{
            $user->update([
                'role_id'=> 1
            ]);
        }

        return redirect()->back();
    }

    public function resources(){
        $resources = Resource::paginate(5);
        return view('admin.resources.index',compact('resources'));
    }
}
