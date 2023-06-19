<?php

namespace App\Repositories\Interfaces;


interface UserRepositoryInterface{

    /*
     * @return user
     * this function find one user
     */
    public function find($user_id);

}
