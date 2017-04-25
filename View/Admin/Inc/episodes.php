<?php if ($_SESSION['auth']->getRole() >= \App\Model\User::ADMIN) : ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="section-title">
                <a data-toggle="collapse" class="white" data-parent="#accordion" href="#collapseTwo">Gestion des épisodes et commentaires</a>
            </h3>
            <br/>
        </div>
        <div id="collapseTwo" class="collapse">
            <div class="row">
                <div class="col-sm-push-1 col-sm-5">
                    <h5 class="">Episodes non publiés</h5>
                    <ul class="circled">
                        <?php foreach ($ticketsNoPublish as $ticket) : ?>
                            <li>
                                <a href="/episode/<?php echo $ticket['number']; ?>">
                                    <?php echo '(' . $ticket['number'] . ') ' . $ticket['title']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <br/>
                    <br/>
                    <ul class="tag-list">
                        <li><a href="/episode/create" class="btn">Créer un épisode</a></li>
                    </ul>
                </div>
                <div class="col-sm-push-1 col-sm-5">
                    <h5 class="">Commentaires signalés</h5>
                    <?php if (empty($listCommentsReport)) : ?>
                        <p>Aucun commentaire signalé.</p>
                    <?php else: ?>
                        <ol id="comments">
                            <?php foreach ($listCommentsReport as $commentReport) : ?>
                                <li>
                                    <p class="nomarge"><b>Episode n°<?php echo $commentReport['number'] . ' - ' . $commentReport['title']; ?></b></p>
                                    <p class="nomarge blue"><b><?php echo $commentReport['firstname'] . ' ' . $commentReport['lastname']; ?></b></p>
                                    <p class="nomarge"><?php echo $commentReport['content']; ?></p>
                                                            <span class="meta">
                                                                <a class="approve grey" href="/comment/<?php echo $commentReport['id']; ?>/approve">Approuver</a>
                                                                <a class="report" href="/comment/<?php echo $commentReport['id']; ?>/delete">Supprimer</a>
                                                            </span>
                                    <hr/>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <hr/>
    </div>
<?php endif; ?>