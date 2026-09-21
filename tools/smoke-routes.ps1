param(
    [int]$Port = 8099
)

$ErrorActionPreference = 'Stop'

$root = Split-Path -Parent $PSScriptRoot
$baseUrl = "http://127.0.0.1:$Port"

function Assert-True {
    param(
        [bool]$Condition,
        [string]$Message
    )

    if (-not $Condition) {
        throw $Message
    }
}

function Read-Route {
    param(
        [string]$Path,
        [int]$ExpectedStatus
    )

    $url = "$baseUrl$Path"

    try {
        $response = Invoke-WebRequest -UseBasicParsing -Uri $url -ErrorAction Stop
        $status = [int]$response.StatusCode
        $content = $response.Content
    } catch {
        $status = [int]$_.Exception.Response.StatusCode.value__
        $reader = New-Object System.IO.StreamReader($_.Exception.Response.GetResponseStream())
        $content = $reader.ReadToEnd()
    }

    Assert-True ($status -eq $ExpectedStatus) "Expected $ExpectedStatus for $Path, got $status"

    return $content
}

$job = Start-Job -ScriptBlock {
    param($ProjectRoot, $ServerPort)

    Set-Location -LiteralPath $ProjectRoot
    php -S "127.0.0.1:$ServerPort" index.php
} -ArgumentList $root, $Port

try {
    Start-Sleep -Seconds 2

    $homeContent = Read-Route '/' 200
    $indexContent = Read-Route '/index.php' 200
    $indexProductos = Read-Route '/index.php?p=productos' 200
    $productos = Read-Route '/productos' 200
    $productosSlash = Read-Route '/productos/' 200
    $ofertas = Read-Route '/ofertas' 200
    $ofertasWithQuery = Read-Route '/ofertas?p=productos' 200
    $accesorios = Read-Route '/accesorios' 200
    $carrito = Read-Route '/carrito' 200
    $notFound = Read-Route '/no-existe' 404
    Read-Route '/config.php' 403 | Out-Null
    Read-Route '/Config.php' 403 | Out-Null
    Read-Route '/includes/header.php' 403 | Out-Null
    Read-Route '/Includes/header.php' 403 | Out-Null
    Read-Route '/tools/smoke-routes.ps1' 403 | Out-Null

    Assert-True ($homeContent -match '<title>Origen Run') 'Home title missing'
    Assert-True ($indexContent -match '<title>Origen Run') 'Index title missing'
    Assert-True ($indexProductos -match '<title>Productos') 'Index query fallback missing'
    Assert-True ($productos -match '<title>Productos') 'Productos title missing'
    Assert-True ($productos -match 'data-cart-add') 'Add-to-cart buttons missing'
    Assert-True ($productos -match 'data-product-id="biker-irun-negro"') 'Product data attributes missing'
    Assert-True ($productosSlash -match '<title>Productos') 'Productos trailing slash title missing'
    Assert-True ($ofertas -match '<title>Ofertas') 'Ofertas title missing'
    Assert-True ($ofertasWithQuery -match '<title>Ofertas') 'Path should win over query param'
    Assert-True ($accesorios -match '<title>Accesorios') 'Accesorios title missing'
    Assert-True ($carrito -match '<title>Carrito') 'Carrito title missing'
    Assert-True ($carrito -match 'data-cart-root') 'Cart root missing'
    Assert-True ($carrito -match 'data-cart-whatsapp') 'Cart WhatsApp checkout missing'
    Assert-True ($carrito -notmatch 'data-cart-email') 'Email checkout should be hidden while config email is empty'
    Assert-True ($carrito -match 'cart\.js') 'Cart script missing'
    Assert-True ($notFound -match 'noindex, follow') '404 page must be noindex'
    Assert-True ($notFound -match 'Página no encontrada') '404 page visible message missing'
    Assert-True ($ofertas -match 'Camperas outdoor') 'Discount-only route branch missing from ofertas'
    Assert-True ($accesorios -notmatch 'https://origen\.milocalweb\.com\.ar/assets/[^"<]*\s[^"<]*\.(webp|jpg|png)') 'JSON-LD asset URL contains raw spaces'
    Assert-True ($accesorios -notmatch 'Offer.+price') 'Products without visible price must not emit Offer.price'

    'Smoke routes OK'
} finally {
    Stop-Job $job -ErrorAction SilentlyContinue
    Remove-Job $job -ErrorAction SilentlyContinue
}
