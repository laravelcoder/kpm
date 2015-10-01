<?php namespace Davzie\LaravelBootstrap\PollsAnswers;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\PollsAnswers\PollsAnswers;
use Davzie\LaravelBootstrap\Polls\Polls;

class PollsAnswersRepository extends EloquentBaseRepository implements PollsAnswersInterface
{

    /**
     * Construct Shit
     * @param PollsAnswers $model
     */
    public function __construct(PollsAnswers $model)
    {
    	parent::__construct();
        $this->model = $model;
    }

    /**
     * get poll answers by poll_id
     *
     * @param int $poll_id
     */
    public function getAllAnswers($poll_id)
    {
    	$lang       = $this->lang_model->defaultLang();
        $hidden     = $this->lang_model->getHidden();
        $exists_ids = $this->model->where('lang_id', $lang->id)->where('poll_id', $poll_id)->lists('id');

        if (empty($exists_ids)) {
            return $this->model->where('lang_id', $hidden->id)->where('poll_id', $poll_id)->orderBy('id', 'DESC')->groupBy('id')->paginate(\Config::get('app.limit'));
        } else {
            return $this->model->where('lang_id', $lang->id)->where('poll_id', $poll_id)->orWhereNotIn('id', $exists_ids)->where('lang_id', $hidden->id)->orderBy('id', 'DESC')->groupBy('id')->paginate(\Config::get('app.limit'));
        }
    }

    /**
     * get poll by id
     */
    public function getPoll($id)
    {
    	$lang = $this->lang_model->defaultLang();
    	return Polls::where('id', $id)->where('lang_id', $lang->id)->first();
    }

    /**
     * save poll answers order
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

}
