<?php 

namespace App\Repositories\Interfaces;

interface FilialRepositoryInterface{
	public function all();
	public function show($id);
	public function store($data);
	public function update($id,$data);
	public function delete($id);
}