<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Producto;

class PDFController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }

    public function generarPDF()
    {
        $this->fpdf->AddPage();
        // Cabecera de la tabla
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Cell(50, 10, 'Nombre', 1);
        $this->fpdf->Cell(65, 10, 'Descripcion', 1);
        $this->fpdf->Cell(25, 10, 'Cantidad', 1);
        $this->fpdf->Cell(25, 10, 'Precio', 1);
        $this->fpdf->Cell(30, 10, 'Monto', 1);
        $this->fpdf->Ln();

        // Datos de la tabla (obtener datos de la base de datos)
        $productos = Producto::getAllProductos(); // Obtener todos los productos

        $this->fpdf->SetFont('Arial', 'B', 9);

        foreach ($productos as $producto) {
             // Establecer coordenadas actuales
             $x = $this->fpdf->GetX();
             $y = $this->fpdf->GetY();
              
             // Establecer el ancho de cada celda
             $nombreWidth = 50;
             $descripcionWidth = 70;
             $cantidadWidth = 30;
             $precioWidth = 30;
 
              // Establecer el contenido para cada celda
            $nombre = $producto->nombre;
            $descripcion = $producto->descripcion;
            $cantidad = $producto->cantidad;
            $precio = $producto->precio;          
 
             // Obtener la altura máxima necesaria para la fila actual
            $alturaMaxima = max(
                $this->getStringHeight($nombre, $nombreWidth),
                $this->getStringHeight($descripcion, $descripcionWidth),
                $this->getStringHeight($cantidad, $cantidadWidth),
                $this->getStringHeight($precio, $precioWidth)
            );

            // Dibujar las celdas con el alto máximo calculado
            $this->fpdf->SetXY($x, $y);
            $this->fpdf->MultiCell($nombreWidth, 10/2, utf8_decode($nombre), 1);

            $this->fpdf->SetXY($x + $nombreWidth, $y);
            $this->fpdf->MultiCell($descripcionWidth, 10/2, utf8_decode($descripcion), 1);

            $this->fpdf->SetXY($x + $nombreWidth + $descripcionWidth, $y);
            $this->fpdf->MultiCell($cantidadWidth, 10, utf8_decode($cantidad), 1);

            $this->fpdf->SetXY($x + $nombreWidth + $descripcionWidth + $cantidadWidth, $y);
            $this->fpdf->MultiCell($precioWidth, 10, utf8_decode($precio), 1);


            // Mover a la siguiente fila
            $this->fpdf->SetY($y + $alturaMaxima);
        }

        $this->fpdf->Output();

        exit;
    }

    function getStringHeight($text, $width) {
        $fontFamily = "Arial";
        $fontSize = 9;

        // Obtenemos la anchura del texto en función de la fuente actual
        $textWidth = $this->fpdf->GetStringWidth($text);

        // Calculamos la cantidad de líneas que necesitará el texto en función del ancho de la celda
        $numLines = ceil($textWidth / $width);

        // Calculamos la altura aproximada multiplicando el número de líneas por la altura de la fuente
        $height = $numLines * $fontSize;

        return $height;
    }

}
