<?php

namespace App\Http\Controllers;

use App\Models\DocumentTemplate;

class DocumentTemplateController extends Controller
{
    public function index()
    {
        $templates = DocumentTemplate::all()->groupBy('category');
        return view('templates.index', compact('templates'));
    }
}
