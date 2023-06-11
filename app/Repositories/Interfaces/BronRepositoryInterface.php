<?php

namespace App\Repositories\Interfaces;


interface BronRepositoryInterface{
    public function all($filial_id);
    public function one($filial_id,$id);
    public function create($filial_id,$data);
    public function update($filial_id,$id,$data);
    public function delete($filial_id,$id);
}
