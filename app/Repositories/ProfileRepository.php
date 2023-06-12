<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Repositories\Interfaces\ProfileRepositoryInterface;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function view($filial_id, $id)
    {
        return Profile::where(['filial_id'=>$filial_id,'id'=>$id])->first();
    }
    public function create($filial_id, $data)
    {
        $created = Profile::create([
            'filial_id'=>$filial_id,
            'user_id'=>$data->input('user_id'),
            'first_name'=>$data->input('first_name'),
            'last_name'=>$data->input('last_name'),
            'phone'=>$data->input('phone')
        ]);
        if ($created)
            return true;
        else
            return false;
    }
    public function update($filial_id, $id, $data)
    {
        if ($this->view($filial_id,$id))
        {
            Profile::query()
                ->where(['filial_id'=>$filial_id,'id'=>$id])
                ->update([
                    'first_name'=>$data->input('first_name'),
                    'last_name'=>$data->input('last_name'),
                    'phone'=>$data->input('phone')
                ]);
            return true;
        }
        else
            return false;
    }
}
