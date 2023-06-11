<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Requests\ProfileCreateRequest;
use App\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Profile $profile)
    {
        
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
    public function store(ProfileCreateRequest $request,Profile $profile)
    {
        $user = User::find($request->input('user_id'));
        if (!$user) {
            return response(['message'=>'not found user'],404);
        }
        $profile->create([
            'user_id'=>auth()->user()->filial_id,
            'first_name'=>$request->input('first_name'),
            'last_name'=>$request->input('last_name'),
            'phone'=>$request->input('phone')
        ]);
        return response(['message'=>'success created profile']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::find($id);
        if(!$profile)
            return response(['message'=>'not found profile'],404);
        return $profile;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request, $id)
    {
        $profile = Profile::find($id);
        if (!$profile) 
            return response(['message'=>'not found profile']);
        $profile->update([
            'first_name'=>$request->input('first_name'),
            'last_name'=>$request->input('last_name'),
            'phone'=>$request->input('phone')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
