<?php

function footer(bool $footer = true): void{
    if (! $footer){
        return;
    }
    include "src/components/footer.php";
}

function nav(bool $nav = true): void{
    if (! $nav){
        return;
    }
    include "src/components/header.php";
}

?>