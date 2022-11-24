<main class="flexCenterColumn">
    <div class="formContent">
        <form method="POST" class="flexCenterCenterColumn <?= isset($taskDisplay) ? 'disabled' : '' ;?>">
            <legend class="flexCenterCenter">Rappels</legend>
            <div class="containerForm flexCenterCenter">
                <div class="formTask">
                    <input type="text" placeholder="Ajoutez un rappel" name="task" maxlength="100">
                </div>
                <div class="registerButton flexCenterCenter">
                    <button type="submit"><i class="fa-solid fa-plus"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="containerSubject flexCenterColumn">
        <div class="containerNav flexCenterBetween">
            <div class="navTask todosNav flexCenterCenter">
                <p>À faire</p>
            </div>
            <div class="navTask todosFinished flexCenterCenter">
                <p>Terminé</p>
            </div>
        </div>
        <div class="containerListTasks unChecked">
            <?php if(isset($tasksUnChecked)) : ?>
                <?php foreach($tasksUnChecked as $task) : ?>
                    <div class="listingRecap flexCenterBetween">
                        <div class="containerInformations">
                            <div class="containerPicture">
                                <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2940&q=80" alt="">
                            </div>
                            <div class="containerName">
                                <p><?= $task->description ?></p>
                            </div>
                        </div>
                        <div class="containerMore flexCenterCenter">
                            <div class="containerPlus flexCenterAround">
                                <a href="/dashboard/rappels?checked=1&amp;id=<?= $task->Id_todos ?>"><i class="fa-solid fa-check"></i></a>
                            </div>
                        </div>      
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="containerListTasks checked hidden">
            <?php if(isset($tasksChecked)) : ?>
                <?php foreach($tasksChecked as $task) : ?>
                    <div class="listingRecap flexCenterBetween">
                        <div class="containerInformations">
                            <div class="containerPicture">
                                <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2940&q=80" alt="">
                            </div>
                            <div class="containerName">
                                <p><?= $task->description ?></p>
                            </div>
                        </div>
                        <div class="containerMore flexCenterCenter">
                            <div class="containerPlus flexCenterAround">
                                <i class="fa-solid fa-trash taskFinished <?= $task->Id_todos ?>"></i>
                            </div>
                        </div>      
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal confirmation register -->
    <?php if (isset($registerConfirmation)) : ?>
        <?php if($registerConfirmation == true) :?>
        <div class="showResult visible">
            <p class="resultFormText goodResult">Le données ont bien été ajoutées</p>
        </div>
        <?php elseif ($registerConfirmation == false) : ?>
        <div class="showResult visible">
            <p class="resultFormText badResult">Les données fournies ne sont pas conformes</p>
        </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Modal confirmation delete -->
    <?php if (isset($deleteConfirmation)) : ?>
        <?php if($deleteConfirmation == true) :?>
        <div class="showResult visible">
            <p class="resultFormText goodResult">Tâche éffacée</p>
        </div>
        <?php elseif ($deleteConfirmation == false) : ?>
        <div class="showResult visible">
            <p class="resultFormText badResult">Les données fournies ne sont pas conformes</p>
        </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Modal confirmation checked -->
    <?php if (isset($checkedConfirmation)) : ?>
        <?php if($checkedConfirmation == true) :?>
        <div class="showResult visible">
            <p class="resultFormText goodResult">Tâche terminée</p>
        </div>
        <?php elseif ($checkedConfirmation == false) : ?>
        <div class="showResult visible">
            <p class="resultFormText badResult">Les données fournies ne sont pas conformes</p>
        </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="containerDeleteSelected"></div>
</main>