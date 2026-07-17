<?php
namespace App\Models;

use CodeIgniter\Model;

class FiliereModel extends Model
{
    protected $table = 'filliere';
    protected $primaryKey = 'id_filliere';
    protected $returnType = 'array';
    protected $useSoftDelete = false;
    protected $useTimeStamp = false;

    protected $allowedFields = [
        'nom_filliere',
        'code_filliere',
    ];

    protected $validationRules = [
        'nom_filliere' => 'required|min_lenth[2]|max_length[150]',
        'code_filliere' => 'required|min_length[2]|max_length[8]',
    ];
}