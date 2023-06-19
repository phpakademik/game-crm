<?php

namespace App\Repositories\Interfaces;


interface WorkDateRepositoryIntefece{
    public function start($filial_id,$user_id);
    public function end($filial_id,$user_id);
}
