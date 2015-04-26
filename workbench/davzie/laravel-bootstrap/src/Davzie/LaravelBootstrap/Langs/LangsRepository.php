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
     *
     */
    public function getAll()
    {
    	return $this->model->where('is_base', '=', 0)->paginate();
    }

    /**
     *
     */
    public function getList()
    {
    	return $this->model->where('is_base', '=', 0)->get();
    }

    /**
     *
     */
    public function getByCode($lang_code)
    {
    	return $this->model->where('code', '=', $lang_code)->first();
    }

    /**
     *
     */
    public function defaultLang()
    {
        if (!$lang = $this->model->where('is_default', '=', 1)->first()) {
            return false;
        }

        return $lang;
    }

    /**
     *
     */
    public function getHidden()
    {
        if (!$lang = $this->model->where('is_base', '=', 1)->first()) {
            return false;
        }

        return $lang;
    }

}