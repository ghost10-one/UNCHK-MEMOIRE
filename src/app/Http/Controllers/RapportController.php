<?php

namespace App\Http\Controllers;

use App\Exports\VisitesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class RapportController extends Controller
{

    public function index()
    {
        return view('rapports.index');
    }

    public function exportVisites()
    {
        return Excel::download(new VisitesExport, 'registre-visites-' . now()->format('Y-m-d') . '.xlsx');
    }
}
