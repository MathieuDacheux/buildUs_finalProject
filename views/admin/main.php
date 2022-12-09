<main>
    <div class="containerRecap">
        <div class="containerSubject income">
            <div class="graph flexCenterCenter">
                <div class="containerIncome flexCenterCenter">
                    <canvas id="revenus"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="containerRecap flexCenterCenterBetween">
        <div class="containerSubject clients">
            <div class="containerTitle flexCenterCenter">
                <h3><a href="/dashboard/clients">Clients</a></h3>
            </div>
            <div class="containerContent flexCenterColumn">
                <?php if (isset($lastClients)) :?>
                    <?php foreach($lastClients as $client) :?>
                        <div class="listingRecap flexCenterBetween">
                            <div class="containerInformations">
                                <div class="containerPicture">
                                    <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2940&q=80" alt="">
                                </div>
                                <div class="containerName">
                                    <p><?= $client->firstname ?> <?= $client->lastname ?></p>
                                </div>
                            </div>
                            <div class="containerMore flexCenterCenter">
                                <div class="containerPlus flexCenterCenter">
                                    <a href="/dashboard/profil-client?id=<?= $client->Id_users ?>"><i class="fa-regular fa-eye"></i></a>
                                </div>
                            </div>      
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="containerSubject employees">
            <div class="containerTitle flexCenterCenter">
                <h3><a href="/dashboard/employes">Employés</a></h3>
            </div>
            <div class="containerContent flexCenterColumn">
                <?php if (isset($lastEmployees)) : ?>
                    <?php foreach($lastEmployees as $employee) : ?>
                        <div class="listingRecap flexCenterBetween">
                            <div class="containerInformations">
                                <div class="containerPicture">
                                    <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2940&q=80" alt="">
                                </div>
                                <div class="containerName">
                                    <p><?= $employee->firstname ?> <?= $employee->lastname ?></p>
                                </div>
                            </div>
                            <div class="containerMore flexCenterCenter">
                                <div class="containerPlus flexCenterCenter">
                                    <a href="/dashboard/profil-employee?id=<?= $employee->Id_users ?>"><i class="fa-regular fa-eye"></i></a>
                                </div>
                            </div>      
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<!-- CDN CHART.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>