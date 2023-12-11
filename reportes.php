<?php
require('pdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página

function Header()
{
    $this->Image('1.png', 185, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('TIENDA DE PRODUCTOS MYS'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Ubicación : Jr San Roman 123"), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono :95476638 "), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Correo :teatiende2021@gmail.com "), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Sucursal : juliaca"), 0, 0, '', 0);
      $this->Ln(10);

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(228, 100, 0);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("LISTA DE PRODUCTOS"), 0, 1, 'C', 0);
      $this->Ln(7);
    
    // Arial bold 15
    $this->Ln(10);
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(-200);
    // Título
    //$this->Cell(70,10,'Reporte de productos',0,0,'C');*//
    // Salto de línea
    //$this->Ln(20);
    
}


// Pie de página
function Footer()
{
   $this->SetFillColor(20.05,19);
   $this->Rect(0,270,220,30,'F');
   $this->SetY(-20); //sube las letras
   $this->SetFont('Arial','',10);
   $this->SetTextColor(255,255,255);
   $this->SetX(90);
   $this->Write(5, 'HACEMOS ENVIOS POR TODO LA REGION PUNO');
   $this->Ln();
   $this->SetX(70);
   $this->Write(5,' Direccion: Jr San Roman 123');
   $this->Ln();
   $this->SetX(80);
   $this->Write(5,'    Contactos: 78819752-78926348');
}

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

$pdf->SetY(70);
$pdf->SetX(45);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,59,120);
$pdf->Cell(50,9, 'Nombre de Producto', 0 ,0, 'C',1);
$pdf->Cell(17,9, 'Precio', 0 ,0, 'C',1);
$pdf->Cell(50,9, 'Stok', 0 ,1, 'C',1);





include('db.php');
require('db.php');
$consulta = "SELECT*FROM productos";
$resultado = mysqli_query($conexion,$consulta);


$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(240,245,255);

while($row = $resultado->fetch_assoc()){
    $pdf->SetX(45);
    $pdf->Cell(50,9, $row['titulo'], 0 ,0, 'C',1);
    $pdf->Cell(17,9, $row['precio_normal'], 0 ,0, 'C',1);
    $pdf->Cell(50,9, $row['stock'], 0 ,1, 'C',1);
    
  
    /*$pdf->Cell(25,9, $row['status'], 0 ,1, 'C',1);*/
  
}

$pdf->Output();
