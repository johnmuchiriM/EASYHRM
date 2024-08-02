<?php

namespace Modules\Profile\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile::change-password.index',compact('user'));
    }

    /**
     * Change the current password
     * @param Request $request
     * @return Renderable
     */
    public function changePassword(Request $request)
    {       
        $user = Auth::user();
    
        $userPassword = $user->password;
        
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|same:confirm_password|min:6',
            'confirm_password' => 'required',
        ]);

        if (!Hash::check($request->current_password, $userPassword)) {
            return back()->withErrors(['current_password'=>__('profile::lang.your-password-not-match')]);
        }

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->back()->with('success', __('profile::lang.password-successfully-changed'));
    }

}