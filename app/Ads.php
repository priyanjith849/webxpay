<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description'
    ];


    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function subscriptionPlan(){
        return $this->belongsTo('App\SubscriptionPlan', 'subscription_plan_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
