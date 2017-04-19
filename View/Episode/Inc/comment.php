<?php
if (isset($comment->children)) : ?>
    <ul class="children">
        <?php foreach ($comment->children as $comment) : ?>
            <li>
                <div class="message" id="comment-<?php echo $comment->id; ?>">
                    <div class="info">
                        <h2><?php echo $comment->firstname . ' ' . $comment->lastname; ?></h2>
                        <div class="meta">
                            <div class="date"><?php echo $comment->date; ?></div>
                            <?php if ($_SESSION['auth']->getRole() >= \App\Model\User::MEMBER) : ?>
                                <?php if ($comment->report == 0) : ?>
                                    <button class="reply" data-id="<?php echo $comment->id; ?>">répondre</button>
                                    <a href="/comment/<?php echo $comment->id; ?>/report" class="report">signaler</a>
                                <?php else : ?>
                                    <span><em>Commentaire déjà signalé</em></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <p><?php echo $comment->content; ?></p>
                </div>
                <?php
                if (isset($comment->children)) :
                    include 'comment.php';
                endif;
                ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>