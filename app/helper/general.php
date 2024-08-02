<?php

function menus() {
    $menus= App\Models\Page::where('active',1)->get();
    return $menus;
}
function categories() {
    $menus= App\Models\Category::where('active',1)->get();
    return $menus;
}

?>