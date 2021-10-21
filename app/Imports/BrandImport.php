<?php

namespace App\Imports;

use App\Brand;
use Maatwebsite\Excel\Concerns\ToModel;
class BrandImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Brand([
           'brand_name' =>$row[0],
           'brand_desc' =>$row[1],
           'brand_status' =>$row[2],
           'slug_brand' =>$row[3],
        ]);
    }
}
