<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/style/images/favicon.png">
    <title><?php echo $title . ' - Jean Forteroche'; ?></title>
    <!-- Bootstrap core CSS -->
    <link href="/style/css/bootstrap.min.css" rel="stylesheet">
    <link href="/style/css/plugins.css" rel="stylesheet">
    <link href="/style/css/prettify.css" rel="stylesheet">
    <link href="/style.css" rel="stylesheet">
    <link href="/style/css/color/blue.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,800,700,600,500,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic' rel='stylesheet' type='text/css'>
    <link href="/style/type/fontello.css" rel="stylesheet">
    <link href="/style/type/budicons.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/style/js/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body class="full-layout">
<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>
<div class="body-wrapper">
    <!-- Affichage du menu -->
    <?php include 'Inc/menu.php'; ?>
    <!-- Affichage des messages flash -->
    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div id="error">
                <div class="response alert alert-<?php echo $type; ?>">
                    <?php echo $message; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
    <!-- Chargement du contenu -->
    <?php echo $content; ?>
</div>
<!-- /.body-wrapper -->
<!-- Mise en place du Javascript -->
<script src="/style/js/jquery.min.js"></script>
<script src="/style/js/bootstrap.min.js"></script>
<script src="/style/js/jquery.themepunch.tools.min.js"></script>
<script src="/style/js/classie.js"></script>
<script src="/style/js/plugins.js"></script>
<script src="/style/js/scripts.js"></script>
<script>
    $.backstretch(["/style/images/art/background.jpg"]);
    jQuery(document).ready(function ($) {
        $('.reply').click(function(e) {
            e.preventDefault();

            var $form = $('#form-comment');
            var $this = $(this);
            var comment_id = $this.data('id');
            var comment_level = $this.data('level');
            var $comment = $('#comment-' + comment_id);
            
            $('#comment_id').val(comment_id);
            $('#comment_level').val(comment_level + 1);

            $comment.after($form);
        });
    })
</script>
</body>
</html>
