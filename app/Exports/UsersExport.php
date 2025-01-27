<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment; 

class UsersExport implements 
    FromCollection, 
    WithMapping, 
    WithHeadings, 
    WithCustomStartCell, 
    WithStyles, 
    ShouldAutoSize
{
    protected $startDate;
    protected $endDate;
    protected $rowNumber = 0; 

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
    }

    public function collection(): Collection
    {
        return User::whereBetween('birth_date', [$this->startDate, $this->endDate])
                   ->orderBy('birth_date', 'asc')
                   ->get([
                       'nombres',
                       'apellidos',
                       'email',
                       'telefono',
                       'ciudad',
                       'salario',
                       'birth_date',
                   ]);
    }

    public function map($user): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,   
            $user->nombres,      
            $user->apellidos,  
            $user->email,        
            $user->telefono,     
            $user->ciudad,      
            $user->salario,     
            $user->birth_date,    
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombres',
            'Apellidos',
            'Email',
            'Teléfono',
            'Ciudad',
            'Salario',
            'Fecha Nacimiento',
        ];
    }

    public function startCell(): string
    {
        return 'C5';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('C5:J5')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'FFE699'], 
            ],
        ]);

        $sheet->getStyle('C')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('G')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        return [];
    }
}
