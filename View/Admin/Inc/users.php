<?php if ($_SESSION['auth']->getRole() >= \App\Model\User::ADMIN) : ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="section-title">
                <a data-toggle="collapse" class="white" data-parent="#accordion" href="#collapseThree">Gestion des utilisateurs</a>
            </h3>
            <br/>
        </div>
        <div id="collapseThree" class="collapse">
            <div class="row">
                <div class="form-container col-sm-push-1 col-sm-4">
                    <h5 class="">Utilisateurs</h5>
                    <div class="response alert alert-success"></div>
                    <form class="" action="/user/banned" method="post">
                        <fieldset>
                            <div class="form-row text-input-row email-field">
                                <select name="id" class="col-sm-12">
                                    <?php foreach ($users as $user) : ?>
                                        <option value="<?php echo $user['id']; ?>">
                                            <?php echo $user['firstname'] . ' ' . $user['lastname']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="button-row tm31">
                                <button type="submit" name="banned" value="submit" class="btn btn-red bm0 pull-right">Bannir</button>
                                <?php unset($_SESSION['bannedForm']); ?>
                                <?php unset($_SESSION['bannedErrors']); ?>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-sm-push-2 col-sm-5">
                    <h5 class="">Utilisateurs bannis</h5>
                    <ul id="comments">
                        <?php if (empty($usersBanned)) : ?>
                            <li>Aucun utilisateur banni</li>
                        <?php else: ?>
                            <?php foreach ($usersBanned as $user) : ?>
                                <li>
                                    <p class="nomarge"><b class="blue"><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></b> - <span
                                            class="meta"><a class="grey" href="/user/<?php echo $user['id']; ?>/approve">Débloquer</a></span>
                                    </p>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <hr/>
    </div>
<?php endif; ?>