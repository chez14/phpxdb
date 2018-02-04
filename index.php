<?php

require_once "inc/app.php";

$emots = get_all_emoticons();
$comments = get_all_comments();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comment Board</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-8">
                    <h2 class="title is-3 has-text-weight-light">Say Something!</h2>
                    <form action="post-comment.php" class="form" method="post">
                        <label class="label is-small">Identity</label>
                        <div class="field has-addons">
                            <div class="control is-expanded">
                                <input class="input is-small" type="text" placeholder="Izuku Midoriya" name="name">
                            </div>
                            <div class="control is-expanded">
                                <input class="input is-small" type="email" placeholder="izuku@midoriya.net" name="email">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label is-small">Comment</label>
                            <div class="control">
                                <textarea class="textarea is-small" placeholder="I've beaten Bakugo!" name="comment"></textarea>
                            </div>
                        </div>

                        <label class="label is-small">Available Emoticons</label>
                        <section>
                            <?php foreach($emots as $emo): ?>
                            <div class="emo-box">
                                <figure class="image is-32x32">
                                    <img src="<?= $emo['emo_location'] ?>" alt="">
                                </figure>
                                <p class="has-text-primary"><?= $emo['emo_tag'] ?></p>
                            </div>
                            <?php endforeach; ?>
                        </section>
                            
                        <div class="field is-grouped is-grouped-right">
                            <p class="control">
                                <button class="button is-primary" type="submit">
                                    Submit
                                </button>
                            </p>
                            <p class="control">
                                <button class="button is-light" type="reset">
                                    Reset
                                </button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="columns">
                <div class="column is-8">
                    <h2 class="title is-3 has-text-weight-light">Comments</h2>
                    <div class="columns">
                        <?php foreach($comments as $comment): ?>
                        <div class="column is-6">
                            <div class="box">
                                <article class="media">
                                    <div class="media-left">
                                        <figure class="image is-64x64">
                                            <?php
                                            /**
                                             * Avatar are coming from Gravatar. Please checkout their API on
                                             * http://en.gravatar.com/site/implement/images/
                                             */
                                            ?>
                                            <img src="https://www.gravatar.com/avatar/<?= md5($comment['email']) ?>" alt="avatar">
                                        </figure>                                    
                                    </div>
                                    <div class="media-content">
                                        <div class="content">
                                            <?php
                                                /**
                                                 * Using htmlentities to escape some script are important!
                                                 * This will prevent vulnerabilities to do XSS Injection!
                                                 * 
                                                 * Learn more at: https://en.wikipedia.org/wiki/Cross-site_scripting
                                                 * ***
                                                 * Emoticons are part of html code, so we need to htmlentities it
                                                 * first the comment before we do emoticonate! So the emoticonate
                                                 * are not throwing random html parts.
                                                 */
                                            ?>
                                            <p>
                                                <strong><?= htmlentities($comment['display_name']) ?></strong>
                                                <small><?= date("j M Y", strtotime($comment['created_date'])) ?></small>
                                                <br>
                                                <?= emoticonate(htmlentities($comment['comments'])) ?>
                                            </p>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>