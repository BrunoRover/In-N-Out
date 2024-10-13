<main class="content">
<div class="content-title mb-4">
        <i class="icon icofont-check-alt mr-2"></i>
        <div>
            <h1>Registrar Ponto</h1>
            <h2>Mantenha seu ponto consistente!</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3><?= date('d/m/Y'); ?></h3>
            <p class="mb-0">Os batimentos efetuados hoje</p>
            <?= $_SESSION['message']['message'] ?>
        </div>
        <div class="card-body">
            <div class="d-flex m-5 justify-content-around">
                <span class="record">Entrada 1: <?= $workingHours->time1 ?? '---' ?></span>
                <span class="record">Saída 1: <?= $workingHours->time2 ?? '---' ?></span>
            </div>
            <div class="d-flex m-5 justify-content-around">
                <span class="record">Entrada 2: <?= $workingHours->time3 ?? '---' ?></span>
                <span class="record">Saída 2: <?= $workingHours->time4 ?? '---' ?></span>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <a href="../src/controllers/innout.php" class="btn btn-success btn-lg">
                <i class="icofont-check mr-1">Bater o ponto</i>
            </a>
        </div>
    </div>

    
</main>