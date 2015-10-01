<?php namespace Davzie\LaravelBootstrap\Accounts;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Roles\Roles;

class UserRepository extends EloquentBaseRepository implements UserInterface
{

    /**
     * Construct Shit
     * @param User $user
     */
    public function __construct( User $user )
    {
        $this->model = $user;
    }

    /**
     * reload logged user permissions
     */
    public static function reloadPermssions($user_id)
    {
        // init
        $roles = [];
        $perms = [];
        // get user roles
        $roles = UsersHasRoles::where('user_id', '=', $user_id)->lists('role_id');

        if (empty($roles)) {
            return false;
        }

        $roles = Roles::whereIn('id', $roles)->get();

        foreach ($roles as $role) {
            $p = json_decode($role->permissions, true);
            if (empty($perms)) {
                $perms = $p;
                continue;
            }

            foreach ($perms as $key => $module) {
                foreach ($module['rules'] as $rk => $rule) {
                    if ($p[$key][$rk]) {
                        $perms[$key][$rk] = $p[$key][$rk];
                    }
                }
            }
        }

        $perms = json_encode($perms);
        \Session::put('perms', $perms);

    }

    /**
     * get roles
     */
    public function getRoles()
    {
        $data = [];
        $roles =  Roles::all();

        foreach ($roles as $role) {
            $data[$role->id] = $role->name;
        }

        return $data;
    }

    /**
     * save user roles
     */
    public function saveItems(array $roles, $id)
    {
        foreach ($roles as $role) {
            $uhr = new UsersHasRoles;
            $uhr->role_id = $role;
            $uhr->user_id = $id;
            $uhr->save();
        }

        if (!\Auth::guest()) {
            self::reloadPermssions(\Auth::user()->id);
        }
    }

    /**
     * update user roles
     */
    public function updateItems($roles, $id)
    {
        UsersHasRoles::where('user_id', '=', $id)->delete();
        $this->saveItems($roles, $id);
    }

    /**
     *
     */
    public function setUserPasswordModel()
    {
        $this->model = new UserPassword;
    }

    /**
     *
     */
    public function getByEmail($email)
    {
        return $this->model->where('email', $email)->where('is_active', 1)->first();
    }

}