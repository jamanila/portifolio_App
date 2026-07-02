<?php

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

// Serves the built React SPA's index.html for any route that isn't the API,
// Sanctum's CSRF endpoint, storage files, or the health check — lets
// React Router handle client-side routes like /projects or /admin on
// a hard refresh, since the browser always asks Laravel for the page first.
$serveSpa = function () {
    $indexPath = public_path('index.html');

    abort_unless(file_exists($indexPath), 404);

    return Response::file($indexPath);
};

Route::get('/', $serveSpa);
Route::get('/{any}', $serveSpa)->where('any', '^(?!api(?:/|$)|sanctum(?:/|$)|storage(?:/|$)|up$).*$');
