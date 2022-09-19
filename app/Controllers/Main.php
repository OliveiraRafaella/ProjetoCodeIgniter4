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
        return view('new_job');
       
    }

   public function newjobsubmition()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            return redirect()->to(site_url('public/main'));
        }

        $job = $this->request-> getPost('job_name');

        $params = [
            //outro metodo de fazer: 'job' => $this->request-> getPost('job_name');
            'job' => $job
        ];

        //guardar na base de dados
        $db = db_connect();
        $db->query("
            INSERT INTO jobs (job, datetime_created)
            VALUES(:job:, NOW())", $params);
        $db->close();

        //redirecionar para pagina principal
        return redirect()->to(site_url('main'));
    }

    private function getAllJobs(){

        $db = db_connect();
        $dados = $db->query("SELECT * FROM jobs")->getResultObject();
        $db->close();

        return $dados;
    }
}
