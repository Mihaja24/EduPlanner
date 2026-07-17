<?php
namespace App\Models;

use CodeIgniter\Model;

class EnseignantModel extends Model
{
    protected $table = 'enseignant';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDelete = false;
    protected $useTimeStamp = false;

    protected $allowedFields = [
        'nom_enseignant',
        'email',
    ];

    protected $validationRules = [
        'nom_enseignant' => 'required|min_lenght[2]|max_length[150]',
        'email' => 'required|valid_email|max_length[150]',
    ];
    protected $validationMessages = [
        'valid_email' => 'Email invalide'
    ];
}