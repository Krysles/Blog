<?php if ($_SESSION['auth']->getRole() >= \App\Model\User::MEMBER) : ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="section-title">
                <a data-toggle="collapse" class="white" data-parent="#accordion" href="#collapseSix">Gestion de compte</a>
            </h3>
            <br/>
        </div>
        <div id="collapseSix" class="collapse">
            <div class="row">
                <div class="col-sm-push-1 col-sm-5">
                    <h5>Informations sur l'utilisateur</h5>
                    <p><b>Prénom :</b> <?php echo $userInformations->getFirstname(); ?></p>
                    <p><b>Nom :</b> <?php echo $userInformations->getLastname(); ?></p>
                    <p><b>Email :</b> <?php echo $userInformations->getEmail(); ?></p>
                    <p><b>Date d'inscription :</b> <?php echo $userInformations->getRegistDate(); ?></p>
                </div>
                <div class="col-sm-push-1 col-sm-5">
                    <h5>Informations concernant votre mot de passe</h5>
                    <?php if (!empty($userInformations->getResetDate())) : ?>
                        <p><b>Date de dernier changement de mot de passe :</b> <?php echo $userInformations->getResetDate(); ?></p>
                    <?php else: ?>
                        <p><?php echo "Vous n'avez jamais changé votre mot de passe."; ?></p>
                    <?php endif; ?>
                    <form class="" action="/admin/reset" method="post">
                        <fieldset>
                            <p>Pour changer votre mot de passe, utiliser le formulaire ci-dessous.</p>
                            <div class="form-row text-input-row password-field">
                                <label>Mot de passe</label>
                                <input type="password" name="password" class="text-input defaultText required" placeholder="15 caractères maximum"/>
                            </div>
                            <div class="form-row text-input-row password-field">
                                <label>Confirmation du mot de passe</label>
                                <input type="password" name="confirmPassword" class="text-input defaultText required" placeholder="15 caractères maximum"/>
                                <?php if (isset($_SESSION['resetErrors']['password'])) : ?>
                                    <p class="alert alert-danger"><?php echo $_SESSION['resetErrors']['password']; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-row text-input-row role-field">
                                <input type="hidden" name="role" class="text-input defaultText required" value="visitor" />
                            </div>
                            <div class="button-row pull-right tm31">
                                <button type="submit" name="reset" value="submit" class="btn btn-submit bm0">Valider</button>
                                <?php unset($_SESSION['resetErrors']); ?>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <!-- <hr/> A  mettre si ajout d'élément de menu -->
    </div>
<?php endif; ?>