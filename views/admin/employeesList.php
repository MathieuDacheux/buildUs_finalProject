<main>

    <!-- Modal ajout client -->
    <div class="formContent hidden">
        <div class="formContentTitle flexCenterCenter">
            <div class="containerAdd flexCenterCenter">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <h3>Ajout d'un employé</h3>
        </div>
        <form method="POST">
            <div class="formInput flexCenterCenterColumn">
                <div class="formName flexCenterBetween">
                    <div class="flexCenterCenterColumn">
                        <input type="text" placeholder="Nom*" name="lastname" value="<?= $lastname ?? '' ?>" pattern="<?= REGEX_NAME ?>" required>
                        <p class="errorMessage"><?= (array_key_exists('lastname', $errorsRegistration)) ? $errorsRegistration['lastname'] : '' ?></p>
                    </div>
                    <div class="flexCenterColumn">
                        <input type="text" placeholder="Prénom*" name="firstname" value="<?= $firstname ?? '' ?>" pattern="<?= REGEX_NAME ?>" required>
                        <p class="errorMessage"><?= (array_key_exists('firstname', $errorsRegistration)) ? $errorsRegistration['firstname'] : '' ?></p>
                    </div>
                </div>
                <input type="mail" placeholder="example@app.com*" name="mail" value="<?= $mail ?? '' ?>" pattern="<?= REGEX_MAIL ?>" required>
                <p class="errorMessage"><?= (array_key_exists('mail', $errorsRegistration)) ? $errorsRegistration['mail'] : '' ?></p>
                <input type="tel" placeholder="Téléphone*" name="phone" value="<?= $phone ?? '' ?>" pattern="<?= REGEX_PHONE ?>" required>
                <p class="errorMessage"><?= (array_key_exists('phone', $errorsRegistration)) ? $errorsRegistration['phone'] : '' ?></p>
                <input type="number" placeholder="Salaire*" name="income" value="<?= $income ?? '' ?>" pattern="<?= REGEX_INCOME ?>" required>
                <p class="errorMessage"><?= (array_key_exists('income', $errorsRegistration)) ? $errorsRegistration['income'] : '' ?></p>
                <input type="text" placeholder="Adresse" name="adress" value="<?= $adress ?? '' ?>">
                <p class="errorMessage"><?= (array_key_exists('adress', $errorsRegistration)) ? $errorsRegistration['adress'] : '' ?></p>
            </div>
        
            <!-- Button to submit form -->
        
            <div class="registerButton flexCenterCenter">
                <button type="submit">Ajouter</button>
            </div>
        </form>
    </div>

    <!-- Modal confirmation register -->
    <?php if (isset($confirmation)) : ?>
        <?php if($confirmation == true) :?>
        <div class="showResult visible">
            <p class="resultFormText goodResult">Le données ont bien été ajoutées</p>
        </div>
        <?php elseif ($confirmation == false) : ?>
        <div class="showResult visible">
            <p class="resultFormText badResult">Les données fournies ne sont pas conformes</p>
        </div>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (isset($isExist)) : ?>
        <?= ($isExist == true) ? '<div class="showResult visible"><p class="resultFormText badResult">L\'employé existe déjà dans le répertoire</p></div>' : '' ;?>
    <?php endif; ?>


    <?= $display ?>
</main>
