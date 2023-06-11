<?php


namespace App\Repositories;

use App\Repositories\Interfaces\BronRepositoryInterface;

use App\Models\Bron;

class BronRepository implements BronRepositoryInterface
{

    public function all($filial_id,$limit = 20)
    {
        return Bron::query()->where(['filial_id' => $filial_id])->paginate($limit);
    }
    public function one($filial_id, $id)
    {
        return Bron::query()->where(['filial_id'=>$filial_id,'id'=>$id])->first();
    }
    public function create($filial_id, $data)
    {
        return Bron::create([
            'filial_id'=>$filial_id,
            'service_id'=>$data->input('service_id'),
            'date'=>$data->input('date'),
            'from'=>$data->input('from'),
            'to'=>$data->input('to'),
            'type'=>$data->input('date'),
            'total_price'=>$data->input('total_price')
        ]);
    }
    public function update($filial_id, $id, $data)
    {
        if($this->one($filial_id,$id))
        {
            return  Bron::where(['filial_id'=>$filial_id,'id'=>$id])->update([
                'filial_id'=>$filial_id,
                'service_id'=>$data->input('service_id'),
                'date'=>$data->input('date'),
                'from'=>$data->input('from'),
                'to'=>$data->input('to'),
                'type'=>$data->input('date'),
                'total_price'=>$data->input('total_price')
            ]);
        }
        else
            return false;
    }
    public function delete($filial_id, $id)
    {
        if ($this->one($filial_id,$id))
        {
            Bron::query()->where(['filial_id'=>$filial_id,'id'=>$id])->delete();
        }
    }
}
