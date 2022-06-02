<?php

// use App\Core\Controller;
use Dompdf\Dompdf;

class Pdf extends App\Core\Controller
{
    public function index($note = '')
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        ob_start();
        require 'teste.php';
        $dompdf->loadHtml(ob_get_clean());

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("arquivo pdf", ["Attachment" => false]);

        $this->view('pdf/index');
    }
}