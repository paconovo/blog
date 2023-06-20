<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    //proteger rutas
    public function __construct()
    {
       $this->middleware('can:users.index')->only('index'); 
       $this->middleware('can:users.edit')->only('edit', 'update'); 
       $this->middleware('can:users.destroy')->only('destroy'); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::simplePaginate(10);

        return view('admin.users.index', compact('users'));
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->role);

        return redirect()->route('users.edit', $user)
                        ->with('success-update', 'Rol establecido con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->action([UserController::class, 'index'])
                        ->with('success-delete', 'Usuario eliminado con exito');
    }
}
