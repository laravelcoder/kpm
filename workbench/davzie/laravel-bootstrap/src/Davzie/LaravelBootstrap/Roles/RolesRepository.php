<?php namespace Davzie\LaravelBootstrap\Roles;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Roles\RolesHasUsers;
use Davzie\LaravelBootstrap\Access;


class RolesRepository extends EloquentBaseRepository implements RolesInterface
{

    /**
     * Construct Shit
     * @param Roles $roles
     */
    public function __construct(Roles $roles)
    {
        $this->model = $roles;
    }

    /**
     * save permissions
     */
    public function savePerms($id, $post)
    {
    	//
    	$modules = array_keys(Access::get());

    	foreach ($post as $key => $field) {
    		if (!in_array($key, $modules)) {
    			unset($post[$key]);
    		}
    	}

    	$post = json_encode($post);
    	$role = $this->model->find($id);
    	$role->permissions = $post;

    	return $role->save();
    }

}
