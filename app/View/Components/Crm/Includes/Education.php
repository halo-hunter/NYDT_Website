<?php

namespace App\View\Components\Crm\Includes;

use App\Models\Crm\Client;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Education extends Component
{
    public $clientId;
    /**
     * Create a new component instance.
     */
    public function __construct($clientId = false)
    {
        $this->clientId = $clientId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $client = Client::find($this->clientId);

        $data = [
            'client' => $client
        ];

        return view('components.crm.includes.education', $data);
    }
}
