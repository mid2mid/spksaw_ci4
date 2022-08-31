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

		$result = $dataModel->select('data.id_data, data.id_project,data.id_kriteria,data.nama,kriteria.nama as kriteria,data.value')->join('kriteria', 'kriteria.id_kriteria = data.id_kriteria')->orderBy('data.nama', 'asc')->where(['data.id_project' => $id_project])->findAll();
		// $result = $dataModel->select('data.id_data, data.id_project,data.id_kriteria,data.nama,kriteria.nama as kriteria,data.value')->join('kriteria', 'kriteria.id_kriteria = data.id_kriteria')->orderBy('data.id_kriteria', 'asc')->where(['data.id_project' => $id_project])->findAll();
		// d($result);
		$data['data'] = $result;
		$kriteria = $kriteriaModel->select('')->where(['id_project' => $id_project])->findAll();
		$db = [
			'kriteria' => $result,
			'data' => [],
		];
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
					array_push($response['data'], ['nama' => $v['nama'], 'unik' => str_replace(' ', '_', $v['nama']), 'kriteria' => []]);
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
			'analisis' => [],
			'normalisasi' => [],
			'data' => [],
			'bobot' => [],
			'max' => [],
			'min' => [],
			'ranking' => [],
			'kriteria' => [],
		];
		d($data);
		$dum = [];
		foreach ($data['kriteria'] as $i => $v) {
			$dum += [$v['nama'] => []];
			$dummy['bobot'] += [$v['nama'] => number_format($v['bobot'] / array_sum(array_column($data['kriteria'], 'bobot')), '2', '.')];
			// array_push($dummy['kriteria'], $v);
			// $dummy['kriteria'][$i] += ['persen' => number_format($v['bobot'] / array_sum(array_column($data['kriteria'], 'bobot')), '2', '.')];
			foreach ($response['data'] as $i2 => $v2) {
				$dum[$v['nama']] += [$v2['unik'] => $v2['kriteria'][$v['id_kriteria']]];
				// array_push($kt[$v['nama']], $v2['kriteria'][$v['id_kriteria']]);
			}
		}
		// d(array_sum($dummy['bobot']));
		$dummy['analisis'] = $dum;
		// $dummy['normalisasi'] = $dum;
		$dum = [];
		foreach ($data['data'] as $i => $v) {
			$a = str_replace(' ', '_', $v['nama']);
			if (!in_array($a, $dum)) {
				array_push($dum, $a);
			}
		}
		$dummy['data'] = $dum;
		foreach ($dummy['analisis'] as $i => $v) {
			$dummy['max'][$i] = max($v);
			$dummy['min'][$i] = min($v);
		}
		foreach ($dummy['analisis'] as $i => $v) {
			foreach ($v as $i2 => $v2) {
				$dummy['normalisasi']['max'][$i][$i2] = $v2 / $dummy['max'][$i];
				$dummy['normalisasi']['min'][$i][$i2] = $dummy['min'][$i] / $v2;
			}
		}
		foreach ($dummy['data'] as $i => $v) {
			// foreach ($dummy['normalisasi']['max'] as $i2 => $v2) {

			// }
			// d(array_column($dummy['normalisasi']['max'], array_shift(array_keys($dummy['normalisasi']['max']))));
			$n = array_column_ext($dummy['normalisasi']['max'], $v, -1);
			$r = 0;
			foreach ($n as $i2 => $v2) {
				$r += $dummy['normalisasi']['max'][$i2][$v] * $dummy['bobot'][$i2];
				// $r 
				// $dummy['ranking'] += 
			}
			array_push($dummy['ranking'], ['nama' => $v, 'skor' => $r]);
		}
		$price = array_column($dummy['ranking'], 'skor');

		array_multisort($price, SORT_DESC, $dummy['ranking']);
		dd($dummy);




		$c = [];
		// foreach($data['kriteria'] as $i => $v){
		// 	if($v['bobot'] == 'benefit'){
		// 		$x = $data['kriteria']
		// 	} 
		// }
		// d($kt);
		// d(array_sum($kt['harga']));
		// d($data);
		// dd($response);



		$data['project'] = $result;
		$data['kriteria'] = $kriteriaModel->where(['id_project' => $id_project])->findAll();
		dd($data);
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
