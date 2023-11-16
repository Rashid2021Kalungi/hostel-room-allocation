<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    <?php
    $style=glob("css/*.css");
    foreach($style as $css) require $css;
    ?>
</style>
<body>