<?php

namespace ExtrasMe\Http\Controllers;

use Illuminate\Http\Request;

use ExtrasMe\Http\Requests;
use ExtrasMe\Http\Controllers\Controller;

class DocumentsController extends Controller
{
    /**
     * Display the about us page
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        view('documents.about')
    }

}
