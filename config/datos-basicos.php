<?php
/**
 * Datos básicos, branding y paleta del cliente.
 *
 * Parcial de configuración de Origen8.8. Se carga desde config.php y se
 * fusiona con array_replace_recursive() según el orden allí declarado.
 * El array resultante no debe cambiar.
 *
 * @package MiLocalWeb\Clientes
 */

return [
    // ─── Datos básicos ───────────────────────────────────────────────

    'nombre'    => 'Origen8.8',
    'site_url'  => 'https://origen.milocalweb.com.ar',
    'slogan'    => 'Línea tiempo libre',
    'rubro'     => 'Indumentaria y accesorios para el tiempo libre',
    'telefono'  => '3571329870',
    'whatsapp'  => '5493571329870',
    'whatsapp_disponibilidad' => 'Respondemos mensajes todos los días',
    'email'     => '', // Pendiente con el cliente
    'whatsapp_mensaje' => 'Hola! Vi tu web y quisiera más info',
    'whatsapp_mensaje_ofertas' => 'Hola! Estoy en la web y me gustaría ver oportunidades en ropa de invierno y camperas',

    // ─── Branding assets ─────────────────────────────────────────────

    'logo_img'  => '/assets/img/cliente/logos/logo-origen88.webp',
    'favicon'   => '/assets/img/cliente/iconos/favicon.ico',

    // ─── Hero Section ────────────────────────────────────────────────

    'hero_layout'      => 'stacked', // img-right | img-left | stacked
    'hero_descripcion' => "Algo más que un local de indumentaria. Running, trekking y sports: ropa, calzado y accesorios para todas tus actividades al Aire Libre!",
    'hero_boton'       => 'Escribinos por WhatsApp',
    'hero_img'         => '/assets/img/cliente/identidad/portada-desktop.webp',

    // ─── Identidad Visual ────────────────────────────────────────────

    'colors' => [
        'color-primary'       => '#000000',
        'color-primary-hover' => '#2b2b2b',
        'color-accent'        => '#00bbaa',
        'color-accent-hover'  => '#2accb8',
        'color-text'          => '#2b2b2b',
        'color-muted'         => '#5c7c8a',
        'color-bg'            => '#ffffff',
        'color-bg-alt'        => '#e5e5e5',
        'color-card-bg'       => '#dfd3ca',
        'color-slate-blue'    => '#5c7c8a',
        'color-soft-aqua'     => '#8eaaaf',
        'color-verano-fem'    => '#dfd3ca',
        'color-verano-fem-dark' => '#d4c5bb',
        'texture-stone'       => "url('/assets/img/cliente/identidad/textura-fondo-piedra.webp')",
    ],
    'tipografia' => '"Open Sans", system-ui, -apple-system, "Segoe UI", Roboto, sans-serif',

];
