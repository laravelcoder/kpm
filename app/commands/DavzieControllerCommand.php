<?php

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DavzieControllerCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'davzie:controller';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create controller in davzie package.';

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
		$this->base_path = base_path() . '/workbench/davzie/laravel-bootstrap/src/controllers/';
		$this->bindings_file = base_path() . '/workbench/davzie/laravel-bootstrap/src/bindings.php';
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//
		$class     = $this->ask('Set controller name (in camelcase):');
		$class     = ucfirst($class);
		$dir_path  = $this->base_path . $class;
		$this->key = $class;

		$content = $this->files->get(__DIR__."/davzie/controller.stub");
		$file    = $this->base_path . "{$class}Controller.php";
		$this->writeFile($file, $content);

		$this->call('dump-autoload');

		$content = $this->files->get(__DIR__."/davzie/bindings.stub");
		$this->writeBindings($content);
	}

	/**
	 *
	 */
	protected function writeBindings($content)
	{
		$class             = $this->key;
		$bindings_content  = $this->files->get($this->bindings_file);

		$content           = str_replace('{{class}}', $class, $content);
		$bindings_content .= $content;

		$this->files->put($this->bindings_file, $bindings_content);
	}

	/**
	 *
	 */
	protected function formatFile($content)
	{
		$class   = $this->key;
		$view    = strtolower($class);

		$content = str_replace('{{class}}', $class, $content);
		$content = str_replace('{{view}}', $view, $content);

		return $content;
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
