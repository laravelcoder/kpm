<?php

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DavzieModelCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'davzie:model';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create model, model repo and interface in davzie package.';

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
		$this->base_path = base_path() . '/workbench/davzie/laravel-bootstrap/src/Davzie/LaravelBootstrap/';
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//
		$class    = $this->ask('Set class name (in camelcase):');
		$class    = ucfirst($class);
		$files    = $this->getFiles($class);
		$dir_path = $this->base_path . $class;

		$this->key = $class;

		if (!$this->createDir($dir_path)) {
			return false;
		}

		foreach ($files as $key => $file) {
			$content = $this->files->get(__DIR__."/davzie/{$key}.stub");
			$this->writeFile($file, $content);
		}
	}

	/**
	 *
	 */
	protected function formatFile($content)
	{
		$class   = $this->key;
		$table   = preg_replace('/(?<=\\w)(?=[A-Z])/',"_$1", $class);
		$table   = strtolower($table);

		$content = str_replace('{{class}}', $class, $content);
		$content = str_replace('{{table}}', $table, $content);

		return $content;
	}

	/**
	 *
	 */
	protected function getFiles($class)
	{
		return [
			'model'     => "{$this->base_path}{$class}/{$class}.php",
			'interface' => "{$this->base_path}{$class}/{$class}Interface.php",
			'repo'      => "{$this->base_path}{$class}/{$class}Repository.php",
		];
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
