<?php

namespace App\Repositories\Interfaces;

interface DebtersRepositoryInterface{
    public function all($filial_id,$limit = 20);
    public function one($filail_id,$id);
    public function create($filial_id,$data);
    public function update($filial_id,$data);
    public function delete($filial_id,$id);
}
