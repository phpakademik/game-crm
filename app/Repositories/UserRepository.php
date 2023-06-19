<?php


namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements  UserRepositoryInterface
{
    public function find($user_id)
    {
        $user = User::find($user_id);
        if ($user)
            return $user;
        else
            return false;
    }
}
