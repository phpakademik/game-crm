<?php

namespace App\Http\Controllers;

use App\Http\Requests\DebtersCreateRequest;
use App\Http\Requests\DebtersUpdateRequest;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\DebtersRepository;
use Illuminate\Support\Facades\Auth;

class DebtersController extends Controller
{
    private $repo;

    public function __construct()
    {
        $this->repo = new DebtersRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repo->all(Auth::user()->filial_id);
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
    public function store(DebtersCreateRequest $request)
    {
        $this->repo->create(Auth::user()->filialid,$request);
        return  response(['message'=>'success create']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return  $this->repo->one(Auth::user()->filial_id,$id);
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
    public function update(DebtersUpdateRequest $request, $id)
    {
        return $this->repo->update(Auth::user()->filial_id,$id,$request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repo->delete(Auth::user()->filial_id,$id);
        return  response(['message'=>'success deleted']);
    }
}
