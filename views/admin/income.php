<main>

    <!-- Modal ajout client -->
    <div class="formContent flexCenterCenter hidden">
    </div>

    <div class="containerRecap">
        <div class="containerSubject income flexCenterCenter">
            <div class="containerIncome">
                <canvas id="revenus"></canvas>
            </div>
        </div>
    </div>
    <div class="containerRecap flexCenterCenterBetween">
        <div class="containerSubject clients">
            <div class="containerTitle flexCenterCenter">
                <div class="containerAdd flexCenterCenter revenusIncome">
                </div>
                <h3 class="titleIncome">Chiffre d'affaires</h3>
            </div>
            <div class="containerContent flexCenterColumn">
                <?php if(isset($incomeDisplay)) : ?>
                    <?php foreach($incomeDisplay as $income) : ?>
                        <div class="listingRecap flexCenterBetween">
                            <div class="containerInformations">
                                <div class="containerPicture">
                                    <p><i class="fa-solid fa-euro-sign"></i></p>
                                </div>
                                <div class="containerName">
                                    <!-- Change the format of the income_date -->
                                    <p><?= $income->daily_income ?> € | <?= date('d/m/Y', strtotime($income->income_date)) ?></p>
                                </div>
                            </div>
                            <div class="containerMore flexCenterCenter">
                                <div class="containerPlus flexCenterAround">
                                    <a href="/dashboard/business?delete=1&amp;id=<?= $income->Id_incomes ?>"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </div>      
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="containerSubject employees">
            <div class="containerTitle flexCenterCenter">
                <div class="containerAdd flexCenterCenter targetIncome">
                </div>
                <h3 class="titleIncome">Objectif hebdomadaire</h3>
            </div>
            <div class="containerContent flexCenterCenter">
                <canvas id="target"></canvas>
            </div>
        </div>
    </div>
</main>

<!-- CDN CHART.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>