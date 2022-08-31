<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
	protected $table      = 'kriteria';
	protected $primaryKey = 'id_kriteria';

	protected $allowedFields = ['nama', 'deskripsi', 'deskripsi', 'bobot', 'id_project', 'atribut'];

	protected $useTimestamps = true;
}
