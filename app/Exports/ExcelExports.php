<?php

namespace App\Exports;
use App\Category_product;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ExcelExports implements ShouldAutoSize, FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Category_product::all();
    }
    public function headings(): array
    {
        return [
            '#',
            'Category_Name',
            'Category_desc',
            'Category_status',
            'Slug_Category',
            'Category_keywords',
            'category_parent',
            'category_order',
            'Created_at',
            'Update_at'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:H1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
       
    }
}
