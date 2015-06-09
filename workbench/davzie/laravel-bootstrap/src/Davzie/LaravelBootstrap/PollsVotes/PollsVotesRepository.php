<?php namespace Davzie\LaravelBootstrap\PollsVotes;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\PollsVotes\PollsVotes;
use Davzie\LaravelBootstrap\Polls\Polls;
use Davzie\LaravelBootstrap\PollsAnswers\PollsAnswers;
use App;

class PollsVotesRepository extends EloquentBaseRepository implements PollsVotesInterface
{

    /**
     * Construct Shit
     * @param PollsVotes $model
     */
    public function __construct(PollsVotes $model)
    {
    	parent::__construct();
        $this->model = $model;
    }

    /**
     *
     */
    public function get($answer_id, $ip)
    {
    	return $this->model->where('polls_answer_id', $answer_id)->where('ip', $ip)->first();
    }

    /**
     *
     */
    public function getResults($answer_id)
    {
    	$answes = [];
    	$votes_count = [];
    	$total  = 0;
    	$lang = $this->lang_model->getByCode(App::getLocale());
    	$poll_answer = PollsAnswers::where('lang_id', $lang->id)->where('id', $answer_id)->first();

    	$poll = Polls::where('lang_id', $lang->id)->where('id', $poll_answer->poll_id)->where('is_active', 1)->first();

    	if (!$poll) {
    		return [];
    	}

    	foreach ($poll->activeAnswers as $answer) {
    		$votes_count[$answer->id] = $answer->votes->count();
    		$total += $votes_count[$answer->id];
    	}

    	foreach ($poll->activeAnswers as $answer) {
    		$count = 0;
    		if ($total) {
    			$count = 100*($answer->votes->count()/$total);
    			$count = round($count, 2);
    		}

    		$answes[] = [
    			'title' => $answer->title,
    			'count' => $count,
    		];
    	}

    	return $answes;
    }

}
