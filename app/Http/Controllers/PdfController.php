<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function viewPdf()
    {
        $companies = Company::all();
        $view = \View::make('pdf', ['companies'=>$companies]);
        $html_content = $view->render();
        $arrr = []
            $arr['date'] = $arr['date']['BCC'] = $row->weigt?? 0
//        $html = '<h1>Hello TCPDF</h1>';
        PDF::SetTitle('Hello World');
        PDF::AddPage();
        PDF::writeHTML($html_content, true, false, true, false, '');
        PDF::Output('hello_world.pdf');
    }
}
