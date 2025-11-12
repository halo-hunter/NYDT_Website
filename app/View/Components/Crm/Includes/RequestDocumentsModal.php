<?php

namespace App\View\Components\Crm\Includes;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RequestDocumentsModal extends Component
{
    public $client;

    /**
     * Create a new component instance.
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.crm.includes.request-documents-modal');
    }
}
