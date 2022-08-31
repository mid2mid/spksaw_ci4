<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use \App\Models\ProjectModel;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

// use CodeIgniter\HTTP\IncomingRequest;

class ProjectController extends BaseController
{
	use ResponseTrait;

	public function __construct()
	{
		// header('Access-Control-Request-Headers: Content-Type, x-requested-with');
		// header('Content-Type: application/json;');
	}

	public function show()
	{
		$projectModel = new ProjectModel();
		$result = $projectModel->select('nama,id_project,deskripsi,metode')->findAll();
		return !empty($result) ?  $this->setResponseFormat('json')->respond(['status' => true, 'data' => $result], 200) : $this->setResponseFormat('json')->respond(['status' => true, 'data' => []], 200);
	}

	public function store()
	{
		if (!$this->request->isAJAX()) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi Input'], 400);
		if (!$this->validate([
			'nama' => 'required|alpha_numeric_space|max_length[100]',
			'deskripsi' => 'required|alpha_numeric_space|max_length[255]',
			'metode' => 'required|alpha',
		])) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi Input'], 400);
		// ])) return $this->setResponseFormat('json')->respond($this->validator->getErrors(), 400);
		$projectModel = new ProjectModel();
		$data = [
			'nama' => preg_replace('/\s\s+/', ' ', trim($this->request->getJsonVar('nama'))),
			'deskripsi' => preg_replace('/\s\s+/', ' ', trim($this->request->getJsonVar('deskripsi'))),
			'metode' => $this->request->getJsonVar('metode'),
		];
		if (!in_array($data['metode'], array_column(APP_METODE, 'singkatan'))) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi Input'], 400);
		try {
			$result = $projectModel->select('nama')->where('nama', $data['nama'])->findAll();
			if (!empty($result)) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'project sudah ada'], 409);
			$result = $projectModel->insert($data);
			return is_int($result) ? $this->setResponseFormat('json')->respond(['status' => true, 'pesan' => 'project baru telah di tambahkan', 'id_project' => $result], 201) : $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi Input'], 400);
		} catch (Exception $e) {
			return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'internal server error'], 500);
		}
	}

	public function update()
	{
		if (!$this->request->isAJAX()) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi Input 1'], 400);
		if (!$this->validate([
			'id_project' => 'required|is_natural_no_zero',
			'nama' => 'required|alpha_numeric_space|max_length[100]',
			'deskripsi' => 'required|alpha_numeric_space|max_length[255]',
			// ])) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi Input 2'], 400);
		])) return $this->setResponseFormat('json')->respond($this->validator->getErrors(), 400);
		$projectModel = new ProjectModel();
		$id_project = $this->request->getJsonVar('id_project');
		$data = [
			'nama' => preg_replace('/\s\s+/', ' ', trim($this->request->getJsonVar('nama'))),
			'deskripsi' => preg_replace('/\s\s+/', ' ', trim($this->request->getJsonVar('deskripsi'))),
		];
		$result = $projectModel->select('nama,deskripsi')->where('id_project', $id_project)->findAll();
		if (empty($result)) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'invalid data 3'], 404);
		$data = array_diff_assoc($data, $result[0]);
		if (empty($data)) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'tidak ada perubahan'], 400);
		if (isset($data['nama'])) {
			if (!empty($projectModel->select('nama')->where('nama', $data['nama'])->first())) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'project sudah ada'], 409);
		}
		$result = $projectModel->update($id_project, $data);
		// return  $this->setResponseFormat('json')->respond(['status' => true, 'pesan' => 'berhasil mengubah project', 'id_project' => $result], 200);
		return $result ? $this->setResponseFormat('json')->respond(['status' => true, 'pesan' => 'berhasil mengubah project'], 200) : $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi Input'], 400);
		// $result = $projectModel->where('id_project', $id_project)->set($data)->update();
	}

	public function destroy()
	{

		if (!$this->request->isAJAX()) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi Input 1'], 400);
		if (!$this->validate([
			'id_project' => 'required|is_natural_no_zero',
			'nama' => 'required|alpha_numeric_space|max_length[100]',
		])) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi Input 2'], 400);
		// ])) return $this->setResponseFormat('json')->respond($this->validator->getErrors(), 400);
		$projectModel = new ProjectModel();
		$id_project = $this->request->getJsonVar('id_project');
		$data = [
			'nama' => preg_replace('/\s\s+/', ' ', trim($this->request->getJsonVar('nama'))),
		];
		$result = $projectModel->select('nama,deskripsi')->where('id_project', $id_project)->where('nama', $data['nama'])->first();
		if (empty($result)) return $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'invalid data 3'], 404);
		$result = $projectModel->delete($id_project);
		// return  $this->setResponseFormat('json')->respond(['status' => true, 'pesan' => 'berhasil mengubah project', 'id_project' => $result], 200);
		return $result ? $this->setResponseFormat('json')->respond(['status' => true, 'pesan' => 'berhasil menghapus project'], 200) : $this->setResponseFormat('json')->respond(['status' => false, 'pesan' => 'Gagal Validasi Input'], 400);
		// $result = $projectModel->where('id_project', $id_project)->set($data)->update();
	}
}
