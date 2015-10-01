<?php namespace Davzie\LaravelBootstrap\Storage;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Utilities\ImgHelper;
use Intervention\Image\Image;
use Config, File, Input, Request;

class StorageRepository extends EloquentBaseRepository implements StorageInterface
{

	/**
	 * Get all uploads in order of upload
	 * @return Storage
	 */
	public function getInOrder()
	{
		return $this->orderBy('order','asc')->get();
	}

	/**
	 * Construct Shit
	 * @param Storage $uploads
	 */
	public function __construct(Storage $uploads)
	{
		$this->model = $uploads;
	}

	/**
	 * Set the order of the ID's from 0 to the array length passed in
	 * @param array $ids The Upload IDs
	 */
	public function setOrder($ids) {

		// Don't do anything if nothing is passed in
		if(!$ids)
			return;

		// Set single integer to arrays
		if(!is_array($ids))
			$ids = [ $ids ];

		// Loop through each id and update the database accordingly
		foreach($ids as $order=>$id) {
			$this->model->where('id','=',$id)->update([ 'order'=>$order ]);
		}

		return true;
	}

	/**
	 * Delete an upload by it's database ID
	 * @param  mixed[integer|array]     $id     The database ID
	 * @return boolean                          True if deleted
	 */
	public function deleteById($id) {
		if(!is_array($id))
			$id = array($id);

		// Delete The Items From The File Store
		$this->physicallyDelete($this->model->whereIn('id' , $id)->get());

		// Now delete the items from the database
		$this->model->whereIn('id' , $id)->delete();

		return true;
	}

	/**
	 * Delete an upload by it's type and link ID
	 * @param  integer     $id     The link record ID
	 * @param  integer     $type   The link type
	 * @return boolean             True if deleted
	 */
	public function deleteByIdType($id , $type) {
		// Delete the images directory for these types / links
		$base_path = Config::get('laravel-bootstrap::app.upload_base_path');
		$toDelete  = base_path().'/'.$base_path.$type.'/'.$id;
		File::deleteDirectory($toDelete);

		// Now return the result of deleting all the records that match
		return $this->model->where('path','=',$type)->where('uploadable_id','=',$id)->delete();
	}

	/**
	 * Physically delete all files related to the uploads collection passed in
	 * @return boolean
	 */
	private function physicallyDelete($uploads) {

		// Return false if we have no uploads passed in
		if(!$uploads)
			return false;

		// Loop through each upload object
		foreach($uploads as $upload) {
			// If the original file actually exists that is specified in the DB, then lets delete if
			if(File::isFile($upload->getAbsoluteSrc()))
				File::delete($upload->getAbsoluteSrc());

			// Setup the caching path
			$cache = $upload->getAbsolutePath().'/cached/';

			if(File::isDirectory($cache)) {
				// Loop through each item in the cache for this particular product ID
				foreach(File::files($cache) as $cacheItem) {
					// We want to remove the extension and the . to see if the thing exists
					$filename = $this->model->stripExtensions($upload->filename);

					// If the path we have actually contains the filename we can remove it, given
					// that the path is always a unique SHA1 checksum we shouldn't have any conflicts,
					// but if we did it wouldn't matter beacuse it's just a cache
					if(str_contains($cacheItem , $filename))
						File::delete($cacheItem);
				}
			}
		}

		return true;
	}

	/**
	 * Upload an image to an object type and ID along with key
	 * @param  integer $id   The ID of the object to associate with
	 * @param  string  $type The class name of the model to associate with
	 * @param  string  $key  The key used in the directory heirachy
	 * @return void
	 */
	public function doUpload($key, $dir = '')
	{
		// check if file with $key exists and upload it
		if (!Input::hasFile($key)) {
		    return false;
		}

		$base_path  = Config::get('laravel-bootstrap::app.upload_base_path');
		// Setup some useful variables
		$name       = Input::file($key)->getClientOriginalName();
		$randomKey  = sha1(time() . microtime() . $name);
		$extension  = Input::file($key)->getClientOriginalExtension();
		$filename   = $randomKey.'.'.$extension;
		$size       = Input::file($key)->getSize();
		$mime       = Input::file($key)->getMimeType();

		$sub_dir1   = substr($randomKey, 0, 2);
		$sub_dir2   = substr($randomKey, 2, 2);

		$path       = "/{$base_path}/{$sub_dir1}/{$sub_dir2}";

		// Check if the folder exists on upload, create it if it doesn't
		if(!File::isDirectory(base_path().'/'.$base_path))
		{
			File::makeDirectory(base_path().'/'.$base_path , 0777);
		}

		if(!File::isDirectory(base_path().'/'.$base_path.'/'.$sub_dir1))
		{
			File::makeDirectory(base_path().'/'.$base_path.'/'.$sub_dir1 , 0777);
		}

		if(!File::isDirectory(base_path().'/'.$base_path.'/'.$sub_dir1.'/'.$sub_dir2))
		{
			File::makeDirectory(base_path().'/'.$base_path.'/'.$sub_dir1.'/'.$sub_dir2 , 0777);
		}

		// Move the file and determine if it was succesful or not
		$upload_success = Input::file($key)->move(base_path() . $path , $filename);

		// Do our model insertion activity
		if($upload_success) {


			$data = [
				'parent_id'  => $this->getDirId($dir),
				'filename'   => $name,
				'hashname'   => $filename,
				'type'       => $mime,
				'size'       => $size,
				'time_add'   => time(),
				'is_dir'     => 0,
			];

			/**
			 * create thumbs for image
			 */
			if ($this->isImg($mime)) {
				$this->createThumbs($filename);
			}

			// $img = Image::make(base_path().$this->getPath($filename));
			// $img->resize(100, 100, true , true )->resizeCanvas(100, 100, null , false , 'ffffff' )->save();

			$id = $this->getModel()->insertGetId($data);
			// Insert the data into the uploads model
			return [
				'id' => $id,
				'filename' => $name,
				'path' => $this->getPath($filename)
			];
		}

		return false;
	}

