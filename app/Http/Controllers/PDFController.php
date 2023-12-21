<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \setasign\Fpdi\Fpdi;
use App\Models\Producto;

class PDFController extends Controller
{

    // Load data
    function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }

    function ImprovedTable($header, $data)
    {
        // Column widths
        $w = array(40, 35, 40, 45);
        // Header
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
        $this->Ln();
        // Data
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR');
            $this->Cell($w[1],6,$row[1],'LR');
            $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
            $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
            $this->Ln();
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }

    public function generarPDF()
    {
        // Instanciar FPDF
        $pdf = new Fpdi();

        // Column headings
        $header = array('Nombre', 'Tamaño', 'Cantidad');

        $data = Producto::getAllProductos();

        // Agregar una página
        $pdf->AddPage();

        // Establecer fuente y tamaño del texto
        $pdf->SetFont('Arial','',14);

        // Agregar texto
        $pdf->ImprovedTable($header,$data);

        // Salida del PDF (descarga o visualización)
        $pdf->Output();
    }


}
