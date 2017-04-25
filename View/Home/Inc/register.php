<section id="register">
    <div class="box">
        <h2 class="section-title">Inscription</h2>
        <div class="divide20"></div>
        <div class="form-container">
            <div class="response alert alert-success"></div>
            <form class="" action="/register" method="post">
                <fieldset>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-row text-input-row name-field">
                                <label>Nom</label>
                                <input type="text" name="lastname" class="text-input defaultText required"
                                       value="<?php if (isset($_SESSION['registerForm'])) : echo $_SESSION['registerForm']->getLastname(); endif; ?>" placeholder="Entrez votre nom"/>
                                <?php if (isset($_SESSION['registerErrors']['lastname'])) : ?>
                                    <p class="alert alert-danger"><?php echo $_SESSION['registerErrors']['lastname']; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-row text-input-row name-field">
                                <label>Prénom</label>
                                <input type="text" name="firstname" class="text-input defaultText required"
                                       value="<?php if (isset($_SESSION['registerForm'])) : echo $_SESSION['registerForm']->getFirstname(); endif; ?>"
                                       placeholder="Entrez votre prénom"/>
                                <?php if (isset($_SESSION['registerErrors']['firstname'])) : ?>
                                    <p class="alert alert-danger"><?php echo $_SESSION['registerErrors']['firstname']; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-row text-input-row email-field">
                                <label>Email</label>
                                <input type="email" name="email" class="text-input defaultText required email"
                                       value="<?php if (isset($_SESSION['registerForm'])) : echo $_SESSION['registerForm']->getEmail(); endif; ?>"
                                       placeholder="Entrez votre adresse email"/>
                                <?php if (isset($_SESSION['registerErrors']['email'])) : ?>
                                    <p class="alert alert-danger"><?php echo $_SESSION['registerErrors']['email']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-row text-input-row password-field">
                                <label>Mot de passe</label>
                                <input type="password" name="password" class="text-input defaultText required" placeholder="15 caractères maximum"/>
                            </div>
                            <div class="form-row text-input-row password-field">
                                <label>Confirmation du mot de passe</label>
                                <input type="password" name="confirmPassword" class="text-input defaultText required" placeholder="15 caractères maximum"/>
                                <?php if (isset($_SESSION['registerErrors']['password'])) : ?>
                                    <p class="alert alert-danger"><?php echo $_SESSION['registerErrors']['password']; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-row text-input-row role-field">
                                <input type="hidden" name="role" class="text-input defaultText required" value="visitor" />
                            </div>
                            <div class="button-row pull-right tm31">
                                <button type="submit" name="register" value="submit" class="btn btn-submit bm0">Inscription</button>
                                <?php unset($_SESSION['registerForm']); ?>
                                <?php unset($_SESSION['registerErrors']); ?>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <!-- /.form-container -->
    </div>
    <!-- /.box -->
</section>
<!-- /#register -->