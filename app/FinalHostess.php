<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class FinalHostess extends Model
{
    protected $table = 'finalhostess';

    protected $guarded = [];

    public function votes()
    {
        return $this->hasMany('App\Vote','final_id');
    }

}