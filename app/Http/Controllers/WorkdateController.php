<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WorkDateRequest;
use App\Repositories\WorkDateRepository;
use App\Repositories\UserRepository;

class WorkdateController extends Controller
{
    private $repository;
    private $user;
    public function __construct()
    {
        $this->repository = new WorkDateRepository();
        $this->user = new UserRepository();
    }
    public function start(WorkDateRequest $request)
    {
        if (!$this->user->find($request->input('user_id')))
            return response(['message'=>'not found user'],404);
        else
            $this->repository->start($request->input('filial_id'),$request->input('user_id'));
    }

    public function end(WorkDateRequest $request)
    {
        if (!$this->user->find($request->input('user_id')))
            return response(['message'=>'not found user'],404);
        else
            $this->repository->end($request->input('filial_id'),$request->input('user_id'));
    }
}
