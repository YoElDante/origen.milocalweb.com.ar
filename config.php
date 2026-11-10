<?php
/**
 * Configuración del cliente — Landing Page Origen8.8.
 *
 * Este archivo es la ÚNICA fuente de datos del sitio.
 *
 * Orden de composición: los parciales de config/ se cargan en el orden
 * declarado más abajo y se fusionan con array_replace_recursive(). Ese
 * orden preserva la cascada de claves; el array resultante NO debe cambiar.
 *
 * @package MiLocalWeb\Clientes
 */

$storeAddress = [
    'street_address' => 'Ejército de los Andes 129',
    'neighborhood' => 'Villa Zoila',
    'locality' => 'Río Tercero',
    'postal_code' => 'X5850',
    'region' => 'Córdoba',
    'country' => 'AR',
    'country_name' => 'Argentina',
];

$storeOpeningHours = [
    [
        'days' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
        'display_days' => 'Lunes a Viernes',
        'opens' => '10:00',
        'closes' => '12:45',
    ],
    [
        'days' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
        'display_days' => 'Lunes a Viernes',
        'opens' => '17:15',
        'closes' => '20:30',
    ],
    [
        'days' => ['Saturday'],
        'display_days' => 'Sábados',
        'opens' => '10:00',
        'closes' => '12:45',
    ],
    [
        'days' => ['Saturday'],
        'display_days' => 'Sábados',
        'opens' => '17:15',
        'closes' => '20:30',
    ],
];

$googleBusinessProfile = 'https://maps.app.goo.gl/HUvBH4WQ8sBVuuQMA';

$formatDisplayTime = function (string $time): string {
    return ltrim($time, '0');
};

$displayHoursByDay = [];
foreach ($storeOpeningHours as $hours) {
    $displayHoursByDay[$hours['display_days']][] = $formatDisplayTime($hours['opens'])
        . '-'
        . $formatDisplayTime($hours['closes']);
}

$displayHours = [];
foreach ($displayHoursByDay as $days => $ranges) {
    $displayHours[] = $days . ' ' . implode(' y ', $ranges);
}
$displayHours[] = 'Domingo Cerrado';


// ─── Composición de la configuración ────────────────────────────────
// Cada parcial devuelve un array. El orden de carga reproduce el orden
// del antiguo config.php monolítico y preserva la cascada de claves.
$config = [];
foreach ([
    'datos-basicos',
    'productos-paginas',
    'secciones-campanas',
    'ubicacion',
    'indumentaria',
    'redes-nosotros',
    'aside-clientes',
    'seo',
] as $part) {
    $config = array_replace_recursive(
        $config,
        require __DIR__ . '/config/' . $part . '.php'
    );
}

return $config;
