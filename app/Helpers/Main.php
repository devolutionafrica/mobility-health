<?php


if (!function_exists("urlGen")) {
    /**
     * Génère une URL avec des paramètres spécifiés.
     *
     * @param string $src URL source de l'image.
     * @param int $width Largeur de l'image (par défaut 200).
     * @param int $height Hauteur de l'image (par défaut 200).
     * @param string $fit Mode de redimensionnement de l'image. Options possibles :
     * - "contain"
     * - "stretch"
     * - "fill-max"
     * - "fill"
     * - "max"
     * - "crop-top-left"
     * - "crop"
     * - "crop-top"
     * - "crop-top-right"
     * - "crop-left"
     * - "crop-center"
     * - "crop-right"
     * - "crop-bottom-left"
     * - "crop-bottom"
     * @param int $quality Qualité de l'image (par défaut 50).
     * @param string $format Format de l'image. Options possibles :
     * - "png"
     * - "gif"
     * - "webp"
     * - "avif"
     * - "jpg"
     * - "pjpg"
     * @return string URL générée avec les paramètres spécifiés.
     */
    function urlGen(string $src, int $width = 200, int $height = 200, string $fit = 'crop', int $quality = 50, string $format = 'webp'): string
    {
        $baseUrl = config('app.url') . '/';
        $url = str_starts_with($src, "http") ? $src : $baseUrl .'mh/'. $src;

        $query = http_build_query([
            'fit' => $fit,
            'w' => $width,
            'h' => $height,
            'q' => $quality,
            'fm' => $format
        ]);

        return $url . '?' . $query;
    }
}
