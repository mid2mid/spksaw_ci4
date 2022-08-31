<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use \App\Models\KriteriaModel;
use \App\Models\DataModel;
use \CodeIgniter\HTTP\ResponseInterface;

class DataController extends BaseController
{
	use ResponseTrait;

	public function show()
	{
		// if (!$this->request->isAJAX()) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'gagal mengambil data'], 400);
		// dd($this->request->getGet('id_project'));
		// if (!$this->validate([
		// 'id_project' => 'required|is_natural_no_zero',
		// ])) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi !'], 400);
		// ])) return $this->setResponseFormat('json')->respond($this->validator->getErrors(), 400);
		// if (!isset($this->request->getGet('id_project')) || !is_int($this->request->getGet('id_project'))) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi !'], 400);
		$dataModel = new DataModel();
		$kriteriaModel = new KriteriaModel();

		$result = $dataModel->select('data.id_data, data.id_project,data.id_kriteria,data.nama,kriteria.nama as kriteria,data.value')->join('kriteria', 'kriteria.id_kriteria = data.id_kriteria')->orderBy('data.nama', 'asc')->where(['data.id_project' => $this->request->getGet('id_project')])->findAll();
		$kriteria = $kriteriaModel->select('id_kriteria')->where(['id_project' => $this->request->getGet('id_project')])->findAll();
		if (empty($kriteria) || empty($result)) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'gagal mengambil data'], 400);
		$kriteria = array_column($kriteria, 'id_kriteria');
		$response = ['status' => true, 'pesan' => 'berhasil menagambil data', 'data' => []];
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
					$response['data'][$i]['kriteria'] +=  [$v2 => null];
				}
			}
		}
		return $this->setResponseFormat('json')->respond($response, 200);
	}

	public function store()
	{
		if (!$this->request->isAJAX()) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Bad Request'], 400);
		if (!$this->validate([
			'id_project' => 'required|is_natural_no_zero',
			'nama' => 'required|alpha_numeric_space|max_length[100]',
			'kriteria.*' => 'required|is_natural_no_zero',
		])) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi !'], 400);
		// ])) return $this->setResponseFormat('json')->respond($this->validator->getErrors(), 400);

		$dataModel = new DataModel();
		$data = [];
		$id_project = $this->request->getJsonVar('id_project');
		$nama = preg_replace('/\s\s+/', ' ', trim($this->request->getJsonVar('nama')));
		foreach ($this->request->getJsonVar('kriteria') as $i => $v) {
			array_push($data, ['id_project' => $id_project, 'id_kriteria' => $i, 'nama' => $nama, 'value' => $v]);
		}
		$result = $dataModel->where(['nama' => $nama, 'id_project' => $id_project])->findAll();
		if (!empty($result)) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'data sudah ada'], 409);
		$result = $dataModel->insertBatch($data);
		return is_int($result) ? $this->setResponseFormat('json')->respond(['status' => true, 'pesan' => 'berhasil menambahkan data baru', 'id_kriteria' => $result], 201) : $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Bad Request'], 400);
	}

	public function update()
	{
		if (!$this->request->isAJAX()) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Bad Request'], 400);
		if (!$this->validate([
			'id_project' => 'required|is_natural_no_zero',
			'old' => 'required|alpha_numeric_space|max_length[100]',
			'nama' => 'required|alpha_numeric_space|max_length[100]',
			'kriteria.*' => 'required|is_natural_no_zero',
			// ])) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi !'], 400);
		])) return $this->setResponseFormat('json')->respond($this->validator->getErrors(), 400);

		$dataModel = new DataModel();
		$kriteriaModel = new KriteriaModel();
		$data = [
			'update' => [],
			'add' => [],
		];
		$dummy = [];
		$id_project = $this->request->getJsonVar('id_project');
		$old = preg_replace('/\s\s+/', ' ', trim($this->request->getJsonVar('old')));
		$nama = preg_replace('/\s\s+/', ' ', trim($this->request->getJsonVar('nama')));

		foreach ($this->request->getJsonVar('kriteria') as $i => $v) {
			array_push($dummy, ['id_project' => $id_project, 'id_kriteria' => $i, 'nama' => $nama, 'value' => $v]);
		}

		$result = $dataModel->select('id_project, id_kriteria, nama,value')->where(['nama' => $old])->findAll();
		$kriteria = $kriteriaModel->select('id_kriteria')->where(['id_project' => $this->request->getJsonVar('id_project')])->findAll();
		if (empty($result) || empty($kriteria)) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Bad Request'], 400);
		if ($nama !== $old) {
			if (!empty($dataModel->where(['nama' => $nama, 'id_project' => $id_project])->findAll())) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'data sudah ada'], 409);
		}
		$kriteria = array_column($kriteria, 'id_kriteria');
		$dummy = array_map('unserialize', array_diff_assoc(array_map('serialize', $dummy), array_map('serialize', $result)));
		if (empty($dummy)) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'tidak ada data update'], 400);
		foreach ($dummy as $i => $v) {
			if (!in_array($v['id_kriteria'], array_column($result, 'id_kriteria'))) {
				array_push($data['add'], $v);
			} else {
				array_push($data['update'], $v);
			}
		}

		$db = \Config\Database::connect();
		$db->transBegin();
		if (!empty($data['update'])) {
			foreach ($data['update'] as $i => $v) {
				$dataModel->where(['id_project' => $v['id_project'], 'id_kriteria' => $v['id_kriteria'], 'nama' => $old])->set(['nama' => $v['nama'], 'value' => $v['value']])->update();
			}
		}
		if (!empty($data['add'])) {
			$dataModel->insertBatch($data['add']);
		}

		if ($db->transStatus() === false) {
			$db->transRollback();
			return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Bad Request'], 400);
		} else {
			$db->transCommit();
			return $this->setResponseFormat('json')->respond(['status' => true, 'pesan' => 'berhasil mengubah data'], 200);
		}
	}

	public function destroy()
	{

		if (!$this->request->isAJAX()) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'gagal menghapus data'], 400);
		if (!$this->validate([
			'id_project' => 'required|is_natural_no_zero',
			'nama' => 'required|alpha_numeric_space|max_length[100]',
		])) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi Input !'], 400);
		// ])) return $this->setResponseFormat('json')->respond($this->validator->getErrors(), 400);
		$dataModel = new DataModel();
		$data = [
			'id_project' => $this->request->getJsonVar('id_project'),
			'nama' => preg_replace('/\s\s+/', ' ', trim($this->request->getJsonVar('nama'))),
		];
		$result = $dataModel->where($data)->findAll();
		if (empty($result)) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'gagal menghapus data'], 400);
		$result = $dataModel->where($data)->delete();
		return $result ? $this->setResponseFormat('json')->respond(['status' => true, 'pesan' => 'berhasil menghapus data'], 200) : $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'gagal menghapus data'], 400);
	}
}
