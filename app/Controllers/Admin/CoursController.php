<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CoursModel;

class CoursController extends BaseController
{
    public function index()
    {
        $coursModel = new CoursModel();

        $cours = $coursModel
            ->select('cours.id_cours, cours.titre_cours, cours.volume_horaire, cours.coefficient,
                            enseignant.nom_enseignant, filliere.nom_filliere')
            ->join('enseignant', 'cours.id_enseignant = enseignant.id')
            ->join('filliere', 'cours.id_filiere = filliere.id')
            ->findAll();
        return view('admin/cours-list', ['cours' => $cours]);
    }
}