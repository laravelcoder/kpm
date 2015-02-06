<?php namespace Stevemo\Cpanel\Controllers;

class StorageController extends BaseController {
	/**
	 * ajax upload file
	 */
	public function upload()
	{
		// if not ajax request then trigger error
		if (!\Request::ajax()) {
			return \App::abort(404);
		}

		// get all files
		$files = \Input::file();

		// upload files
		foreach ($files as $file) {
			if ($file->error != 0) {
				continue;
			}

			// TODO: class for upload files, do thumbs, return pathes
			// saving example
			// $this->storage->save($file);

			// name $file->getClientOriginalName();
			// extension $file->getClientOriginalExtension();
			// $file->getMimeType();
			// path('public') . 'uploads/' - dir
		}
	}
}
