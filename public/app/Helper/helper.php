<?php

use Illuminate\Support\Facades\Auth;

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

function create_revenue_expenditures($name, $money = 0, $type = 1)
{
    \App\Models\RevenueAndExpenditure::create([
        'name' => $name,
        'money' => $money,
        'type' => $type,
        'user_id' => \Illuminate\Support\Facades\Auth::user()->id,
    ]);
}

function get_branch_id()
{
    if (!\Auth::check()) {
        return false;
    }

    return \Auth::user()->branch_id ?? null;
}
