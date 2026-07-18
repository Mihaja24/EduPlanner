<?php

namespace App\Controllers\Api;

use App\Models\CoursModel;
use CodeIgniter\RESTful\ResourceController;

class CoursApiController extends ResourceController
{
    protected $modelName = CoursModel::class;
    protected $format    = 'json';

    public function index()
    {
        $this->model->select('cours.id_cours, cours.titre_cours, cours.volume_horaire,
                               cours.coefficient, cours.id_enseignant, cours.id_filiere');

        $idFiliere    = $this->request->getGet('id_filiere');
        $idEnseignant = $this->request->getGet('id_enseignant');

        if (! empty($idFiliere)) {
            $this->model->where('id_filiere', $idFiliere);
        }
        if (! empty($idEnseignant)) {
            $this->model->where('id_enseignant', $idEnseignant);
        }

        return $this->respond($this->model->findAll(), 200);
    }
    public function updateVolumeHoraire($id = null)
    {
        if (! is_numeric($id) || $id <= 0) {
            return $this->failValidationErrors('ID cours invalide.');
        }

        $cours = $this->model->find($id);
        if (! $cours) {
            return $this->failNotFound('Cours introuvable.');
        }

        $volumeHoraire = $this->request->getRawInput()['volume_horaire'] ?? null;

        if (! is_numeric($volumeHoraire) || $volumeHoraire <= 0) {
            return $this->failValidationErrors('Volume horaire invalide.');
        }

        $this->model->update($id, ['volume_horaire' => $volumeHoraire]);

        return $this->respondUpdated([
            'message'        => 'Volume horaire mis à jour.',
            'id_cours'       => (int) $id,
            'volume_horaire' => (float) $volumeHoraire,
        ]);
    }
}
