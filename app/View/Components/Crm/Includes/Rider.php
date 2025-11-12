<?php

namespace App\View\Components\Crm\Includes;

use App\Models\Crm\Client;
use App\Models\Crm\Relation;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Rider extends Component
{
    public $clientid;

    /**
     * Create a new component instance.
     */
    public function __construct($clientid)
    {
        $this->clientid = $clientid;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $client = Client::find($this->clientid);

        $riders = $client->riders()->get();

        $data = [
            'clientid' => $this->clientid,
            'riders' => $riders,
        ];

        return view('components.crm.includes.rider', $data);
    }
}
