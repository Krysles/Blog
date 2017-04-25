<?php if ($_SESSION['auth']->getRole() >= \App\Model\User::ADMIN) : ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="section-title">
                <a data-toggle="collapse" class="white" data-parent="#accordion" href="#collapseFive">Configuration du blog</a>
            </h3>
            <br/>
        </div>
        <div id="collapseFive" class="collapse">
            <div class="row">
                <div class="col-sm-push-1 col-sm-10">
                    <form method="post" action="/configuration/update">
                        <div class="form-row text-input-row title-field">
                            <label>Titre</label>
                            <input type="text" name="title" class="text-input defaultText required"
                                   value="<?php if (isset($_SESSION['configurationForm'])) : echo $_SESSION['configurationForm']->getTitle(); endif; ?>"/>
                            <?php if (isset($_SESSION['configurationErrors']['title'])) : ?>
                                <p class="alert alert-danger"><?php echo $_SESSION['configurationErrors']['title']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-row text-input-row title-field">
                            <label>Accroche</label>
                            <input type="text" name="subtitle" class="text-input defaultText required"
                                   value="<?php if (isset($_SESSION['configurationForm'])) : echo $_SESSION['configurationForm']->getSubtitle(); endif; ?>"/>
                            <?php if (isset($_SESSION['configurationErrors']['subtitle'])) : ?>
                                <p class="alert alert-danger"><?php echo $_SESSION['configurationErrors']['subtitle']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="button-row tm31">
                            <button type="submit" name="configuration" value="submit" class="btn btn-submit bm0">Enregistrer</button>
                            <?php unset($_SESSION['configurationForm']); ?>
                            <?php unset($_SESSION['configurationErrors']); ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr/>
    </div>
<?php endif; ?>