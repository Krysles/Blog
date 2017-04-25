<?php $this->title = "Tableau de bord"; ?>

<div class="page">
    <div class="container">
        <div class="box">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="section-title text-center">Tableau de bord</h3>
                </div>
            </div>
        </div>
        <section>
            <div class="box">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="pull-right"><em>(cliquez pour vous déplacer)</em></p>
                        <div class="panel-group" id="accordion">
                            <?php include 'Inc/statistics.php'; ?>
                            <?php include 'Inc/episodes.php'; ?>
                            <?php include 'Inc/users.php'; ?>
                            <?php include 'Inc/book.php'; ?>
                            <?php include 'Inc/configuration.php'; ?>
                            <!-- Pour l'ajout d'élément activer le hr à la fin du dernier élément présent -->
                            <?php include 'Inc/account.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- /.page -->