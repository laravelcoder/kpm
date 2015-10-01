<?php namespace Davzie\LaravelBootstrap\Langs;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Langs\Langs;

class LangsRepository extends EloquentBaseRepository implements LangsInterface
{

    /**
     * Construct Shit
     * @param Langs $model
     */
    public function __construct(Langs $model)
    {
        $this->model = $model;
    }

    /**
     * get default lang code
     */
    public function defaultCode()
    {
    	if (!$lang = $this->model->where('is_default', '=', 1)->first()) {
    		return false;
    	}

    	return $lang->code;
    }

    /**
     * get all langs
     */
    public function getAll()
    {
    	return $this->model->where('is_base', '=', 0)->paginate();
    }

    /**
     * get active langs
     */
    public function getActive()
    {
        return $this->model->where('is_base', '=', 0)->where('is_active', 1)->get();
    }

    /**
     * get list without pagination
     */
    public function getList()
    {
    	return $this->model->where('is_base', '=', 0)->get();
    }

    /**
     * get lang by code
     */
    public function getByCode($lang_code)
    {
    	return $this->model->where('code', '=', $lang_code)->first();
    }

    /**
     * get default lang
     */
    public function defaultLang()
    {
        if (!$lang = $this->model->where('is_default', '=', 1)->first()) {
            return false;
        }

        return $lang;
    }

    /**
     * get hidden lang
     */
    public function getHidden()
    {
        if (!$lang = $this->model->where('is_base', '=', 1)->first()) {
            return false;
        }

        return $lang;
    }

    /**
     * chage default lang to other
     */
    public function changeDefault($lang)
    {
        //
        $this->model->update(array('is_default' => 0));
        $this->model->where('id', $lang->id)->update(['is_default' => 1]);
    }

}