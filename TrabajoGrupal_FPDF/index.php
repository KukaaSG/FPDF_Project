<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/models/CancionModel.php';
require_once __DIR__ . '/controllers/PdfController.php';

if (!isset($_SESSION['playlist'])) {
    $_SESSION['playlist'] = array();
}

$action = $_GET['action'] ?? 'index';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['agregar'])) {
        $model = new CancionModel();
        $_SESSION['playlist'] = $model->add($_SESSION['playlist'], $_POST);
        header('Location: index.php');
        exit;
    }
    
    if (isset($_POST['generar']) && !empty($_SESSION['playlist'])) {
        $controller = new PdfController();
        $controller->generarPDF($_SESSION['playlist']);
    }
}

if ($action === 'clear') {
    $_SESSION['playlist'] = array();
    header('Location: index.php');
    exit;
}

include __DIR__ . '/views/formularioView.php';


