<section id="about">
    <div class="box">
        <div class="row">
            <?php if (!empty($book->getImgUrl())) : ?>
            <div class="col-md-5 col-md-push-7 col-sm-12">
                <figure class="frame"><img src="<?php echo $book->getImgUrl(); ?>" alt=""/></figure>
            </div>
            <div class="col-md-7 col-md-pull-5 col-sm-12">
                <?php else: ?>
                <div class="col-sm-12">
                    <?php endif; ?>
                    <h2 class="section-title"><a href="/page"><?php echo $book->getTitle(); ?></a></h2>
                    <p class="lead"><?php echo $book->getSubtitle(); ?></p>
                    <p><?php echo nl2br($book->getSummary()); ?></p>
                    <p class="text-right"><?php echo $book->getFirstname() . ' ' . $book->getLastname(); ?></p>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="clearfix"></div>
        </div>
        <!-- /.box -->
</section>
<!-- /#about -->