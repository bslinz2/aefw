<?php

// Defination der Navbar Links
$links = [
    'index' => 'Anzeigen',
    'insert' => 'Hinzufügen',
    
];

?>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button
                aria-expanded="false"
                class="navbar-toggle" 
                data-target="#aefwNavbar"
                data-toggle="collapse"
                type="button"
            >
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <?php echo e($applicationName) ?>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="aefwNavbar">
            <ul class="nav navbar-nav">
                <?php foreach($links as $link => $name): ?>
                    <li class="<?php echo $link == $currentPageKey ? 'active' : '' ?>">
                        <a href="/index.php?page=<?php echo $link ?>">
                            <?php echo e($name) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>