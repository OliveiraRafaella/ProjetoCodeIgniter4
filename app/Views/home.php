<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('conteudo') ?>

<header class="container">
    <div class="row">
        <div class="col p-3">
            <h3>TODO List</h3>
        </div>

        <div class="col text-right p-3">
            <a href="<?php echo site_url('public/main/new_job') ?>" class="btn btn-primary">Criar nova Tarefa</a>
        </div>
        <hr>
    </div>

</header>
<hr>

<?php if (count($jobs) == 0) : ?>
    <p class="text-center">Não existem tarefas.</p>
<?php else : ?>
    <table class="table table-striped table-sm">
        <thead class="thead-dark">
            <tr>
                <th>Tarefa</th>
                <th class="text-center">Data de Criação</th>
                <th class="text-center">Data de Finalização</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jobs as $job) : ?>
                <tr>
                    <td><?= $job->job ?></td>
                    <td class="text-center"><?= $job->datetime_created ?></td>
                    <td class="text-center"><?= $job->datetime_finished ?></td>
                    <td>
                        <!-- tarefa realizada -->
                        <?php if (empty($job->datetime_finished)) : ?>
                            <a href="<?= site_url('public/main/jobdone/' . $job->idjobs) ?>" class="btn btn-success btn-sm mx-2"><i class="fa-solid fa-check"></i></a>
                        <?php else : ?>
                            <a href="<?= site_url('public/main/tarefa/' . $job->idjobs) ?>" class="btn btn-danger btn-sm mx-2"><i class="fa-solid fa-times"></i></a>
                        <?php endif; ?>

                        <!-- update -->
                        <?php if (empty($job->datetime_finished)) : ?>
                            <a href="<?= site_url('public/main/editjob/' . $job->idjobs) ?>" class="btn btn-primary btn-sm mx-2"><i class="fa fa-pencil"></i></a>
                        <?php else : ?>
                            <button class="btn btn-primary btn-sm mx-2 " disabled><i class="fa fa-pencil"></i></button>
                        <?php endif; ?>

                        <!--delete-->
                        <a href="<?= site_url('public/main/deletejob/' . $job->idjobs) ?>" class="btn btn-primary btn-sm mx-2"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p>Nº de Tarefas: <strong><?= count($jobs) ?></strong></p>
<?php endif; ?>

<?= $this->endSection() ?>