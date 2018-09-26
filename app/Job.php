<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'name', 'type', 'start', 'end', 'description'];

    protected $dates = ['deleted_at'];

    public function user()
   {
       return $this->belongsTo(User::class);
   }

   public function task()
  {
      return $this->belongsTo(Task::class);
  }
}
