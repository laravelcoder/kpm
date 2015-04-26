<?php

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DavzieViewCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'davzie:view';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create views for controller in davzie package.';

	/**
	 *
	 */
	protected $base_path = null;

	/**
	 *
	 */
	protected $key = '';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->files = new Filesystem;
		$this->base_path = base_path() . '/workbench/davzie/laravel-bootstrap/src/views/';
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//
		$class     = $this->ask('Set view key (in camelcase):');
		$class     = strtolower($class);
		$this->key = $class;
		$dir_path  = $this->base_path . $class;


		if (!$this->createDir($dir_path)) {
			return false;
		}

		$files = $this->getFiles();

		foreach ($files as $file => $key) {
			$content = $this->files->get(__DIR__."/davzie/view.stub");
			$content = str_replace('{{type}}', $key, $content);
			$path = $dir_path . "/{$file}.blade.php";
			$this->writeFile($path, $content);
		}
	}

	/**
	 *
	 */
	protected function formatFile($content)
	{
		$class   = $this->key;
		$view    = strtolower($class);

		$content = str_replace('{{type}}', $class, $content);

		return $content;
	}

	/**
	 *
	 */
	protected function getFiles()
	{
		return array(
			'index' => '',
			'new'   => '-new',
			'edit'  => '-edit',
			'view'  => '',
		);
	}

	/**
	 *
	 */
	protected function createDir($path)
	{
		if (is_dir($path)) {
			$this->error('Dir already exists');
			return false;
		}

		return mkdir($path);
	}

	/**
	 *
	 */
	protected function writeFile($file, $content)
	{
		if (!file_exists($file))
		{
			$this->files->put($file, $this->formatFile($content));

			$this->info("File \"{$file}\" created successfully.");
		}
		else
		{
			$this->error("File \"{$file}\" already exists!");
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			// array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			// array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
