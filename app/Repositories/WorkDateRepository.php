<?php

namespace App\Repositories;

use App\Repositories\Interfaces\WorkDateRepositoryIntefece;
use App\Models\WorkDate;

class WorkDateRepository implements WorkDateRepositoryIntefece
{

    public function start($filial_id, $user_id)
    {
        $count = WorkDate::query()
            ->where(['filial_id'=>$filial_id,'user_id'=>$user_id])
            ->whereYear('start',date('Y'))
            ->whereMonth('start',date('m'))
            ->whereDate('start',date('d'))
            ->count();

        if ($count == 0) {
            WorkDate::create([
                'filial_id' => $filial_id,
                'user_id' => $user_id,
                'start' => date('Y-m-d H:i:s'),
                'end' => '',
                'status' => 'worked'
            ]);
            return true;
        }
        else
            return false;
    }
    public function end($filial_id, $user_id)
    {
        $count = WorkDate::query()
            ->where(['filial_id'=>$filial_id,'user_id'=>$user_id])
            ->whereYear('start',date('Y'))
            ->whereMonth('start',date('m'))
            ->whereDate('start',date('d'));
        if ($count->count() == 1)
        {
            $count->update([
                'end'=>date('Y-m-d H:i:s'),
                'status'=>'work_end'
            ]);
            return true;
        }
        else
            return  false;
    }
}