	/**
	 * check is image
	 */
	public function isImg($mime) {
		return strpos($mime, 'image') === 0;
	}

	/**
	 * resize image
	 */
	public function doResize($filename, $w = null, $h = null) {
		$filepath = $this->getPath($filename);

		// make dir for resized image
		$resizepath = base_path() . str_replace($filename, "{$w}x{$h}", $filepath);

		if(!File::isDirectory($resizepath))
		{
			File::makeDirectory($resizepath , 0777);
		}

		// resized filename
		$resizepath .= "/{$filename}";

		// resize and save image
		$img        = Image::make(base_path().$filepath);

		$img->resizeCanvas($w, $h, 'center', false, 'ffffff')->resize($w, $h, true, true)->save($resizepath);
	}

	/**
	 * make full path for file
	 */
	public function getPath($filename) {
		$base_path  = Config::get('laravel-bootstrap::app.upload_base_path');
		$sub_dir1   = substr($filename, 0, 2);
		$sub_dir2   = substr($filename, 2, 2);

		return "/{$base_path}/{$sub_dir1}/{$sub_dir2}/{$filename}";
	}

	/**
	 * get file by id
	 */
	public function getFilepath($id)
	{
		if (!$file = $this->find($id)) {
			return false;
		}

		return $this->getPath($file->hashname);
	}

	/**
	 * get resized image
	 */
	public function getResized($filename, $w, $h) {
		$path = str_replace($filename, "{$w}x{$h}", $this->getPath($filename)) . "/{$filename}";

		if (!is_file(base_path() . $path)) {
			return false;
		}

		return $path;
	}

	/**
	 * get dir Id by path with creation
	 */
	public function getDirId($path, $parent_id = null) {
		//
		$parts = explode('/', $path);

		if (empty($parts)) {
			return null;
		}

		$name  = array_shift($parts);

		if (empty($name)) {
			return null;
		}

		if (!$dir = $this->getDir($name, $parent_id)) {
			$dir_id = $this->createDir($name, $parent_id);
		} else {
			$dir_id = $dir->id;
		}

		if (empty($parts)) {
			return $dir_id;
		} else {
			return $this->getDirId(implode('/', $parts), $dir_id);
		}
	}

	/**
	 * create dir
	 */
	public function createDir($name, $parent_id = null) {

		if (empty($parent_id)) {
			$parent_id = null;
		}

		if ($dir = $this->getDir($name, $parent_id)) {
			return $dir->id;
		}

		//
		$data = [
			'filename'  => $name,
			'is_dir'    => 1,
			'parent_id' => $parent_id,
			'time_add'  => time(),
			'type'      => 'dir',
		];

		return $this->getModel()->insertGetId($data);
	}

	/**
	 * get dir by name and parent
	 */
	public function getDir($name, $parent_id = null)
	{
		return Storage::where('filename', '=', $name)
						->where('parent_id', '=', $parent_id)
						->where('is_dir', '=', 1)
						->first();
	}

	/**
	 * get files and dirs of current dir
	 */
	public function readDir($dir_id = null)
	{
		if (!$dir_id) {
			return Storage::whereNull('parent_id')->orderBy('is_dir', 'DESC')->orderBy('filename')->paginate(20);
		}

		return Storage::where('parent_id', '=', $dir_id)->orderBy('is_dir', 'DESC')->orderBy('filename')->paginate(20);
	}

	/**
	 * get dir path (with parent dirs)
	 */
	public function getDirPath($dir_id = false)
	{
		if ($dir_id == false) {
			return '';
		}

		$dirs = [];

		while ($dir = $this->requireById($dir_id)) {
			$dirs[] = $dir->filename;
			$dir_id = $dir->parent_id;
		}

		return implode('/', array_reverse($dirs));
	}

	/**
	 * create img thumbs
	 */
	public function createThumbs($filename)
	{
		$thumbs = Config::get('app.thumbs');

		foreach ($thumbs as $thumb) {
			list($width, $height) = explode('x', $thumb);

			if (!$width) {
				$width = null;
			}

			if (!$height) {
				$height = null;
			}

			$this->doResize($filename, $width, $height);
		}
	}

	/**
	 * get filename thumbs
	 */
	public function getThumbs($file = null)
	{
		$filename = $file ? $file->hashname : '';
		$thumbs   = Config::get('app.thumbs');
		$result   = [];

		foreach ($thumbs as $thumb) {
			list($width, $height) = explode('x', $thumb);

			$result[$thumb] = '';

			if ($resized = $this->getResized($filename, $width, $height)) {
				$result[$thumb] = 'http://' . Request::server('SERVER_NAME', null) . $this->getResized($filename, $width, $height);
			}
		}

		$result['o'] = $this->getPath($filename);

		return $result;
	}


}
