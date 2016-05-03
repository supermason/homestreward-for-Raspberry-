<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchStatisticExceptions extends Model
{
    //
    protected $table = 'match_statistic_exceptions';

    protected $fillable = ['device', 'system_version', 'title', 'content'];
}
