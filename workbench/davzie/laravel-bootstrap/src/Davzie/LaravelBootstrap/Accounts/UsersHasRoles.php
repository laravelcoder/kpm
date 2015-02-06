<?php namespace Davzie\LaravelBootstrap\Accounts;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;
use Illuminate\Auth\UserInterface as LaravelUserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Hash;

class UsersHasRoles extends EloquentBaseModel
{
    public $timestamps = false;
    // The Tables
    protected $table    = 'users_has_roles';

   /**
    * user
    */
   public function user()
   {
        return $this->belongsTo('Davzie\LaravelBootstrap\Accounts\User', 'user_id', 'id');
   }

   /**
    * role
    */
   public function role()
   {
        return $this->belongsTo('Davzie\LaravelBootstrap\Roles\Roles', 'role_id', 'id');
   }
}