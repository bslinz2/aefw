<?php

$links = [
    '/l1' => 'Link 1',
    '/l2' => 'Link 2',
];

?>

<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
            <a class="navbar-brand" href="/">Frederic Köberl</a>
        </div><!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php foreach($links as $link => $name): ?>
                    <li>
                        <a href="<?php echo $link ?>">
                            <?php echo $name ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<style>
    .navbar {
        border-radius: 0 !important;
    }
</style>