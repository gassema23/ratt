<?php

if (!function_exists('Greeting')) {
    function Greeting()
    {
        $hour = date('H');
        if ($hour >= 18) {
            $greeting = trans("Good Evening");
        } elseif ($hour >= 12) {
            $greeting = trans("Good Afternoon");
        } elseif ($hour < 12) {
            $greeting = trans("Good Morning");
        }
        return $greeting;
    }
}
