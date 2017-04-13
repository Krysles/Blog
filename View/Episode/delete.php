<?php $this->title = "Suppression de l'épisode"; ?>

<div class="container inner">
    <div class="single blog row">
        <div class="col-md-push-2 col-md-8 col-sm-12 content">
            <div class="blog-posts">
                <div class="post box">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-row text-input-row title-field">
                            <h2>Suppression d'un épisode</h2>
                            <label>Numéro</label>
                            <input type="text" name="number" class="text-input defaultText required" value="<?php echo $ticket->getNumber(); ?>" disabled="disabled" />
                            <label>Titre</label>
                            <input type="text" name="title" class="text-input defaultText required"
                                   value="<?php echo $ticket->getTitle(); ?>" disabled="disabled" />
                            <p>Vous êtes sur le point de supprimer un épisode, cette action est irréversible.<br />La photo et les commentaires déjà présent en seront de même.</p>
                            <p>Etes-vous sur ?</p>
                        </div>

                        <div class="button-row tm31">

                            <button type="submit" name="submitbtn" value="submit" class="btn btn-submit bm0">Supprimer</button>
                            <a href="/episode/<?php echo $ticket->getNumber(); ?>">
                                <button type="button" class="btn btn-submit bm0">Annuler</button>
                            </a>
                            <?php unset($_SESSION['ticketManagerForm']); ?>
                        </div>
                    </form>

                </div>
                <!-- /.post -->
            </div>
            <!-- /.blog-posts -->

            <div class="divide20"></div>

        </div>
        <!-- /.content -->

    </div>
    <!-- /.blog -->

</div>
<!-- /.container -->
