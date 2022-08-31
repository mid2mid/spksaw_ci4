<?php

namespace App\Controllers;

class ProjectsController extends BaseController
{
	public function index()
	{
		$data = [];

		return view('projects', $data);
	}
}
