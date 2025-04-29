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
    function urlGen($src, $width = 200, $height = 200, $fit = 'crop', $quality = 50, $format = 'webp') {
        $baseUrl = "https://example.com";
        $url = strpos($src, "http") === 0 ? $src : $baseUrl . $src;

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
