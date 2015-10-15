<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?=$this->title?></title>
    <?=$this->css('bootstrap.min')?>
    <?=$this->css('font-awesome.min')?>
    <?=$this->css('bonus')?>
</head>
<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="https://github.com/marcelobns/bonus/">
                        PHP Bonus Framework
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <main class="container">
        <?php require($this->template) ?>
    </main>
    <footer class="footer">
        <div class="container">
            <p class="text-center">
                <a class="text-muted" href="http://anotherwise.io">
                    <i class="fa fa-creative-commons"></i>
                    anotherwise.io
                </a>
            </p>
        </div>
    </footer>
    <?=$this->js('jquery.min')?>
    <?=$this->js('bootstrap.min')?>
    <?=$this->script()?>
</body>
</html>
