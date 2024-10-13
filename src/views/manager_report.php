<main class="content">
    <div class="content-title mb-4">
            <i class="icon icofont-chart-histogram mr-2"></i>
        <div>
            <h1>Relatório Gerencial</h1>
            <h2>Resumo de horas trabalhadas pelos funcionários</h2>
        </div>
    </div>
    <div class="summary-boxes">
        <div class="summary-box bg-primary">
            <i class="icon icofont-users"></i>
            <p class="title">Qtde de funcionários</p>
            <h3 class="value"><?= $activeUserCount ?></h3>
        </div>
        <div class="summary-box bg-danger">
            <i class="icon icofont-patient-bed"></i>
            <p class="title">Faltas</p>
            <h3 class="value"><?= count($absentUsers)?></h3>
        </div>
        <div class="summary-box bg-success">
            <i class="icon icofont-sand-clock"></i>
            <p class="title">Horas no Mês</p>
            <h3 class="value"><?= $hoursInMonth ?></h3>
        </div>
    </div>
    <?php if(count($absentUsers)) : ?>
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="card-title">Faltosos do Dia</h4>
            <p class="card-category mb-0">Relação dos funcionários que ainda não bateram o ponto</p>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th>Nome</th>
                </thead>
                <tbody>
                    <?php foreach($absentUsers as $name) : ?>
                        <tr>
                            <td><?= $name ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif ?> 
</main>