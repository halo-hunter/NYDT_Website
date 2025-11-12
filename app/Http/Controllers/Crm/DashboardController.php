<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\CaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show(Request $request)
    {
        $casesUpdatedTrend = $this->buildTrend(CaseModel::query(), 'updated_at');
        $casesClosedTrend = $this->buildTrend(CaseModel::onlyTrashed(), 'deleted_at');

        $casesOnHoldQuery = $this->onHoldQuery();
        $casesOnHoldTrend = $this->buildTrend($casesOnHoldQuery, 'updated_at');

        $summary = [
            'total_cases' => CaseModel::count(),
            'total_paid' => (float) CaseModel::sum('total_paid'),
            'cases_updated' => array_sum($casesUpdatedTrend['values']),
            'cases_closed' => array_sum($casesClosedTrend['values']),
            'cases_on_hold' => (clone $casesOnHoldQuery)->count(),
        ];

        return view('crm.pages.dashboard.show', [
            'summary' => $summary,
            'charts' => [
                'cases_updated' => $casesUpdatedTrend,
                'cases_closed' => $casesClosedTrend,
                'cases_on_hold' => $casesOnHoldTrend,
            ],
        ]);
    }

    protected function buildTrend(Builder $query, string $column): array
    {
        $days = collect(range(6, 0))->map(fn (int $i) => Carbon::now()->subDays($i)->startOfDay());
        $buckets = $days->mapWithKeys(fn ($day) => [$day->format('Y-m-d') => 0]);

        $start = $days->first();
        $end = Carbon::now()->endOfDay();

        $results = (clone $query)
            ->whereNotNull($column)
            ->whereBetween($column, [$start, $end])
            ->selectRaw("DATE($column) as trend_day, COUNT(*) as total")
            ->groupBy('trend_day')
            ->pluck('total', 'trend_day');

        foreach ($results as $day => $total) {
            if (isset($buckets[$day])) {
                $buckets[$day] = (int) $total;
            }
        }

        return [
            'labels' => $days->map(fn ($day) => $day->format('M d'))->toArray(),
            'values' => array_values($buckets->toArray()),
        ];
    }

    protected function onHoldQuery(): Builder
    {
        return CaseModel::query()->where(function ($query) {
            $query->whereNotNull('total_balance')
                ->where(function ($inner) {
                    $inner->whereNull('total_paid')
                        ->orWhereColumn('total_paid', '<', 'total_balance');
                });
        });
    }
}
