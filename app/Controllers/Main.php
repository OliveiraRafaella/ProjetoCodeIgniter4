<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Main extends Controller
{
    public function index()
    {
        //dysplay all jobs
        $data['jobs'] = $this->getAllJobs();

        return view('home', $data);
    }

    public function new_job()
    {
        return view('new_job');
    }

    public function newjobsubmition()
    {
        if (!$_SERVER['REQUEST_METHOD'] == 'POST') {
            return redirect()->to(site_url('public/main'));
        }

        $job = $this->request->getPost('job_name');

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
        return redirect()->to(site_url('public/main'));
    }

    public function jobDone($id_job = -1)
    {
        //atualizar a bd a tarefa como realizada
        $params = [
            'idjob' => $id_job
        ];

        $db = db_connect();
        $db->query("
            UPDATE jobs
            SET datetime_finished = NOW(),
            datetime_updated = NOW()
            WHERE idjobs = :idjob:
        ", $params);
        $db->close();

        //atualizar a pagina inicial
        return redirect()->to(site_url('public/main'));
    }

    public function tarefa($id_job = -1)
    {
        $params = [
            'idjob' => $id_job
        ];

        $db = db_connect();
        $db->query("
            UPDATE jobs
            SET datetime_finished = NULL,
            datetime_updated = NOW()
            WHERE idjobs = :idjob:
        ", $params);
        $db->close();

        return redirect()->to(site_url('public/main'));
    }

    public function editJob($id_job = -1)
    {
        //carregar dados da tarefa

        $params = [
            'id_job' => $id_job
        ];
        $db = db_connect();
        $dados = $db->query("
            SELECT * FROM jobs WHERE idjobs = :id_job:
        ", $params)->getResultObject();
        $db->close();

        $data['job'] = $dados[0];
        return view('edit_job', $data);
    }

    public function editJobSubmition()
    {

        //atualizar tarefa no bd
        $params = [
            'id_job' => $this->request->getPost('id_job'),
            'job' => $this->request->getPost('job_name')
        ];
        $db = db_connect();
        $db->query("
            UPDATE jobs
            SET job = :job:,
            datetime_updated = NOW()
            WHERE idjobs = :id_job:
        ", $params);
        $db->close();
        //atulizar pagina inicial
        return redirect()->to(site_url('public/main'));
    }

    public function deleteJob($id_job = -1)
    {

        //apresentar uma view com caixa de dialogo se deseja eliminar a tarefa
        $params  = [
            'id_job' => $id_job
        ];
        $db = db_connect();
        $data['job'] = $db->query("
            SELECT * FROM jobs WHERE idjobs = :id_job:
        ", $params)->getResultObject()[0];
        $db->close();

        //apresentar a view
        return view('delete_job', $data);
    }

    public function deleteJobConfirm($id_job = -1)
    {
        //delete da bd
        $params  = [
            'id_job' => $id_job
        ];
        $db = db_connect();
        $data['job'] = $db->query("
            DELETE  FROM jobs WHERE idjobs = :id_job:
        ", $params);
        $db->close();
        //atualização da pagina
        return redirect()->to(site_url('public/main'));
    }
    private function getAllJobs()
    {

        $db = db_connect();
        $dados = $db->query("SELECT * FROM jobs")->getResultObject();
        $db->close();

        return $dados;
    }
}
