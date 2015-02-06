<?php namespace Davzie\LaravelBootstrap\Accounts;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Universities\UniversitiesHasUsers;
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
     * get university users
     *
     * @param $id university_id
     * @return array
     */
    public function findNoUniversityUsers($id = null)
    {
        //
        return UniversitiesHasUsers::where('university_id', '!=', $id)->paginate(20);
    }

    /**
     *
     */
    public function addUniversityUser($id, $user_id)
    {
        $uhu = new UniversitiesHasUsers;
        $uhu->university_id = $id;
        $uhu->user_id       = $user_id;

        return $uhu->save();
    }

    /**
     *
     */
    public function getUsersList($id)
    {
        $uu = UniversitiesHasUsers::where('university_id', '=', $id)->get();
        $exists_users = [];

        foreach ($uu as $one) {
            $exists_users[] = $one->user_id;
        }

        if (empty($exists_users)) {
            return User::where('is_active', '=', 1)->paginate(10);
        }

        return User::whereNotIn('id', $exists_users)->where('is_active', '=', 1)->paginate(10);
    }

    /**
     * reload permissions
     */
    public static function reloadPermssions($user_id)
    {
        //
        $roles = [];
        $perms = [];
        $usp = UsersHasRoles::where('user_id', '=', $user_id)->get();

        foreach ($usp as $one) {
            $roles[] = $one->role_id;
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
    public function saveItems($roles, $id)
    {
        foreach ($roles as $role) {
            $uhr = new UsersHasRoles;
            $uhr->role_id = $role;
            $uhr->user_id = $id;
            $uhr->save();
        }

        self::reloadPermssions(\Auth::user()->id);
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

}