<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model{
  protected $touches = ['division'];

  protected $fillable = [
    'name',
    'membership',
    'address',
    'state',
  ];

  public static $gender = [
    'M' => 'Male',
    'F' => 'Female',
  ];

  protected $table = 'Customers';//database table name

  //One To Many
  public function division(){
    return $this->belongsTo(Division::class);
  }

  public function customers(){
    return $this->hasMany(Customer::class);
  }

  //Many to Many
  public function divisions(){
    return $this->belongsToMany(Division::class);
  }

  public function customers(){
    return $this->belongsToMany(Customer::class);
  }

  //Does not follow naming convention
  public function customers(){
    return $this->belongsToMany(Customer::class, 'division_customer_rel');
  }

  //REACT
  public function getStateNameAttribute(){
    return Common::$states[$this->state];
  }

  protected $appends = [
    'state_name',
  ];
}
