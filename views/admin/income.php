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
                <div class="containerAdd flexCenterCenter">
                    <i class="fa-solid fa-plus revenusIncome"></i>
                </div>
                <h3 class="titleIncome">Chiffre d'affaires</h3>
            </div>
            <div class="containerContent flexCenterColumn">

            </div>
        </div>
        <div class="containerSubject employees">
            <div class="containerTitle flexCenterCenter">
                <div class="containerAdd flexCenterCenter">
                    <i class="fa-solid fa-plus targetIncome"></i>
                </div>
                <h3 class="titleIncome">Objectif</h3>
            </div>
            <div class="containerContent flexCenterCenter">
                <canvas id="target"></canvas>
            </div>
        </div>
    </div>
</main>

<!-- CDN CHART.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>