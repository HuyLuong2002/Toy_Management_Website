<?php

require_once('../lib/tcpdf/tcpdf.php');

class PDFGenerator {

    private $pdf;

    public function __construct() {
        $this->pdf = new TCPDF('P', 'mm', 'A5', true, 'UTF-8', false);
    }

    public function setDocumentInformation($creator, $author, $title, $subject) {
        $this->pdf->SetCreator($creator);
        $this->pdf->SetAuthor($author);
        $this->pdf->SetTitle($title);
        $this->pdf->SetSubject($subject);
    }

    public function addPage() {
        $this->pdf->AddPage();
    }

    public function setFont($fontName, $fontStyle, $fontSize) {
        $this->pdf->SetFont($fontName, $fontStyle, $fontSize);
    }

    public function formatText($width, $height, $text, $border, $auto_enter = 1, $formatValue) {
        $this->pdf->Cell($width, $height, $text, $border, $auto_enter, $formatValue);
    }

    public function formatTextDistance($width, $height, $text, $border) {
        $this->pdf->Cell($width, $height, $text, $border);
    }


    public function writeText($text) {
        $this->pdf->Write(0, $text);
    }

    public function enterLine()
    {
        $this->pdf->Ln(); // Xuống dòng
    }
    public function outputFile($filename) {
        $pdf_data = $this->pdf->Output('', 'S');
        // write PDF data to a file on your server
        file_put_contents($filename, $pdf_data);
    }

}

?>
