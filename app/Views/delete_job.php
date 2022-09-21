<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('conteudo') ?>

<header class="container">
    <div class="row">
        <div class="col p-3">
            <h3>TODO List</h3>
        </div>
        <div class="col text-right p-3">
            <h3>Eliminar tarefa</h3>
        </div>
    </div>
</header>
<hr>

<div class="container">
    <div class="row">
        <div class="col text-center">
            <h3>Deseja eliminar a tarefa:</h3>
            <div class="card p-3 my-3 bg-light">
                <h4><?= $job -> job?></h4>
            </div>
            
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <a href="<?= site_url('public/main')?>" class="btn btn-secondary">Não</a>
            <a href="<?= site_url('public/main/deletejobconfirm/'. $job->idjobs)?>" class="btn btn-primary">Sim</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>