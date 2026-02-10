<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Redirect guru to Filament admin panel.
     */
    public function dashboard()
    {
        // Redirect guru ke admin panel Filament
        return redirect('/admin');
    }
}
