<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" type="image/png" href="public/img/favicon.png"/>
    <title><?=@$this->title?></title>
    <?=$this->css('bootstrap.min')?>
    <?=$this->css('calendar')?>
</head>
<body>
    <main class="container-fluid">
        <?php require($this->template) ?>
    </main>
    <!-- <?=$this->js('jquery.min')?> -->
    <?=$this->script()?>
</body>
</html>
