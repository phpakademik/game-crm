<?php

namespace App\Http\Controllers;

use App\Repositories\ProfileRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Http\Requests\ProfileCreateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user ;
    private $profile;
    public function __construct()
    {
        $this->user = new UserRepository();
        $this->profile = new ProfileRepository();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request+
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileCreateRequest $request)
    {

        $user = $this->user->find($request->input('user_id'));
        if (!$user) {
            return response(['message'=>'not found user'],404);
        }
        $this->profile->create(Auth::user()->filila_id,[
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
        $profile = $this->profile->view(Auth::user()->filial_id,$id);
        if(!$profile)
            return response(['message'=>'not found profile'],404);
        return $profile;
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
        $profile = $this->profile->view(Auth::user()->filial_id,$id);
        if(!$profile)
            return response(['message'=>'not found profile'],404);
        $this->profile->update(Auth::user()->filial_id,$id,[
            'first_name'=>$request->input('first_name'),
            'last_name'=>$request->input('last_name'),
            'phone'=>$request->input('phone')
        ]);
    }
}
