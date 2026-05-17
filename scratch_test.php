<?php

$request = Illuminate\Http\Request::create('/lean-canvases/1', 'POST', [
    '_method' => 'PUT',
    '_token' => csrf_token(),
    'problem' => '1st problem',
    'solution' => 'sell the company'
]);

// Since tinker doesn't have an active session easily available to bypass CSRF,
// we will just directly call the controller method.
$controller = app()->make(App\Http\Controllers\LeanCanvasController::class);
$leanCanvas = App\Models\LeanCanvas::find(1);

$response = $controller->update($request, $leanCanvas);

echo "Success!\n";
