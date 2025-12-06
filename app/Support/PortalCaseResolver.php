<?php

namespace App\Support;

use App\Models\Crm\CaseModel;
use App\Models\Crm\Client;
use Illuminate\Support\Facades\Auth;

class PortalCaseResolver
{
    /**
     * Return the currently authenticated portal client or abort.
     */
    public static function currentClient(): Client
    {
        $clientId = Auth::guard('portal')->id();

        if (! $clientId) {
            abort(403);
        }

        $client = Client::find($clientId);

        if (! $client) {
            abort(403);
        }

        return $client;
    }

    /**
     * Fetch a case for the current portal client, aborting if it is not owned.
     */
    public static function caseForCurrentClientOrAbort(int $caseId): CaseModel
    {
        $client = self::currentClient();

        /** @var CaseModel|null $case */
        $case = $client->cases()->where('cases.id', $caseId)->first();

        if (! $case) {
            abort(404);
        }

        return $case;
    }
}
