<?php namespace Davzie\LaravelBootstrap\Menu;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Menu\Menu;
use Davzie\LaravelBootstrap\Departments\Departments;
use Davzie\LaravelBootstrap\Pages\Pages;

class MenuRepository extends EloquentBaseRepository implements MenuInterface
{

    /**
     * Construct Shit
     * @param Menu $model
     */
    public function __construct(Menu $model)
    {
    	parent::__construct();
        $this->model = $model;
    }

    /**
     * get menu items with parent id
     */
    public function getItems($id = null)
    {
    	$lang       = $this->lang_model->defaultLang();
    	$hidden     = $this->lang_model->getHidden();
    	$exists_ids = $this->model->where('lang_id', $lang->id)->where('parent_id', $id)->lists('id');

    	if (empty($exists_ids)) {
	    	return $this->model->where('lang_id', $hidden->id)->where('parent_id', $id)->orderBy('order')->orderBy('id', 'DESC')->groupBy('id')->get();
    	}

    	return $this->model->where('lang_id', $lang->id)->where('parent_id', $id)->orWhere(function ($query) use ($hidden, $exists_ids) {
                $query->where('lang_id', $hidden->lang_id)->whereNotIn('id', $exists_ids);
            })->orderBy('order')->orderBy('id', 'DESC')->orderBy('lang_id', 'DESC')->groupBy('id')->get();
    }

    /**
     *
     */
    public function getMainItems()
    {
    	$lang  = $this->lang_model->defaultLang();

    	return $this->model->where('lang_id', $lang->id)->orderBy('order')->lists('title', 'id');
    }

    /**
     * save menu items order
     */
    public function saveItems($items)
    {
    	if (empty($items)) {
    		return false;
    	}

    	foreach ($items as $order => $id) {
    		$this->model->where('id', $id)->update(['order' => $order]);
    	}
    }

    /**
     * get pages list for add page link as menu item link
     */
    public function getPages()
    {
    	$lang  = $this->lang_model->defaultLang();

    	return Pages::where('lang_id', $lang->id)->where('is_active', 1)->get();
    }

    /**
     *
     */
    public function updateCommon($id, $data)
    {
        return true;
    }

}
