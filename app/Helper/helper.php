<?php
function get_price($price, $suffixes = '')
{
    if (empty($price)) {
        return 0 . ' ' . $suffixes;
    }
    return number_format($price) . ' ' . $suffixes;
}

function create_log($subject)
{
    \App\Repositories\LogRepository::instance()->store($subject);
}

?>
