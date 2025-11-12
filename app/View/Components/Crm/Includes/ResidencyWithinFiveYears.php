<?php

namespace App\View\Components\Crm\Includes;

use App\Models\Crm\Client;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ResidencyWithinFiveYears extends Component
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
            'clientId' => $this->clientId,
            'client_residency_within_five_years_data' => !empty($this->clientId) ? $client->residency_within_five_years()->get() : ''
        ];

        return view('components.crm.includes.residency-within-five-years', $data);
    }
}
