<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
	protected $table      = 'data';
	protected $primaryKey = 'id_data';

	protected $allowedFields = ['nama', 'value', 'id_project', 'id_kriteria'];

	public function dataBatch($data, $old)
	{
		// foreach ($data as $i => $v) {
		// 	d($v);
		// 	$this->where(['id_project' => $v['id_project'], 'id_kriteria' => $v['id_kriteria'], 'nama' => $old])->update(['nama' => $v['nama'], 'value' => $v['value']]);
		// }

		$this->db->transBegin();
		foreach ($data as $i => $v) {
			$this->where(['id_project' => $v['id_project'], 'id_kriteria' => $v['id_kriteria'], 'nama' => $old])->set(['nama' => $v['nama'], 'value' => $v['value']])->update();
		}

		if ($this->db->transStatus() === false) {
			$this->db->transRollback();
			return false;
		} else {
			$this->db->transCommit();
			return true;
		}
	}
}
