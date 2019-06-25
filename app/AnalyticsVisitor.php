<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalyticsVisitor extends Model
{
    //
    protected $connection = 'mysql4';

    public function vPages()
    {

        return $this->hasMany('App\AnalyticsPage',"visitor_id");
    }
}
