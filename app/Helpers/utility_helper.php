<?php

# 1- Make a helper file and put following code in there
# 2- Auto-load it
# 3- call `register_ci_instance($this)` at the very beginning in your base controller
# 4- use `$ci = &get_instance()` anywhere you want. FYI: I'm not sure if `&` is even necessary when calling `get_instance`.

# Also, you may change `\App\Controllers\BaseController` for better IDE autocomplete support.
# Tested on PHP8

$CI_INSTANCE = [];  # It keeps a ref to global CI instance

function register_ci_instance(\App\Controllers\Core\BaseController &$_ci) {
    global $CI_INSTANCE;
    $CI_INSTANCE[0] = &$_ci;
}


function &get_instance(): \App\Controllers\Core\BaseController {
    global $CI_INSTANCE;
    return $CI_INSTANCE[0];
}