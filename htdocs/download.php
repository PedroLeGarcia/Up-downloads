<?php
if (isset($_GET['file'])) {
    $file_path = 'uploads/' . $_GET['file'];
    
    if (file_exists($file_path)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
        header('Content-Length: ' . filesize($file_path));
        
        readfile($file_path);
    } else {
        echo "O arquivo não foi encontrado.";
    }
} else {
    echo "Nenhum arquivo selecionado para download.";
}
?>
