<?php

namespace App\Http\Controllers;

use App\Models\Crm\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilePhotoController extends Controller
{
    public function show(Request $request, int $clientId)
    {
        // CRM auth can view any client photo
        if (!Auth::check()) {
            abort(403);
        }

        $client = Client::findOrFail($clientId);

        if (! $client->profile_photo) {
            abort(404);
        }

        $path = 'protected/profile_photos/' . $client->profile_photo;

        if (! Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return Storage::disk('local')->download($path);
    }

    public function inline(Request $request, int $clientId)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $client = Client::findOrFail($clientId);

        if (! $client->profile_photo) {
            abort(404);
        }

        $path = 'protected/profile_photos/' . $client->profile_photo;

        if (! Storage::disk('local')->exists($path)) {
            abort(404);
        }

        $mime = Storage::disk('local')->mimeType($path) ?? 'application/octet-stream';
        return response(Storage::disk('local')->get($path), 200, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="'.$client->profile_photo.'"',
        ]);
    }

    public function portalShow(Request $request, int $clientId)
    {
        $user = Auth::guard('portal')->user();

        if (! $user || $user->id !== $clientId) {
            abort(403);
        }

        if (! $user->profile_photo) {
            abort(404);
        }

        $path = 'protected/profile_photos/' . $user->profile_photo;

        if (! Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return Storage::disk('local')->download($path);
    }

    public function portalInline(Request $request, int $clientId)
    {
        $user = Auth::guard('portal')->user();

        if (! $user || $user->id !== $clientId) {
            abort(403);
        }

        if (! $user->profile_photo) {
            abort(404);
        }

        $path = 'protected/profile_photos/' . $user->profile_photo;

        if (! Storage::disk('local')->exists($path)) {
            abort(404);
        }

        $mime = Storage::disk('local')->mimeType($path) ?? 'application/octet-stream';
        return response(Storage::disk('local')->get($path), 200, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="'.$user->profile_photo.'"',
        ]);
    }
}
