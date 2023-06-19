<?php
namespace App\Repositories;


use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Models\Services;


class ServiceRepository implements ServiceRepositoryInterface
{
	public function all($filial_id)
	{
		return Services::where(['filial_id'=>$filial_id])->paginate();
	}
	public function one($filial_id,$id)
	{
		return Services::where(['id'=>$id,'filial_id'=>$filial_id])->first();
	}
	public function create($filial_id,$data)
	{
		$create = Services::create([
			'filial_id'=>$filial_id,
			'name'=>$data['name'],
			'price'=>$data['price'],
			'price_vip'=>$data['price_vip'],
			'status'=>$data['status'],
		]);
		if ($create)
			return true;
		else
			return false;
	}
	public function update($id,$filial_id,$data)
	{
		if ($this->one($filial_id,$id)) {
			$update = Services::where(['id'=>$id,'filial_id'=>$filial_id])->update([
				'name'=>$data['name'],
				'price'=>$data['price'],
				'price_vip'=>$data['price_vip'],
				'status'=>$data['status'],
			]);
			if ($update) {
				return true;
			}
			else
				return false;
		}
		else
		{
			return response(['message'=>'not found service'],404);
		}
	}
	public function delete($filial_id,$id)
	{
		if (!$this->one($filial_id,$id)) {
			return response(['message'=>'not found service'],404);
		}
		$status = $this->one($id)->status == 'active'?'inactive':'active';

		$upd = Services::where(['filial_id'=>$filial_id])->destroy($id);
		if ($upd) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function setStatus($filial_id,$id)
	{
		if (!$this->one($filial_id,$id)) {
			return 'not_found_service';
		}
		$status = $this->one($filial_id,$id)->status == 'active'?'inactive':'active';
		Services::where(['filial_id'=>$filial_id,'id'=>$id])->update([
		    'status'=>$status
        ]);
		return  true;
	}
}
