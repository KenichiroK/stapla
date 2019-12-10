<?php

// タスクのステータスの数を返す
if (!function_exists('countTaskStatus'))
{
    function countTaskStatus($status_arr, int $first_index, int $last_index)
    {
        $_status_arr = array_slice($status_arr, $first_index, ($last_index - $first_index + 1));
        return array_reduce($_status_arr, function($carry, $item) {
            $carry += $item;
            return $carry;
        });
    }
}
