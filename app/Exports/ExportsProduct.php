<?php
namespace App\Exports;
use App\Product;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ExportsProduct implements ShouldAutoSize, FromCollection, WithHeadings, WithEvents,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }
    public function headings(): array
    {
        return [
            '#',
            'ID_thương hiệu',
            'ID_danh mục',
            'Tên sản phẩm',
            'Mô tả sản phẩm',
            'Seo sản phẩm',
            'Chi tiết sản phẩm',
            'Tag sản phẩm',
            'Giá sản phẩm',
            'Giá gốc sản phẩm',
            'Số lượng đã bán',
            'Số lượng sản phẩm',
            'Hình ảnh sản phẩm',
            'Tài liệu sản phẩm',
            'Lượt xem sản phẩm',
            'Tình trạng sản phẩm',
           
        ];
    }
    public function columnWidths(): array
    {
        return [
            'G' => 45,
            'E' => 45,            
        ];
    }
    public function registerEvents(): array
    { 
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:P1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
       
    }
}
