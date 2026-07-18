<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CoursModel;
use App\Models\EnseignantModel;
use App\Models\FiliereModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class CoursController extends BaseController
{
    public function new()
    {
        return view('admin/cours_form', [
            'enseignants' => (new EnseignantModel())->findAll(),
            'filieres' => (new FiliereModel())->findAll(),
        ]);
    }

    public function create()
    {
        $coursModel = new CoursModel();

        if (!$coursModel->save($this->request->getPost())) {
            return redirect()->back()->withInput()->with('errors', $coursModel->errors());
        }

        return redirect()->to('admin/cours/cours_list');
    }

    public function edit($id)
    {
        $coursModel = new CoursModel();
        $cours = $coursModel->find($id);

        if (!$cours) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('admin/cours_form', [
            'cours' => $cours,
            'enseignant' => (new EnseignantModel())->findAll(),
            'filieres' => (new FiliereModel())->findAll()
        ]);
    }

    public function update($id)
    {
        $coursModel = new CoursModel();
        $data = $this->request->getRawInput();
        if (!$coursModel->update($id, $data)) {
            return redirect()->to()->withInput()->with('errors', $coursModel->errors());
        }
        
        return redirect()->to('admin/cours/cours_list');

    }

    public function index()
    {
        $coursModel = new CoursModel();

        $cours = $coursModel
            ->select('cours.id_cours, cours.titre_cours, cours.volume_horaire, cours.coefficient,
                            enseignant.nom_enseignant, filliere.nom_filliere')
            ->join('enseignant', 'cours.id_enseignant = enseignant.id')
            ->join('filliere', 'cours.id_filiere = filliere.id')
            ->findAll();
        return view('admin/cours/cours_list', ['cours' => $cours]);
    }
}