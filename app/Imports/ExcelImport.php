<?php

namespace App\Imports;

use App\Category_product;
use Maatwebsite\Excel\Concerns\ToModel;
class ExcelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Category_product([
           'category_name' =>$row[0],
           'category_desc' =>$row[1],
           'category_status' =>$row[2],
           'slug_category' =>$row[3],
           'category_keywords' =>$row[4],
        ]);
    }
}
