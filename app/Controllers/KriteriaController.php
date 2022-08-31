<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use \App\Models\KriteriaModel;
use \CodeIgniter\HTTP\ResponseInterface;

class KriteriaController extends BaseController
{
	use ResponseTrait;

	public function __construct()
	{
		// header('Access-Control-Request-Headers: Content-Type, x-requested-with');
		// header('Content-Type: application/json;');
	}

	public function show()
	{
		if (!$this->request->isAJAX()) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi Input'], 400);
		$project = $this->validate(['project' => 'is_natural_no_zero']) ? $this->request->getGet('project') : false;
		$kriteriaModel = new KriteriaModel();
		$result = $kriteriaModel->select('id_kriteria, nama,deskripsi,atribut, bobot')->where('id_project', $project)->findAll();
		return $result ? $this->setResponseFormat('json')->respond(['status' => true, 'pesan' => 'berhasil mengambil kriteria', 'kriteria' => $result], 200) : $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Mengambil Kriteria'], 400);
	}

	public function store()
	{
		if (!$this->request->isAJAX()) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Bad Request'], 400);
		if (!$this->validate([
			'id_project' => 'required|is_natural_no_zero',
			'nama' => 'required|alpha_numeric_space|max_length[100]',
			'deskripsi' => 'required|alpha_numeric_space|max_length[255]',
			'bobot' => 'required|is_natural_no_zero|less_than[101]',
			'atribut' => 'required|alpha',
		])) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi !'], 400);
		// ])) return $this->setResponseFormat('json')->respond($this->validator->getErrors(), 400);
		$kriteriaModel = new KriteriaModel();
		$data = [
			'id_project' => $this->request->getJsonVar('id_project'),
			'nama' => preg_replace('/\s\s+/', ' ', trim($this->request->getJsonVar('nama'))),
			'deskripsi' => preg_replace('/\s\s+/', ' ', trim($this->request->getJsonVar('deskripsi'))),
			'bobot' => $this->request->getJsonVar('bobot'),
			'atribut' => $this->request->getJsonVar('atribut'),
		];
		$result = $kriteriaModel->where(['id_project' => $data['id_project'], 'nama' => $data['nama']])->findAll();
		if (!empty($result)) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'kriteria sudah ada'], 409);
		$result = $kriteriaModel->insert($data);
		return !empty($result) && is_int($result) ? $this->setResponseFormat('json')->respond(['status' => true, 'pesan' => 'kriteria baru telah di tambahkan', 'id_kriteria' => $result], 201) : $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Bad Request'], 400);
	}

	public function update()
	{
		if (!$this->request->isAJAX()) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Bad Request'], 400);
		if (!$this->validate([
			'id_project' => 'required|is_natural_no_zero',
			'id_kriteria' => 'required|is_natural_no_zero',
			'nama' => 'required|alpha_numeric_space|max_length[100]',
			'deskripsi' => 'required|alpha_numeric_space|max_length[255]',
			'bobot' => 'required|is_natural_no_zero|less_than[101]',
			'atribut' => 'required|alpha',
		])) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi !'], 400);
		$kriteriaModel = new KriteriaModel();
		$id_kriteria = $this->request->getJsonVar('id_kriteria');
		$id_project = $this->request->getJsonVar('id_project');
		// dd($this->request->getJSON(true));
		$data = [
			'nama' => preg_replace('/\s\s+/', ' ', trim($this->request->getJsonVar('nama'))),
			'deskripsi' => preg_replace('/\s\s+/', ' ', trim($this->request->getJsonVar('deskripsi'))),
			'bobot' => $this->request->getJsonVar('bobot'),
			'atribut' => preg_replace('/\s\s+/', ' ', trim($this->request->getJsonVar('atribut'))),
		];
		$result = $kriteriaModel->select('nama,deskripsi,atribut,bobot')->where(['id_kriteria' => $id_kriteria, 'id_project' => $id_project])->first();
		if (empty($result)) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Bad Request'], 400);
		$data = array_diff_assoc($data, $result);
		if (empty($data)) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'tidak ada perubahan'], 400);
		if (isset($data['nama'])) {
			$result = $kriteriaModel->select('nama,deskripsi,atribut,bobot')->where('id_project', $id_project)->where('nama', $data['nama'])->first();
			if (!empty($result)) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'kriteria sudah ada'], 409);
		}
		$result = $kriteriaModel->update($id_kriteria, $data);
		return $result ? $this->setResponseFormat('json')->respond(['status' => true, 'pesan' => 'berhasil mengubah kriteria'], 200) : $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Bad Request'], 400);
	}

	public function destroy()
	{

		if (!$this->request->isAJAX()) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'gagal menghapus kriteria'], 400);
		if (!$this->validate([
			'id_project' => 'required|is_natural_no_zero',
			'id_kriteria' => 'required|is_natural_no_zero',
			'nama' => 'required|alpha_numeric_space|max_length[100]',
		])) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi Input !'], 400);
		// ])) return $this->setResponseFormat('json')->respond($this->validator->getErrors(), 400);
		$kriteriaModel = new KriteriaModel();
		$data = [
			'id_project' => $this->request->getJsonVar('id_project'),
			'id_kriteria' => $this->request->getJsonVar('id_kriteria'),
			'nama' => preg_replace('/\s\s+/', ' ', trim($this->request->getJsonVar('nama'))),
		];
		$result = $kriteriaModel->where($data)->findAll();
		if (empty($result)) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'gagal menghapus kriteria'], 400);
		$result = $kriteriaModel->delete($data['id_kriteria']);
		return $result ? $this->setResponseFormat('json')->respond(['status' => true, 'pesan' => 'berhasil menghapus project'], 200) : $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'gagal menghapus kriteria'], 400);
		// $result = $projectModel->where('id_project', $id_project)->set($data)->update();
	}
}
