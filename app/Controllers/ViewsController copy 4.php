<?php

namespace App\Controllers;

use \App\Models\KriteriaModel;
use \App\Models\DataModel;
use \App\Models\ProjectModel;

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
		];
		return view('kriteria', $data);
	}

	public function data()
	{
		// if (!$this->validate([
		// 	'project' => 'required|is_natural_no_zero',
		// ])) return redirect()->route('view_project');

		$kriteriaModel = new KriteriaModel();
		$data = [
			'page' => "data",
			'id_project' => '2',
			// 'id_project' => $this->request->getGet('project'),
			'kriteria' => $kriteriaModel->select('nama,id_kriteria')->findAll(),
			'data' => [
				[

					'id_data' => '1',
					'nama' => 'aaaaaaaaaaaa',
					'kriteria' => [
						'harga' => '1000',
						'jumlah' => '1',
					],
				],
				[
					'id_data' => '2',
					'nama' => 'bbbbbbbbbbbb',
					'kriteria' => [
						'harga' => '2000',
						'jumlah' => '2',
					],
				],
				[
					'id_data' => '3',
					'nama' => 'cccccccccccccc',
					'kriteria' => [
						'harga' => '3000',
						'jumlah' => '3',
					],
				],
			]
		];

		return view('data', $data);
	}

	public function hasil()
	{
		if (!$this->validate([
			'project' => 'required|is_natural_no_zero',
		])) {
			dd('gagal');
		}


		$projectModel = new ProjectModel();
		$dataModel = new DataModel();
		$kriteriaModel = new KriteriaModel();

		$id_project = $this->request->getGet('project');
		$result = $projectModel->where('id_project', $id_project)->first();
		if (empty($result)) {
			dd('no project');
		}

		// d(max(array_map('intval', array_column($kriteria, 'bobot'))));
		// d(min(array_map('intval', array_column($kriteria, 'bobot'))));
		// d(array_sum(array_map('intval', array_column($kriteria, 'bobot'))));
		// dd(array_map('intval', array_column($kriteria, 'bobot')));
		function array_column_ext($array, $columnkey, $indexkey = null)
		{
			$result = array();
			foreach ($array as $subarray => $value) {
				if (array_key_exists($columnkey, $value)) {
					$val = $array[$subarray][$columnkey];
				} else if ($columnkey === null) {
					$val = $value;
				} else {
					continue;
				}

				if ($indexkey === null) {
					$result[] = $val;
				} elseif ($indexkey == -1 || array_key_exists($indexkey, $value)) {
					$result[($indexkey == -1) ? $subarray : $array[$subarray][$indexkey]] = $val;
				}
			}
			return $result;
		}

		$db = [
			'kriteria' => [],
			'data' => [],
			'response' => []
		];

		$db['data'] = $dataModel->select('data.id_data, data.id_project,data.id_kriteria,data.nama,kriteria.nama as kriteria,data.value')->join('kriteria', 'kriteria.id_kriteria = data.id_kriteria')->orderBy('data.nama', 'asc')->where(['data.id_project' => $id_project])->findAll();
		$db['kriteria'] = $kriteriaModel->select('')->where(['id_project' => $id_project])->findAll();
		if (empty($db['data']) || empty($db['kriteria'])) return dd('kosong');

		$kriteria = array_column($db['kriteria'], 'id_kriteria');

		$response = [];
		$dummy = '';
		foreach ($db['data'] as $i => $v) {
			if ($dummy == $v['nama']) {
				$index = key(array_slice($response, -1, 1, true));
				$response[$index]['kriteria'] +=  [$v['id_kriteria'] => $v['value']];
			} else {
				array_push($response, ['nama' => $v['nama'], 'unik' => str_replace(' ', '_', $v['nama']), 'kriteria' => []]);
				$index = key(array_slice($response, -1, 1, true));
				$response[$index]['kriteria'] +=  [$v['id_kriteria'] => $v['value']];
			}
			$dummy = $v['nama'];
		}
		foreach ($response as $i => $v) {
			foreach ($kriteria as $i2 => $v2) {
				if (!isset($v['kriteria'][$v2])) {
					$response[$i]['kriteria'] +=  [$v2 => null];
					dd('data null');
					// array_push($response['data'][$i]['kriteria'], ['gagal' => null]);
				}
			}
		}
		// d($db);
		// d($response);
		// dd($kriteria);


		$dummy = [
			'analisa' => [],
			'normalisasi' => [],
			'data' => [],
			'bobot' => [],
			'max' => [],
			'min' => [],
			'ranking' => [],
			'kriteria' => [],
		];

		// SET KRITERIA
		$kriteria = [];
		foreach ($db['kriteria'] as $i => $v) {
			$n =  str_replace(' ', '_', $v['nama']);
			$kriteria += [$n => []];
			$kriteria[$n] += ['bobot' => $v['bobot']];
			$kriteria[$n] += ['atribut' => $v['atribut']];

			$dummy['bobot'] += [$v['nama'] => intval($v['bobot'])];
		}
		// SET DATA
		// $data = [];
		// foreach ($db['data'] as $i => $v) {
		// 	$n =  str_replace(' ', '_', $v['nama']);
		// 	$kriteria += [$n => []];
		// 	$kriteria[$n] += ['bobot' => $v['bobot']];
		// 	$kriteria[$n] += ['atribut' => $v['atribut']];
		// }

		// ANALISIS
		foreach ($db['data'] as $i => $v) {
			$r = str_replace(' ', '_', $v['nama']);
			if (!isset($dummy['analisa'][$v['kriteria']])) $dummy['analisa'] += [$v['kriteria'] => []];
			$dummy['analisa'][str_replace(' ', '_', $v['kriteria'])] += [$r => $v['value']];

			if (!in_array($v['nama'], $dummy['data'])) {
				array_push($dummy['data'], $v['nama']);
			}
		}
		// $dummy['analisa'] = $db['response'];

		// NORMALISASI
		foreach ($dummy['analisa'] as $i => $v) {
		}
		foreach ($dummy['analisa'] as $i => $v) {
			$dummy['max'][$i] = max($v);
			$dummy['min'][$i] = min($v);
			foreach ($v as $i2 => $v2) {
				if ($kriteria[$i]['atribut'] === 'benefit') {
					$dummy['normalisasi'][$i][$i2] = doubleval(number_format($v2 / $dummy['max'][$i], '4'));
				} else {
					$dummy['normalisasi'][$i][$i2] = doubleval(number_format($dummy['min'][$i] / $v2, '4'));
				}
			}
		}

		foreach ($dummy['data'] as $i => $v) {
			$unik = str_replace(' ', '_', $v);
			$ac = array_column($dummy['normalisasi'], $unik);
			$hasil = 0;
			foreach ($dummy['normalisasi'] as $i2 => $v2) {
				$hasil += $dummy['normalisasi'][$i2][$unik] * ($dummy['bobot'][$i2] / 100);
			}
			array_push($dummy['ranking'], ['nama' => $v, 'skor' => $hasil]);
		}
		array_multisort(array_column($dummy['ranking'], 'skor'), SORT_DESC, $dummy['ranking']);

		d($kriteria);
		d($db);
		dd($dummy);
		$data = [
			'page' => "hasil",
			'id_project' => '1',
		];

		return view('hasil', $data);
	}

	public function hasil1()
	{
		if (!$this->validate([
			'project' => 'required|is_natural_no_zero',
		])) {
			dd('gagal');
		}
		$projectModel = new ProjectModel();
		$dataModel = new DataModel();
		$kriteriaModel = new KriteriaModel();
		$data = [
			'project' => [],
			'kriteria' => [],
			'data' => [],
		];
		$id_project = $this->request->getGet('project');
		$result = $projectModel->where('id_project', $id_project)->first();
		if (empty($result)) {
			dd('no project');
		}

		// d(max(array_map('intval', array_column($kriteria, 'bobot'))));
		// d(min(array_map('intval', array_column($kriteria, 'bobot'))));
		// d(array_sum(array_map('intval', array_column($kriteria, 'bobot'))));
		// dd(array_map('intval', array_column($kriteria, 'bobot')));


		$result = $dataModel->select('data.id_data, data.id_project,data.id_kriteria,data.nama,kriteria.nama as kriteria,data.value')->join('kriteria', 'kriteria.id_kriteria = data.id_kriteria')->orderBy('data.nama', 'asc')->where(['data.id_project' => $id_project])->findAll();
		// $result = $dataModel->select('data.id_data, data.id_project,data.id_kriteria,data.nama,kriteria.nama as kriteria,data.value')->join('kriteria', 'kriteria.id_kriteria = data.id_kriteria')->orderBy('data.id_kriteria', 'asc')->where(['data.id_project' => $id_project])->findAll();
		d($result);
		$kriteria = $kriteriaModel->select('')->where(['id_project' => $id_project])->findAll();
		$data['kriteria'] = $kriteria;
		$kriteria = array_column($kriteria, 'id_kriteria');
		$response = ['status' => true, 'pesan' => 'berhasil menagambil data', 'data' => []];
		$realKriteria = [];
		if (!empty($result)) {
			$dummy = '';
			foreach ($result as $i => $v) {
				if ($dummy == $v['nama']) {
					$index = key(array_slice($response['data'], -1, 1, true));
					$response['data'][$index]['kriteria'] +=  [$v['id_kriteria'] => $v['value']];
				} else {
					array_push($response['data'], ['nama' => $v['nama'], 'unik' => str_replace(' ', '-', $v['nama']), 'kriteria' => []]);
					$index = key(array_slice($response['data'], -1, 1, true));
					$response['data'][$index]['kriteria'] +=  [$v['id_kriteria'] => $v['value']];
				}
				$dummy = $v['nama'];
			}
		}
		foreach ($response['data'] as $i => $v) {
			foreach ($kriteria as $i2 => $v2) {
				if (!isset($v['kriteria'][$v2])) {
					// dd('null');
					$response['data'][$i]['kriteria'] +=  [$v2 => null];
				}
			}
		}
		foreach ($data['kriteria'] as $i => $v) {
		}
		$dummy = [
			'normalisasi' => [],
			'data' => [],
		];
		$kt = [];
		foreach ($data['kriteria'] as $i => $v) {
			$kt += [$v['nama'] => []];
			foreach ($response['data'] as $i2 => $v2) {
				$dummy['normalisasi'][$v['nama']] += [$v2['unik'] => $v2['kriteria'][$v['id_kriteria']]];
				// array_push($kt[$v['nama']], $v2['kriteria'][$v['id_kriteria']]);
			}
		}
		dd($dummy);
		$c = [];
		// foreach($data['kriteria'] as $i => $v){
		// 	if($v['bobot'] == 'benefit'){
		// 		$x = $data['kriteria']
		// 	}
		// }
		d($kt);
		d(array_sum($kt['harga']));
		d($data);
		dd($response);



		$data['project'] = $result;
		$data['kriteria'] = $kriteriaModel->where(['id_project' => $id_project])->findAll();
		dd($data);
		$data = [
			'page' => "hasil",
			'id_project' => '1',
		];

		return view('hasil', $data);
	}
}
