<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
           'category_id' =>$row[0],
           'brand_id' =>$row[1],
           'product_name' =>$row[2],
           'product_desc' =>$row[3],
           'slug_product' =>$row[4],
           'product_content' =>$row[5],
           'product_tags' =>$row[6],
           'product_price' =>$row[7],
           'price_cost' =>$row[8],
           'product_quantity' =>$row[9],
           'product_image' =>$row[10],
           'product_status' =>$row[11],
        ]);
    }
}
