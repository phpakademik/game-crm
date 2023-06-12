<?php


namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\DebtersRepositoryInterface;
use App\Models\Debters;

class DebtersRepository implements DebtersRepositoryInterface
{

    public function all($filial_id, $limit = 20)
    {
       return Debters::where(['filial_id'=>$filial_id])->pagnete($limit);
    }
    public function one($filail_id, $id)
    {
        return Debters::where(['filial_id'=>$filail_id,'id'=>$id])->first();
    }
    public function create($filial_id, $data)
    {
        return Debters::create([
            'filial_id'=>$filial_id,
            'name'=>$data->input('name'),
            'number'=>$data->input('phone'),
            'price'=>$data->input('price'),
            'amount_received'=>$data->input('amount_received'),
            'status'=>$data->input('status'),
        ]);
    }
    public function update($filial_id,$id, $data)
    {
        if ($this->one($filial_id,$id))
        {
            return Debters::where(['filial_id'=>$filial_id,'id'=>$id])->update([
                'filial_id'=>$filial_id,
                'name'=>$data->input('name'),
                'number'=>$data->input('phone'),
                'price'=>$data->input('price'),
                'amount_received'=>$data->input('amount_received'),
                'status'=>$data->input('status'),
            ]);
        }
        else
            return false;
    }
    public function delete($filial_id, $id)
    {
        if ($this->one($filial_id,$id))
        {
            return Debters::where(['filial_id'=>$filial_id,'id'=>$id])->delete();
        }
        else
            return  false;
    }

}
