<?php

namespace App\Controllers;

class ViewsController extends BaseController
{
	public function index()
	{
		$data = [
			"page" => "home"
		];

		return view('home', $data);
	}

	public function project()
	{
		$data = [
			'page' => "project",
			'project' => [
				[
					'name' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum, rerum!',
					'desc' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Excepturi tempora repellat recusandae, laudantium in vel corporis totam hic dolores sint!',
					'metode' => 'saw',
					'id_project' => '1',
				],
				[
					'name' => 'Lorem ipsum dolor sit,',
					'desc' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit.',
					'metode' => 'saw',
					'id_project' => '2',
				],
			],
			'metode' => APP_METODE,
		];

		return view('project', $data);
	}

	public function kriteria()
	{
		if (!$this->validate([
			'project' => 'required|is_natural_no_zero',
		])) return redirect()->route('view_project');
		// $id = $this->validate(['project' => 'is_natural_no_zero']) ? $this->request->getGet('project') : false;
		$data = [
			'page' => "kriteria",
			'id_project' => $this->request->getGet('project'),
			'kriteria' => [
				[
					'id_kriteria' => '1',
					'nama' => 'harga',
					'atribut' => 'cost',
					'bobot' => '5',
					'keterangan' => 'Lorem ipsum dolor sit amet.',
				],
				[
					'id_kriteria' => '2',
					'nama' => 'jumlah',
					'atribut' => 'benefit',
					'bobot' => '3',
					'keterangan' => 'aaaaaaaaaaaa',
				],
				[
					'id_kriteria' => '3',
					'nama' => 'garansi',
					'atribut' => 'benefit',
					'bobot' => '4',
					'keterangan' => 'bbbbbbbbbb',
				],
			],
		];

		return view('kriteria', $data);
	}

	public function data()
	{
		$data = [
			'page' => "data",
			'id_project' => '1',
			'kriteria' => ['harga', 'jumlah', 'garansi'],
			'data' => [
				[
					'id_data' => '1',
					'nama' => 'aaaaaaaaaaaa',
					'kriteria' => [
						'harga' => '1000',
						'jumlah' => '1',
						'garansi' => '1',
					],
				],
				[
					'id_data' => '2',
					'nama' => 'bbbbbbbbbbbb',
					'kriteria' => [
						'harga' => '2000',
						'jumlah' => '2',
						'garansi' => '2',
					],
				],
				[
					'id_data' => '3',
					'nama' => 'cccccccccccccc',
					'kriteria' => [
						'harga' => '3000',
						'jumlah' => '3',
						'garansi' => '3',
					],
				],
			]
		];

		return view('data', $data);
	}

	public function hasil()
	{
		$data = [
			'page' => "hasil",
			'id_project' => '1',
		];

		return view('hasil', $data);
	}
}
