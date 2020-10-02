<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RahasiaController extends Controller
{
    public function halamanRahasia()
    {
        return 'Anda sedang melihat <strong>Halaman Rahasia</strong>';
    }

    public function showMeSecret()
    {
        $url = route('secret');
        $link = '<a href="' . $url . '">ke halaman rahasia</a>';
        return $link;
    }
}
