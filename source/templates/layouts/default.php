<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?=@$this->title?></title>
    <?=$this->css('bootstrap.min')?>
    <?=$this->css('bonus')?>
</head>
<body>
    <header class="default-header">

    </header>
    <main class="container">
        <?php require($this->template) ?>
    </main>
    <footer class="default-footer">

    </footer>
    <?=$this->js('jquery.min')?>
    <?=$this->js('bootstrap.min')?>
    <?=$this->script()?>
</body>
</html>
