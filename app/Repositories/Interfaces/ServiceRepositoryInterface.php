<?php 

namespace App\Repositories\Interfaces;

interface ServiceRepositoryInterface{
	public function all($filial_id);
	public function one($filial_id,$id);
	public function create($filial_id,$data);
	public function update($id,$filial_id,$data);
	public function delete($filial_id,$id);
	public function setStatus($filial_id,$id);
}