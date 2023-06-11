<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Requests\FilialCreteRequest;
use App\Requests\FilialUpdateRequest;
use App\Models\Filial;

class FilialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Filial $filial)
    {
        $filial = $filial->paginate();
        return $filial;
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
    public function store(FilialCreteRequest $request)
    {
        $file = $request->file('logo');
        $logo = Str::random(64).'.'.$file->getClientOrginalExtension();
        $file->storeAs('/public/uploads/filial',$logo);
        Filial::create([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'logo'=>$logo,
            'location'=>$request->input('location')
        ]);
        return response(['message success created filial']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Filial $filial)
    {
        return $filial->find($id);
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
    public function update(Request $request, $id,Filial $filial)
    {
        $filial = $filial->find($id);
        $logo = $request->file('logo');
        if (!$filial) {
            return response(['message'=>'not found filial']);
        }
        if (!$logo) {
            $filial->update([
               'name'=>$request->input('name'),
               'description'=>$request->input('description'),
               'location'=>$request->input('location')
           ]);
        }
        else
        {
            $filename = Str::random(64).'.'.$logo->getClientOrginalExtension();
            $logo->storeAs('/public/uploads/filial',$filename);
            $filial->update([
               'name'=>$request->input('name'),
               'description'=>$request->input('description'),
               'logo'=>$filename,
               'location'=>$request->input('location')
           ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $filial = Filial::find($id);
        if (!$filial) {
            return response(['message'=>'not found filial']);
        }
        Filial::destroy($id);
        return response(['message'=>'success deleted filial']);
    }

    public function checkStatus($id,Filial $Filial)
    {
        $filial->find($id);
        $status = $filial->status == 'active' ? 'inactive':'active';
        $filial->update(['status'=>$status]);
        return response(['message'=>'success change status']);
    }
}
