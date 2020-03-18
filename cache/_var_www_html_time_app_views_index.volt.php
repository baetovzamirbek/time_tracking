<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <?= $this->tag->getTitle() ?>
        <?= $this->tag->stylesheetLink('css/bootstrap.min.css') ?>
        <?= $this->tag->stylesheetLink('css/style.css') ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Time ">
        <meta name="author" content="Phalcon Team">
    </head>
    <body>
        <?= $this->getContent() ?>
        <?= $this->tag->javascriptInclude('js/jquery-3.4.1.min.js') ?>  
        <?= $this->tag->javascriptInclude('js/myscript.js') ?>
    </body>
</html>