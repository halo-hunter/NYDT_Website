<?php

namespace App\Http\Controllers;

use App\Models\Crm\CaseModel;
use App\Models\Crm\Client;
use App\Models\Crm\DefenceAsylumVersionTwo;
use App\Models\Crm\UploadDocumentVersionTwo;
use App\Support\PortalCaseResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileDownloadController extends Controller
{
    /**
     * CRM: Download case retainer (auth required).
     */
    public function retainer(Request $request, int $caseId)
    {
        $this->ensureCrmAuthenticated();

        $case = CaseModel::findOrFail($caseId);

        if (! $case->upload_retainer) {
            abort(404);
        }

        $path = 'protected/retainer/' . $case->upload_retainer;

        if (! Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return Storage::disk('local')->download($path);
    }

    /**
     * CRM: Download defence asylum file (auth required).
     */
    public function defenceAsylum(Request $request, int $caseId)
    {
        $this->ensureCrmAuthenticated();

        $record = DefenceAsylumVersionTwo::where('case_id', $caseId)->firstOrFail();

        if (! $record->name) {
            abort(404);
        }

        $path = 'protected/defence_asylum/' . $record->name;

        if (! Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return Storage::disk('local')->download($path);
    }

    /**
     * CRM: Download generic uploaded document (auth required).
     */
    public function caseUpload(Request $request, int $uploadId)
    {
        $this->ensureCrmAuthenticated();

        $record = UploadDocumentVersionTwo::findOrFail($uploadId);
        $path = 'protected/upload_document/' . $record->name;

        if (! Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return Storage::disk('local')->download($path);
    }

    /**
     * Portal: Download uploaded document owned by the client.
     */
    public function portalCaseUpload(Request $request, int $uploadId)
    {
        $case = PortalCaseResolver::caseForCurrentClientOrAbort(
            UploadDocumentVersionTwo::findOrFail($uploadId)->case_id
        );

        $record = UploadDocumentVersionTwo::where('id', $uploadId)
            ->where('case_id', $case->id)
            ->firstOrFail();

        $path = 'protected/upload_document/' . $record->name;

        if (! Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return Storage::disk('local')->download($path);
    }

    protected function ensureCrmAuthenticated(): void
    {
        if (! Auth::check()) {
            abort(403);
        }
    }
}
