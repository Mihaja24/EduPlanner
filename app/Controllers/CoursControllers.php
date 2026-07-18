<?php
namespace App\Controllers;

use App\Models\CoursModel;

class CoursControllers extends BaseController
{
        public function index() 
    {
        $models = new CoursModel();

        $data['les_cours'] = $models->getCoursAvecDetails();

        return view('cours_list', $data);
        
    }
}