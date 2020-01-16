<?php

// namespace App\Models;

// use App\Notifications\UserVerifyEmail;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;

// class FirstCompanyUserAuth extends Authenticatable implements MustVerifyEmail
// {
//     use Notifiable;
//     public $incrementing = false;
//     public static function boot()
//     {
//         parent::boot();
//         self::creating(function($model){
//             $model->id = (string)\Illuminate\Support\Str::uuid();
//         });
//     }
//     protected $table = 'first_company_user_auths';
    
//     protected $fillable = [
//         'email'
//      ];
//      protected $hidden = [
//         'remember_token'
//      ];

//     public function sendEmailVerificationNotification()
//     {
//         $this->notify(new UserVerifyEmail);
//     }
// }
