<?php
namespace App\Repositories\Interfaces;


interface ProfileRepositoryInterface{
    public function view($filial_id,$id);
    public function create($filial_id,$data);
    public function update($filial_id,$id,$data);
}
