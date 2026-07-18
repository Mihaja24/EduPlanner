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
        return view('admin/cours/cours_form', [
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

        return redirect()->to('admin/cours')->with('success', 'Cours ajouté avec succès.');
    }

    public function edit($id)
    {
        $coursModel = new CoursModel();
        $cours = $coursModel->find($id);

        if (!$cours) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('admin/cours/cours_form', [
            'cours' => $cours,
            'enseignants' => (new EnseignantModel())->findAll(),
            'filieres' => (new FiliereModel())->findAll()
        ]);
    }

    public function update($id)
    {
        $coursModel = new CoursModel();
        $data = $this->request->getRawInput();

        if (!$coursModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $coursModel->errors());
        }

        return redirect()->to('admin/cours')->with('success', 'Cours mis à jour avec succès.');
    }

    public function delete($id)
    {
        $coursModel = new CoursModel();
        $cours = $coursModel->find($id);

        if ($cours) {
            $coursModel->delete($id);
        }

        return redirect()->to('admin/cours')->with('success', 'Cours supprimé avec succès.');
    }

    public function index()
    {
        $coursModel = new CoursModel();
        $perPage = 10;
        $page = max(1, (int) ($this->request->getGet('page') ?? 1));
        $offset = ($page - 1) * $perPage;

        $builder = $coursModel->builder();
        $builder->select('cours.*, enseignant.nom_enseignant, filliere.nom_filliere')
            ->join('enseignant', 'enseignant.id_enseignant = cours.id_enseignant', 'left')
            ->join('filliere', 'filliere.id_filliere = cours.id_filliere', 'left');

        $total = (int) $builder->countAllResults(false);
        $rows = $builder->limit($perPage, $offset)->get()->getResultArray();

        $totalPages = max(1, (int) ceil($total / $perPage));

        return view('admin/cours/cours_list', [
            'les_cours' => $rows,
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'totalPages' => $totalPages,
            'hasPrevious' => $page > 1,
            'hasNext' => $page < $totalPages,
        ]);
    }
}