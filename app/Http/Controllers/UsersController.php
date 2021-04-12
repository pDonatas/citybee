<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInfoValidationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnArgument;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    public function showPersonalData()
    {
        return view('contact_info.index', [
            'user' => Auth::user()
        ]);
    }
    public function showClientPersonalData($id)
    {
        $data = User::find($id);
        return view('contact_info.edit', ['data' => $data]);

    }
    public function updateData(UserInfoValidationRequest $request)
    {
        $data = User::find($request->id);

        $data->name = $request->name;
        $data->surname = $request->surname;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->birth_date = $request->birth_date;
        $data->save();


        return redirect('contact_info');



    }
}
