<?php

namespace App\View\Components\Crm\Includes;

use App\Models\Crm\CaseModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EntryDate extends Component
{
    public $caseid;

    /**
     * Create a new component instance.
     */
    public function __construct($caseid = false)
    {
        $this->caseid = $caseid;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $case = CaseModel::find($this->caseid);

        if (request()->route()->getName() == 'cases->edit') {

            $entry_dates = $case->entry_dates()->get();

            $data = [
                'entry_dates' => $entry_dates
            ];

        } else {

            $data = [

            ];

        }

        return view('components.crm.includes.entry-date', $data);
    }
}
