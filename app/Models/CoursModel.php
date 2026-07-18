<?php
namespace App\Models;
use CodeIgniter\Model;

class CoursModel extends Model 
{
    protected $table = 'cours';
    protected $primaryKey = 'id_cours';

    protected $allowedFields = [
        'titre_cours',
        'volume_horaire',
        'coefficient',
        'id_enseignant',
        'id_filliere'
    ];

    protected $validationRules = [
        'titre_cours' => 'required|min_length[3]max_length[100]',
        'volume_horaire' => 'required|integer',
        'coefficient' => 'required|decimal'
    ];

    public function getCoursAvecDetails ()
    {
        return $this->select('cours.*, enseignant.nom_enseignant, filliere.nom_filliere')
            ->join('enseignant' , 'enseignant.id_enseignant = cours.id_enseignant')
            ->join('filliere' , 'filliere.id_filliere = cours.id_filliere')
            ->findAll();
    }   
}
