<?php
/**
 * Dirección, mapa, horarios y datos del local.
 *
 * Parcial de configuración de Origen8.8. Se carga desde config.php y se
 * fusiona con array_replace_recursive() según el orden allí declarado.
 * El array resultante no debe cambiar.
 *
 * @package MiLocalWeb\Clientes
 */

return [
    // ─── Ubicación ───────────────────────────────────────────────────

    'direccion'    => implode("\n", [
        $storeAddress['street_address'],
        $storeAddress['neighborhood'],
        $storeAddress['postal_code'],
        $storeAddress['locality'],
        $storeAddress['region'] . ', ' . $storeAddress['country_name'],
    ]),
    'gmaps_embed'  => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1500!2d-64.1177626!3d-32.18387920000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95cd6f33c8d75d99%3A0xea6f9f9ecb87cfe0!2sorigen%20run%20%26%20bike!5e0!3m2!1ses!2sar!4v1787875054834!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>',
    'gmaps_link'   => $googleBusinessProfile,
    'mostrar_estrellas' => false,
    'estrellas'    => 5,
    'total_resenas'=> 1,
    'horario'      => implode(' | ', $displayHours),

    // ─── Nuestro Local ──────────────────────────────────────────────

    'seccion_local' => [
        'titulo'     => 'Nuestro Local',
        'invitacion' => 'Pasá a conocernos. Te esperamos con la mejor energía para que elijas tu próxima prenda o accesorio para el tiempo libre.',
        'exterior'   => [
            ['imagen' => '/assets/img/cliente/local/exterior/frente.webp',  'alt' => 'Frente del local Origen8.8'],
            ['imagen' => '/assets/img/cliente/local/exterior/derecha.webp', 'alt' => 'Vista lateral del local Origen8.8'],
        ],
    ],

    // ─── Cómo llegar ────────────────────────────────────────────────

    'seccion_como_llegar' => [
        'titulo'   => '¿Cómo llegar?',
        'saludo'   => 'Te esperamos',
        'interior' => [
            ['imagen' => '/assets/img/cliente/local/interior/interior.webp', 'alt' => 'Interior del local Origen8.8'],
            ['imagen' => '/assets/img/cliente/local/interior/vidriera.webp', 'alt' => 'Vidriera del local Origen8.8'],
        ],
    ],

];
