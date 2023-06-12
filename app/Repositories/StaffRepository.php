<?php


namespace App\Repositories;

use App\Repositories\Interfaces\StaffRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffRepository implements StaffRepositoryInterface
{
    public function all($filial_id)
    {
        return User::where(['filial_id'=>$filial_id])->get();
    }
    public function one($filial_id, $id)
    {
        return User::where(['filial_id'=>$filial_id,'id'=>$id])->first();
    }
    public function add($filial_id, $data)
    {
        $created = User::create([
            'username'=>$data->input('username'),
            'password'=>Hash::make($data->input('password')),
            'filial_id'=>$filial_id,
            'role'=>'',
            'status'=>'active'
        ]);
        if ($created)
            return true;
        else
            return false;
    }
    public function update($filial_id, $id, $data)
    {
        if ($this->one($filial_id,$id))
        {
            if (Hash::check($data->input(),$this->one($filial_id,$id)->password))
            {
                $update = User::where(['filial_id'=>$filial_id,'id'=>$id])->update([
                    'password'=>Hash::make($data->input('password'))
                ]);
                return true;
            }
            else{
                return 'error_password';
            }
        }
    }
}
