<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
abstract class BaseUuid extends Model
{   
    public $incrementing = false;
    public static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->id = (string)\Illuminate\Support\Str::uuid();
        });
    }
}
