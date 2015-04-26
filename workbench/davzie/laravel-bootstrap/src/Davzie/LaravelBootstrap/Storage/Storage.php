<?php namespace Davzie\LaravelBootstrap\Storage;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;
use Davzie\LaravelBootstrap\Utilities\ImgHelper;
use Config;

class Storage extends EloquentBaseModel
{
    /**
     *
     */
    public $timestamps = false;

    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'storage';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('filename', 'parent_id');

    protected $validationRules = [
        'filename' => 'required'
    ];

    /**
     *
     */
    protected $messages = [
        'filename.required' => 'Поле Назва обовязкове для заповнення',
    ];

    /**
     * Strip the extensions from the filename and just return the filename, we need this to append stuff
     * @param  string $filename The filename to strip
     * @return string
     */
    public function stripExtensions($filename) {
        return preg_replace("/\\.[^.\\s]{3,4}$/", "", $filename);
    }


    /**
     * Size up the current record and return the resulting filename
     * @param  integer  $width  The width of the resulting image
     * @param  integer  $height The height of the resulting image
     * @param  boolean  $crop   Decide whether to crop the image or not
     * @return string           The sized up stored resulting image
     */
    public function sizeImg($width , $height , $crop = true) {
        // Get our image helper, pass in requirements and get our new image filename
        $helper = new ImgHelper($this);
        $helper->width = $width;
        $helper->height = $height;
        $helper->crop = $crop;

        return $helper->get();
    }

    /**
     * Get the usable src (public path and filename)
     * @return string
     */
    public function getSrc() {
        return $this->getPath().$this->filename;
    }

    /**
     * Get the absolute usable src (/var/www/vhosts/domain.com/public/uploads/products/filename.jpg etc)
     * @return string
     */
    public function getAbsoluteSrc() {
        return $this->getAbsolutePath().$this->filename;
    }

    public function getAbsolutePath() {
        $base_path = Config::get('laravel-bootstrap::app.upload_base_path');
        return public_path().'/'.$base_path.$this->path.'/'.$this->uploadable_id.'/';
    }

    public function getPath() {
        $base_path = Config::get('laravel-bootstrap::app.upload_base_path');
        return url($base_path.$this->path.'/'.$this->uploadable_id.'/');
    }

    /**
     *
     */
    public function news()
    {
         return $this->hasMany('Davzie\LaravelBootstrap\News\News', 'photo_storage_id', 'id')->leftJoin('langs', 'langs.id', '=', 'news.lang_id')->where('langs.is_default', '=', 1);
    }

    /**
     *
     */
    public function parent()
    {
         return $this->belongsTo('Davzie\LaravelBootstrap\Storage\Storage', 'parent_id', 'id');
    }

}
