<?php
function get_price($price, $suffixes = '')
{
    if (empty($price)) {
        return 0 . ' ' . $suffixes;
    }
    return number_format($price) . ' ' . $suffixes;
}

?>
