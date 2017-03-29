<?php $this->title = "TITRE DU LIVRE A METTRE" ?>

<div class="container inner">
    <div class="blog list-view row">
        <div class="col-md-8 col-sm-12 content">
            <div class="blog-posts">

                <?php foreach ($tickets as $ticket) : ?>
                    <div class="post box">
                        <div class="row">
                            <div class="col-sm-push-1 col-sm-3">

                                <figure class="frame">
                                    <a href="blog-post.html">
                                        <div class="text-overlay">
                                            <div class="info">
                                                <span>Read More</span>
                                            </div>
                                        </div>
                                        <img src="<?php echo $ticket['url']; ?>" alt=""/>
                                    </a>
                                </figure>
                            </div>
                            <!-- /column -->
                            <div class="col-sm-push-1 col-sm-7 post-content">
                                <div class="meta">
                                    <span class="category"><?php echo $ticket['firstname'] . ' ' . $ticket['lastname']; ?></span>
                                    <span class="date"><?php echo $ticket['date'] ?></span>
                                <span class="comments">
                                    <a href="#">8 <i class="icon-chat-1"></i></a>
                                </span>
                                </div>
                                <h2 class="post-title"><a href="/episode/<?php echo $ticket['number']; ?>"><?php echo $ticket['title'] ?></a></h2>
                                <p><?php echo $ticket['content'] ?></p>
                            </div>
                            <!-- /column -->
                        </div>
                        <!-- /.row -->
                    </div>
                <?php endforeach; ?>
                <!-- /.post -->

            </div>
            <!-- /.blog-posts -->

            <div class="pagination box">
                <ul>
                    <li><a href="#" class="btn">Prev</a></li>
                    <li class="active"><a href="#" class="btn"><span>1</span></a></li>
                    <li><a href="#" class="btn"><span>2</span></a></li>
                    <li><a href="#" class="btn"><span>3</span></a></li>
                    <li><a href="#" class="btn">Next</a></li>
                </ul>
            </div>
            <!-- /.pagination -->

        </div>
        <!-- /.content -->
        <aside class="col-md-4 col-sm-12 sidebar">

            <div class="sidebox box widget">
                <h3 class="widget-title section-title">Episodes</h3>
                <ul class="circled">
                    <?php foreach ($tickets as $ticket) : ?>
                        <li><a href="/episode/<?php echo $ticket['number']; ?>"><?php echo $ticket['title']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- /.widget -->

            <div class="sidebox box widget">
                <h3 class="widget-title section-title">Tags</h3>
                <ul class="tag-list">
                    <li><a href="#" class="btn">Web</a></li>
                    <li><a href="#" class="btn">Photography</a></li>
                    <li><a href="#" class="btn">Illustation</a></li>
                    <li><a href="#" class="btn">Fun</a></li>
                    <li><a href="#" class="btn">Blog</a></li>
                    <li><a href="#" class="btn">Design</a></li>
                    <li><a href="#" class="btn">Inspiration</a></li>
                    <li><a href="#" class="btn">Tips</a></li>
                    <li><a href="#" class="btn">Manipulation</a></li>
                    <li><a href="#" class="btn">Graphic</a></li>
                    <li><a href="#" class="btn">Travel</a></li>
                    <li><a href="#" class="btn">Concept</a></li>
                </ul>
                <!-- /.tag-list -->
            </div>
            <!-- /.widget -->

        </aside>
        <!-- /column .sidebar -->
    </div>
    <!-- /.blog -->
</div>
<!-- /.container -->