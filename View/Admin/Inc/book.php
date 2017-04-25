<?php if ($_SESSION['auth']->getRole() >= \App\Model\User::ADMIN) : ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="section-title">
                <a data-toggle="collapse" class="white" data-parent="#accordion" href="#collapseFour">Configuration du livre</a>
            </h3>
            <br/>
        </div>
        <div id="collapseFour" class="collapse">
            <div class="row">
                <div class="col-sm-push-1 col-sm-10">
                    <form method="post" action="/book/update" enctype="multipart/form-data">
                        <div class="form-row text-input-row title-field">
                            <label>Titre</label>
                            <input type="text" name="title" class="text-input defaultText required"
                                   value="<?php if (isset($_SESSION['bookForm'])) : echo $_SESSION['bookForm']->getTitle(); endif; ?>"/>
                            <?php if (isset($_SESSION['bookErrors']['title'])) : ?>
                                <p class="alert alert-danger"><?php echo $_SESSION['bookErrors']['title']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-row text-input-row title-field">
                            <label>Sous-titre</label>
                            <input type="text" name="subtitle" class="text-input defaultText required"
                                   value="<?php if (isset($_SESSION['bookForm'])) : echo $_SESSION['bookForm']->getSubtitle(); endif; ?>"/>
                            <?php if (isset($_SESSION['bookErrors']['subtitle'])) : ?>
                                <p class="alert alert-danger"><?php echo $_SESSION['bookErrors']['subtitle']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-row text-input-row content-field">
                            <label>Résumé</label>
                            <textarea id="content" name="summary" class="text-input defaultText required"><?php if (isset($_SESSION['bookForm'])) : echo $_SESSION['bookForm']->getSummary(); endif; ?></textarea>
                            <?php if (isset($_SESSION['bookErrors']['summary'])) : ?>
                                <p class="alert alert-danger"><?php echo $_SESSION['bookErrors']['summary']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-row text-input-row picture-field">
                            <label>Photo à la une</label>
                            <?php if ($_SESSION['bookForm']->getImgUrl()) : ?>
                                <figure class="frame" style="width: 30%; margin-left: 20px; margin-bottom: 20px;">
                                    <img src="<?php echo $_SESSION['bookForm']->getImgUrl(); ?>" alt=""/>
                                </figure>
                                <a href="/book/imagedelete">
                                    <button type="button" class="btn btn-submit bm0">Supprimer l'image</button>
                                </a>
                                <p>Photo actuellement lié à l'épisode, choisissez une autre photo pour la remplacer.</p>
                            <?php else : ?>
                                <p>Aucune photo n'est actuellement lié à cet épisode.</p>
                            <?php endif; ?>
                            <input type="file" name="image" class="text-input defaultText required"/>
                            <?php if (isset($_SESSION['bookErrors']['image'])) : ?>
                                <p class="alert alert-danger"><?php echo $_SESSION['bookErrors']['image']; ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="button-row tm31">
                            <button type="submit" name="book" value="submit" class="btn btn-submit bm0">Enregistrer</button>
                            <?php unset($_SESSION['bookForm']); ?>
                            <?php unset($_SESSION['bookErrors']); ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr/>
    </div>
<?php endif; ?>