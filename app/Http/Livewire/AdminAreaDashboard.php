<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use App\Models\Category;
use App\Models\PostReply;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\AreaChartModel;

class AdminAreaDashboard extends Component
{
    public function render()
    {
        $columnChartModel = 
            (new ColumnChartModel())
        ->setTitle('Statistics')
        ->addColumn('Registered User', User::all()->count(), '#f6ad55')
        ->addColumn('Categories', Category::all()->count(), '#7fb5b5')
        ->addColumn('Posts', Post::all()->count(), '#fc8181')
        ->addColumn('Replies', PostReply::all()->count(), '#90cdf4')
        ->setDataLabelsEnabled(true)
    ;
        $pieChartModel = 
            (new PieChartModel())
        ->setTitle('Statistics')
        ->addSlice('Registered User', User::all()->count(), '#f6ad55')
        ->addSlice('Categories', Category::all()->count(), '#7fb5b5')
        ->addSlice('Posts', Post::all()->count(), '#fc8181')
        ->addSlice('Replies', PostReply::all()->count(), '#90cdf4')
        ->setDataLabelsEnabled(true)
    ;

    $lineChartModel = 
            (new LineChartModel())
        ->setTitle('Statistics')
        ->singleLine()
        ->addPoint('A', 1.0)
        ->addPoint('B', 12.4)
        ->addPoint('C', 100.27)
        ->addPoint('D', 9.0)
        ->addPoint('E', 44.2)
        ->addPoint('F', 14.0)
    ;

    $areaChartModel = 
            (new AreaChartModel())
        ->setTitle('Statistics')
        ->addPoint('A', 1.0)
        ->addPoint('B', 12.4)
        ->addPoint('C', 100.27)
        ->addPoint('D', 9.0)
        ->addPoint('E', 44.2)
        ->addPoint('F', 14.0)
    ;

        return view('livewire.admin-area-dashboard', compact('columnChartModel','pieChartModel', 'lineChartModel', 'areaChartModel'));
    }
}
