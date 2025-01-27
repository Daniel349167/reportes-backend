<?php

namespace App\Jobs;

use App\Events\ReportGenerated;
use App\Exports\UsersExport;
use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class GenerateReportJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public $title;
    public $startDate;
    public $endDate;

    public function __construct($title, $startDate, $endDate)
    {
        $this->title     = $title;
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
    }

    public function handle()
    {
        DB::beginTransaction();

        try {
            $finalTitle = $this->getUniqueTitle($this->title);

            $fileName = 'report_' . Str::slug($finalTitle, '_') . '.xlsx';

            Excel::store(
                new UsersExport($this->startDate, $this->endDate),
                $fileName,
                'public'
            );

            $report = Report::create([
                'title'        => $finalTitle,
                'fecha_inicio' => $this->startDate,
                'fecha_fin'    => $this->endDate, 
                'report_link'  => config('app.url') . '/storage/' . $fileName,
            ]);

            event(new ReportGenerated($report));

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    private function getUniqueTitle(string $baseTitle): string
    {
        $counter = 0;
        $finalTitle = $baseTitle;

        while (Report::where('title', $finalTitle)->exists()) {
            $counter++;
            $finalTitle = $baseTitle . '_' . $counter;
        }

        return $finalTitle;
    }
}
