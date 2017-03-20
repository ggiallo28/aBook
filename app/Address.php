<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model{

    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'address_book';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'surname','number'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The hasMany relation.
     * 
     */
    public function dreams()
    {
        return $this->hasMany('App\Dream');
    }

}
