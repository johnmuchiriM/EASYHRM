<?php

namespace Modules\Role\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Role\Models\Role;
use Session;
use Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $roles = Role::getRole();
        return view('role::index', compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return response
     */
    public function edit($id)
    {
        return Role::find($id);
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $validator = Validator::make($request->all(), [
            'priority' => 'required|different:name',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = $request->except('_token');

        if ($request->role_id != null) {

            $roles = Role::findorfail($request->role_id);
            $roles->update($data);
            Session::flash('success', __('role::role.successfully-updated'));

        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:roles',
                'priority' => 'required|different:name',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()]);
            }
            Role::create($data);
            Session::flash('success', __('role::role.successfully-created'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $users = User::where('role_id', $id)->first();
        
        if (isset($users->role_id)) {
            Session::flash('error', __('role::role.user-already-present'));
            return 'false';
        } else {
            Role::where('id', $id)->delete();
            Session::flash('success', __('role::role.successfully-deleted'));
            return 'true';
        }
    }
}
