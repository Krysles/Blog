<script src="/style/js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({
        selector: 'p#content',
        language: 'fr_FR',
        plugins: ['save', 'preview', 'wordcount'],
        menubar: false,
        toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | outdent indent | link image | save preview'
    });
</script>

<div class="container inner">
    <div class="single blog row">
        <div class="col-md-push-2 col-md-8 col-sm-12 content">
            <div class="blog-posts">
                <div class="post box">
                    <div class="meta">
                        <span class="category"><?php echo $ticket['firstname'] . ' ' . $ticket['lastname']; ?></span>
                        <span class="date"><?php echo $ticket['date']; ?></span>
                        <span class="comments"><a href="#">8 <i class="icon-chat-1"></i></a></span>
                    </div>

                    <form method="post">
                    <h2 class="post-title">
                        <a href="blog-post.html"><?php echo $ticket['title']; ?></a>
                    </h2>

                    <!-- METTRE CHAMP FICHIER
                    <img class="pull-right" style="width: 30%; margin-left: 20px; margin-bottom: 20px;" src="<?php echo $ticket['url']; ?>" alt=""/>
                    -->


                        <p id="content"><?php echo $ticket['content']; ?></p>
                        <button name="submitbtn" hidden="hidden"></button>
                    </form>

                    <?php if (isset($_POST)) {
                        $test = htmlspecialchars($_POST['content']);
                        print_r($test);
                    } ?>

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
