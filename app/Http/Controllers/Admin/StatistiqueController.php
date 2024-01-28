<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IpView;
use App\Models\PageView;
use App\Models\TrafficSource;
use App\Models\DailyVisit;
use Carbon\Carbon;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\User;
use App\Models\ParticipationTournois;


class StatistiqueController extends Controller
{
    public function index()
    {
        $uniqueVisitorsChartOptions = [
            'chart_title' => 'Visiteurs uniques par jour',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\DailyVisit',
            'group_by_field' => 'date',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'filter_field' => 'created_at',
            'filter_days' => 30, // Display data for the last 30 days
            'group_by_field_format' => 'Y-m-d', // Ensure this format matches your 'date' field format in the database
            'column_class' => 'col-md-12',
            'continuous_time' => true,
            'aggregate_function' => 'sum',
            'aggregate_field' => 'unique_visitors', // Aggregate by 'unique_visitors'
            'chart_height' => '100px',
            'color' => '#0000ff', // Set the color of the chart line to blue
            'conditions' => [
                [
                    'name' => 'More than 10 visitors',
                    'condition' => 'unique_visitors > 0', // SQL condition
                    'color' => 'blue',
                    'fill' => true,
                ],
            ],
        ];
        $uniqueVisitorsChart = new LaravelChart($uniqueVisitorsChartOptions);

        $userRegistrationChartOptions = [
            'chart_title' => 'Inscriptions par Jour',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'chart_color' => '#00c292',
            'filter_field' => 'created_at',
            'filter_days' => 30,
            'chart_height' => '100px',
            'aggregate_function' => 'count',
            'aggregate_field' => 'id',
            'conditions' => [
                [
                    'name' => 'Visiteurs',
                    'condition' => 'created_at > -1', // SQL condition
                    'color' => 'blue',
                    'fill' => true,
                ],
            ],
        ];
        $userRegistrationChart = new LaravelChart($userRegistrationChartOptions);
        // chart for all inscriptions tournois
        $inscriptionsTournoisChartOptions = [
            'chart_title' => 'Inscriptions Tournois par Jour',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\ParticipationTournois',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'chart_color' => '#00c292',
            'filter_field' => 'created_at',
            'filter_days' => 30,
            'chart_height' => '100px',
            'aggregate_function' => 'count',
            'aggregate_field' => 'id',
            'conditions' => [
                [
                    'name' => 'Visiteurs',
                    'condition' => 'created_at > -1', // SQL condition
                    'color' => 'blue',
                    'fill' => true,
                ],
            ],
            
            
        ];

        $inscriptionsTournoisChart = new LaravelChart($inscriptionsTournoisChartOptions);


        $ipViews = IpView::orderBy('views', 'desc')->take(10)->get();
        $pageViews = PageView::orderBy('views', 'desc')->take(10)->get();
        $trafficSources = TrafficSource::orderBy('hits', 'desc')->take(10)->get();
        $endDate = Carbon::today();
        $startDate = $endDate->copy()->subDays(6);
        $dailyVisits = DailyVisit::whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->get(['date', 'visits', 'unique_visitors']);

        return view('admin.statistiques.index', compact(
            'ipViews',
            'pageViews',
            'trafficSources',
            'dailyVisits',
            'uniqueVisitorsChart',
            'userRegistrationChart',
            'inscriptionsTournoisChart'
        ));
    }
}
