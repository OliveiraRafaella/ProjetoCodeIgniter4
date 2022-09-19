<?= $this->extend('layouts/main_layout')?>

<?= $this->section('conteudo')?>

<header class = "container">
    <div class="row">
        <div class="col p-3">
            <h3>TODO List</h3>            
        </div>
        
        <div class="col text-right p-3">
            <a href="<?php site_url()?>" class = "btn btn-primary" >Criar nova Tarefa</a>
        </div>
        <hr>
    </div>
   
</header>
<hr>

<?php if (count($jobs)==0):?>
    <p class = "text-center">Não existem tarefas.</p>
<?php else:?>
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
            <?php foreach($jobs as $job):?>
                <tr>
                  <td><?= $job->job?></td> 
                  <td class = "text-center"><?= $job->datetime_created ?></td> 
                  <td class = "text-center"><?= $job->datetime_finished ?></td>
                  <td>[ações]</td> 
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <p>Nº de Tarefas: <strong><?= count($jobs)?></strong></p>
<?php endif;?>
<?php ?>
<?php ?>
<?= $this->endSection() ?>