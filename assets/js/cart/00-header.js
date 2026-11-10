/**
 * Origen8.8 — Carrito local de pedido asistido.
 * Vanilla JS. Sin backend, sin login y sin pasarela de pago.
 *
 * Este archivo abre el IIFE; 99-footer.js lo cierra. tools/build-js.php
 * concatena los parciales en orden y todos comparten el mismo scope.
 * No usar import/export ni mover código entre parciales sin actualizar
 * el orden de build.
 */

(function () {
    'use strict';

    const STORAGE_KEY = 'origen_carrito';

