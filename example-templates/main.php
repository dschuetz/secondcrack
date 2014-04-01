<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <link rel="alternate" type="application/rss+xml" title="RSS" href="/rss.xml" />
        <meta name="viewport" content="width=device-width" />
        <link rel="apple-touch-icon-precomposed" href="/apple-touch-icon.png"/>
        <link rel="stylesheet" href="/main.css"/>
        <title><?= 
            (isset($content['post']) ? h($content['post']['post-title']) . ' &ndash; ' : '') . 
            ($content['page-title'] != $content['blog-title'] && (
                $content['page-type'] == 'page' || $content['page-type'] == 'archive' || $content['page-type'] == 'tag' || $content['page-type'] == 'type' 
            ) ? h($content['page-title']) . ' &ndash; ' : '') . 
            h($content['blog-title']) 
        ?></title>

        <? if ($content['page-type'] != 'frontpage' && $content['page-type'] != 'page' && $content['page-type'] != 'post') { ?>
            <meta name="robots" content="noindex"/>
        <? } ?>

    </head>
    <body>
        <div id="mastheadbackground">&nbsp;</div>
        
        <section id="posts">

            <div id="masthead">
                <h1><a href="/">DarthNull.org</a>
            </div>
            <div id="topicon" class="fa_normal">
		        <img src="/media/GandalfIcon2.jpg" width="125" height="125"/>
            </div>

            <div id="fullabout" class="fa_normal">
                <p id="description">
                Hello! I'm <a href="/about" rel="author">David Schuetz</a>, 
                or <a href="https://twitter.com/DarthNull">@DarthNull</a> on Twitter.I
                <br/>Insert short 5-word bio here.
                </p>

                <nav>
                    <a href="/about">About</a>
                    &bull;
                    <a href="/tagged-presentations">Presentations</a>
                    &bull;
                    <a href="/tagged-bestof">Best Of</a>
                    &bull;
                    <a href="https://twitter.com/DarthNull">Twitter</a>
                </nav>
            </div>

            <? if ($content['page-type'] == 'page') { ?>
                <article>
                    <header>
                        <h2><?= h($content['page-title']) ?></h2>
                    </header>
                    <?= $content['page-body'] ?>
                </article>
            <? } else { ?>
                <? if (isset($content['posts'])) foreach ($content['posts'] as $post) { ?>
                    <article<?= $post['post-type'] == 'link' ? ' class="link"' : '' ?>>
                        <header>
                            <h2>
                                <a href="<?= h($post['post-permalink-or-link']) ?>"><?= h($post['post-title']) ?></a>
                                <?= $post['post-type'] == 'link' ? '<span class="linkarrow">&rarr;</span>' : '' ?>
                            </h2>

                            <p>
                                <time datetime="<?= h(date('c', $post['post-timestamp'])) ?>" pubdate="pubdate"><?= date('F j, Y', $post['post-timestamp']) ?></time>
                                &bull;
                                <a class="permalink" title="Permalink" href="<?= h($post['post-permalink']) ?>">∞</a>
                            </p>
                            <!-- put tags here -->
                            <? $first = true;
                               foreach ($post['post-tags'] as $tag) {
                                 $tagname = $tag['post-tag'];
                                 if ($first) {
                                    $first = false;
                                 } else {
                                   echo('&bull;');
                                 }
                            ?>
                                <a href="/tagged-<?= $tagname ?>"><?= $tagname ?></a>
                            <? } ?>

                        </header>
                    
                        <?= $post['post-body'] ?>
                    </article>
                <? } ?>
            <? } ?>
            
            <? if (!empty($content['archives'])) { ?>
                <nav id="archives">
                    <h3>Archives</h3> 
                    <div style="clear: both; font-size: 1px; line-height: 1px;">&nbsp;</div>
                    <div style="float: left; width: 90px; text-align: right; padding-bottom: 2em;">
                        <? $so_far = 0; $per_column = ceil(count($content['archives']) / 5); ?>
                        <? foreach ($content['archives'] as $archive) { ?>
                            <? if (++$so_far > $per_column) { ?>
                                <? $so_far = 1; ?>
                                </div>
                                <div style="float: left; width: 90px; text-align: right;">
                            <? } ?>
                            <a href="<?= h($archive['archives-uri']) ?>"><?= $archive['archives-month-short-name'] ?>&nbsp;<?= $archive['archives-year'] ?></a>
                            <br/>
                        <? } ?>
                    </div>
                    <div style="clear: both; font-size: 1px; line-height: 1px;">&nbsp;</div>
                </nav>
            <? } ?>
            
            <footer>
                <p>Content &copy; 2010-2014 David Schuetz. All rights reserved.</p>
                <p>
                    <a href="/rss.xml">RSS feed</a>.
                    Powered by <a href="https://github.com/marcoarment/secondcrack">Second Crack</a>, written by <a href="http://marco.org">Marco Arment</a>.
                </p>

            </footer>





        </section>
    </body>
</html>
