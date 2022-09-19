<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Main extends Controller
{
    public function index()
    {
        //dysplay all jobs
        $data['jobs'] = $this->getAllJobs();

        return view('home',$data);
    }

    public function new_job(){
       // return view('new_job');
       echo 'Nova Senha';
    }

 /*   public function newJobSubmition()
    {
        # code...
    }
*/
    private function getAllJobs(){

        $db = db_connect();
        $dados = $db->query("SELECT * FROM jobs")->getResultObject();
        $db->close();

        return $dados;
    }
}
