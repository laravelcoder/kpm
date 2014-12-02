<?php

namespace Sashko\Blog;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

/**
 *
 */
class SBlogController extends Controller
{
	/**
	 *
	 */
	public function getList()
	{
		return 'bla bla';
	}

	/**
	 *
	 */
	public function getView($slug)
	{
		return 'aaa';
	}
}
