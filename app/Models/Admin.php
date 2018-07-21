<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes as Soft;

class Admin extends Model
{
    use Soft;
   protected $table='admin';
   protected $dates=['deleted_at'];
   protected $guarded=[];
   protected $dateFormat='U';
   public function getOne($username)
   {
       $user=$this->where('name','=',$username)->first();
       return $user;
   }
}
