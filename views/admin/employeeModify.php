<main>
    <?php if (isset($employee)) : ?>
            <div class="formContent">
                <div class="formContentTitle flexCenterCenter">
                    <h3>Modifier un employé</h3>
                </div>
                <form method="POST">
                    <div class="formInput flexCenterCenterColumn">
                        <div class="formName flexCenterBetween">
                            <div class="flexCenterCenterColumn">
                                <input type="text" placeholder="Nom*" name="lastname" value="<?= $employee->lastname ?? '' ?>" pattern="<?= REGEX_NAME ?>" required>
                                <p class="errorMessage"><?= (array_key_exists('lastname', $errorsModify)) ? $errorsModify['lastname'] : '' ?></p>
                            </div>
                            <div class="flexCenterColumn">
                                <input type="text" placeholder="Prénom*" name="firstname" value="<?= $employee->firstname ?? '' ?>" pattern="<?= REGEX_NAME ?>" required>
                                <p class="errorMessage"><?= (array_key_exists('firstname', $errorsModify)) ? $errorsModify['firstname'] : '' ?></p>
                            </div>
                        </div>
                        <input type="mail" placeholder="example@app.com" name="mail" value="<?= $employee->email ?? '' ?>" pattern="<?= REGEX_MAIL ?>">
                        <p class="errorMessage"><?= (array_key_exists('mail', $errorsModify)) ? $errorsModify['mail'] : '' ?></p>
                        <input type="tel" placeholder="Téléphone*" name="phone" value="<?= $employee->phone ?? '' ?>" pattern="<?= REGEX_PHONE ?>" required>
                        <p class="errorMessage"><?= (array_key_exists('phone', $errorsModify)) ? $errorsModify['phone'] : '' ?></p>
                        <input type="text" placeholder="Salaire*" name="income" value="<?= $employee->salaries ?? '' ?>" pattern="<?= REGEX_INCOME ?>" required>
                        <p class="errorMessage"><?= (array_key_exists('income', $errorsModify)) ? $errorsModify['income'] : '' ?></p>
                        <input type="text" placeholder="Adresse" name="adress" value="<?= $employee->adress ?? '' ?>">
                        <p class="errorMessage"><?= (array_key_exists('address', $errorsModify)) ? $errorsModify['adress'] : '' ?></p>
                    </div>
                
                    <!-- Button to submit form -->
                
                    <div class="registerButton flexCenterCenter">
                        <button type="submit">Modifier</button>
                    </div>
                </form>
            </div>
    <?php endif; ?>
</main>

