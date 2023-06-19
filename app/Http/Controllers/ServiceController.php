<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Auth;
use App\Models\Services;
use App\Http\Requests\ServiceCreateRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Repositories\ServiceRepository;


class ServiceController extends Controller
{
    private $respository;

    public function __construct()
    {
        $this->respository = new ServiceRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = $this->respository->all(Auth::user()->filial_id);
        return response($services);
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
    public function store(ServiceCreateRequest $request)
    {
        $this->respository->create(Auth::user()->filial_id,$request);
        return response(['message'=>'success created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = $this->respository->one(\auth()->user()->filial_id,$id);
        if (!$service)
            return response(['message'=>'not found service'],404);
        return $service;
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
    public function update(ServiceUpdateRequest $request, $id)
    {
        $service = $this->respository->one(\auth()->user()->filial_id,$id);
        if (!$service)
            return response(['message'=>'not found service'],404);
        $this->respository->update($id,\auth()->user()->filial_id,$request);
        return response(['message'=>'success updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = $this->respository->one(\auth()->user()->filial_id,$id);
        if (!$service)
            return response(['message'=>'not found service'],404);
        $this->respository->delete(\auth()->user()->filial_id,$id);
        return response(['message'=>'Success deleted'],200);
    }
    public function setStatus($id)
    {
        $status = $this->respository->setStatus(\auth()->user()->filial_id,$id);
        if ($status)
            return response(['message'=>'success']);
        else if($status == 'not_found_service')
            return  response(['message'=>'not found service'],404);
    }
}
