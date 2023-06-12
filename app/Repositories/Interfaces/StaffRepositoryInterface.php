<?php

namespace App\Repositories\Interfaces;

interface StaffRepositoryInterface{
    public function all($filial_id);
    public function one($filial_id,$id);
    public function add($filial_id,$data);
    public function update($filial_id,$id,$data);
}
