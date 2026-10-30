<?php
declare(strict_types=1);

class CancionModel {
    public function add(array $playlist, array $formData): array {
        $titulo = isset($formData['titulo']) ? trim($formData['titulo']) : '';
        $artista = isset($formData['artista']) ? trim($formData['artista']) : '';
        $genero = isset($formData['genero']) ? trim($formData['genero']) : '';

        if ($titulo === '' || $artista === '' || $genero === '') {
            return $playlist;
        }

        $nuevaCancion = array(
            'id' => count($playlist) + 1,
            'titulo' => $titulo,
            'artista' => $artista,
            'genero' => $genero
        );

        $playlist[] = $nuevaCancion;
        return $playlist;
    }
}



