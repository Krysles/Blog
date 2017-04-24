<script src="/style/js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({
        selector: 'textarea#content',
        language: 'fr_FR',
        plugins: ['save', 'preview', 'wordcount'],
        menubar: false,
        toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | outdent indent | link image | preview'
    });
</script>

<?php $this->title = "Modification de l'épisode"; ?>

<div class="container inner">
    <div class="single blog row">
        <div class="col-md-push-2 col-md-8 col-sm-12 content">
            <div class="blog-posts">
                <div class="post box">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-row text-input-row title-field">
                            <label>Titre</label>
                            <input type="text" name="title" class="text-input defaultText required"
                                   value="<?php if (isset($_SESSION['ticketManagerForm'])) : echo $_SESSION['ticketManagerForm']->getTitle(); endif; ?>"/>
                            <?php if (isset($_SESSION['ticketManagerErrors']['title'])) : ?>
                                <p class="alert alert-danger"><?php echo $_SESSION['ticketManagerErrors']['title']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-row text-input-row picture-field">
                            <label>Photo à la une</label>
                            <?php if ($_SESSION['ticketManagerForm']->getImgUrl()) : ?>
                                <figure class="frame" style="width: 30%; margin-left: 20px; margin-bottom: 20px;">
                                    <img src="<?php echo $_SESSION['ticketManagerForm']->getImgUrl(); ?>" alt=""/>
                                </figure>
                                <a href="/episode/<?php echo $_SESSION['ticketManagerForm']->getNumber(); ?>/imagedelete">
                                    <button type="button" class="btn btn-submit bm0">Supprimer l'image</button>
                                </a>
                                <p>Photo actuellement lié à l'épisode, choisissez une autre photo pour la remplacer.</p>
                            <?php else : ?>
                                <p>Aucune photo n'est actuellement lié à cet épisode.</p>
                            <?php endif; ?>
                            <input type="file" name="image" class="text-input defaultText required"/>
                            <?php if (isset($_SESSION['ticketManagerErrors']['image'])) : ?>
                                <p class="alert alert-danger"><?php echo $_SESSION['ticketManagerErrors']['image']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-row text-input-row content-field">
                            <label>Contenu de l'épisode</label>
                            <textarea id="content" name="content"
                                      class="text-input defaultText required"><?php if (isset($_SESSION['ticketManagerForm'])) : echo $_SESSION['ticketManagerForm']->getContent(); endif; ?></textarea>
                            <?php if (isset($_SESSION['ticketManagerErrors']['content'])) : ?>
                                <p class="alert alert-danger"><?php echo $_SESSION['ticketManagerErrors']['content']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-row text-input-row publish-field">
                            <?php if ($_SESSION['ticketManagerForm']->getPublish() == 1) : ?>
                                <input type="radio" name="publish" value="1" checked="checked" id="radiopublish"/><label for="radiopublish">Publié</label><br/>
                                <input type="radio" name="publish" value="0" id="radionopublish"/><label for="radionopublish">Non Publié</label>
                            <?php else : ?>
                                <input type="radio" name="publish" value="1" id="radiopublish"/><label for="radiopublish">Publié</label><br/>
                                <input type="radio" name="publish" value="0" checked="checked" id="radionopublish"/><label for="radionopublish">Non Publié</label>
                            <?php endif; ?>
                        </div>
                        <div class="button-row tm31">
                            <button type="submit" name="submitbtn" value="submit" class="btn btn-submit bm0">Enregistrer</button>
                            <a href="/page">
                                <button type="button" class="btn btn-submit bm0">Annuler</button>
                            </a>
                            <?php unset($_SESSION['ticketManagerForm']); ?>
                            <?php unset($_SESSION['ticketManagerErrors']); ?>
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
