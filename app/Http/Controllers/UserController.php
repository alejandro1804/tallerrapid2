<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


/**
 * Class OperatorController
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::pluck('name', 'id');
        $users = User::search(request('search'))->orderBy('name', 'ASC')->paginate(6);

        //  $operators = Operator::with ('position')->get();
        return view('user.index', compact('users', 'positions'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::pluck('name', 'id');
        $user = User::find($id);
       //echo $id ;
       // return view('user.show', compact('user', 'positions'));
       return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $positions = Position::orderBy('name')->pluck('name', 'id');
        $roles = Role::orderBy('name')->pluck('name','id');
        $user = User::find($id);



        return view('user.edit', compact('user', 'positions', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
       // request()->validate(Operator::$rules);
        $request->validate([
            'name' => 'required|unique:users,name,' . $user->id,
            'position_id' => 'required',
            'role_id' =>'required',
            'phone' => 'numeric|required',
            'email' => 'required'
        ]);

        $enminuscula = strtolower($request->input('name'));          // todo a minusculas
        $primeras_en_mayuscula = ucwords($enminuscula);   // primera letra de cada palabra a mayusculas
        $request->merge(['name' => $primeras_en_mayuscula]);

        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}