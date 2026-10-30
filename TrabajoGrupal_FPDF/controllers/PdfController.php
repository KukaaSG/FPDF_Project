<?php
declare(strict_types=1);
require_once __DIR__ . '/../fpdf19/fpdf.php';

class PdfController extends FPDF {
    private array $dataset = array();

    public function Header(): void {
        if (file_exists(__DIR__ . '/../fpdf19/tutorial/logo.png')) {
            $this->Image(__DIR__ . '/../fpdf19/tutorial/logo.png', 10, 10, 28);
        }
        $this->SetFont('Helvetica', 'B', 16);
        $this->SetTextColor(33, 37, 41);
        $this->Cell(35);
        $this->Cell(0, 10, utf8_decode('REPOSITORIO DE AUDIOESTRUCTURAS'), 0, 1, 'L');
        
        $this->SetFont('Helvetica', 'I', 10);
        $this->SetTextColor(108, 117, 125);
        $this->Cell(35);
        $this->Cell(0, 6, utf8_decode('Reporte Dinámico - Arquitectura de Software MVC'), 0, 1, 'L');
        
        $this->SetDrawColor(222, 226, 230);
        $this->Line(10, 35, 200, 35);
        $this->Ln(15);
    }

    public function Footer(): void {
        $this->SetY(-15);
        $this->SetFont('Helvetica', 'I', 8);
        $this->SetTextColor(108, 117, 125);
        $this->Cell(100, 10, utf8_decode('Módulo de Implantación de Aplicaciones Web | 2º DAW'), 0, 0, 'L');
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'R');
    }

    public function generarPDF(array $playlist): void {
        $this->dataset = $playlist;
        
        $this->AliasNbPages();
        $this->AddPage('P', 'A4');
        $this->SetAutoPageBreak(true, 20);
        
        $this->SetFont('Helvetica', 'B', 12);
        $this->SetTextColor(49, 53, 59);
        $this->Cell(0, 10, utf8_decode('REGISTRO DE TEMAS ALMACENADOS EN EL MODELO'), 0, 1, 'L');
        $this->Ln(2);
        
        $this->SetFillColor(33, 37, 41);
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(33, 37, 41);
        $this->SetLineWidth(0.2);
        $this->SetFont('Helvetica', 'B', 10);

        $this->Cell(20, 9, 'ID', 1, 0, 'C', true);
        $this->Cell(65, 9, utf8_decode('Título'), 1, 0, 'L', true);
        $this->Cell(65, 9, 'Artista', 1, 0, 'L', true);
        $this->Cell(40, 9, utf8_decode('Género'), 1, 1, 'C', true);

        $this->SetFont('Helvetica', '', 10);
        $this->SetTextColor(33, 37, 41);
        $this->SetDrawColor(222, 226, 230);

        $alternate = false;
        foreach ($this->dataset as $row) {
            if ($alternate) {
                $this->SetFillColor(248, 249, 250);
            } else {
                $this->SetFillColor(255, 255, 255);
            }
            
            $this->Cell(20, 8, (string)$row['id'], 1, 0, 'C', true);
            $this->Cell(65, 8, utf8_decode($row['titulo']), 1, 0, 'L', true);
            $this->Cell(65, 8, utf8_decode($row['artista']), 1, 0, 'L', true);
            $this->Cell(40, 8, utf8_decode($row['genero']), 1, 1, 'C', true);
            
            $alternate = !$alternate;
        }

        $this->Output('I', 'playlist_daw.pdf');
        exit;
    }
}



