<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = array(
            array('id' => '1','supplierName' => 'Salam Khan','supplierPhone' => '01765561009','supplierEmail' => 'arcadex.sabbir@gmail.com','supplierAddress' => 'Dhaka','supplierProfile' => NULL,'supplierCompanyName' => NULL,'supplierTotalAmount' => '0.00','supplierPaidAmount' => '0.00','supplierDueAmount' => '0.00','supplierPartialAmount' => '0.00','status' => 'Active','created_at' => '2024-09-29 11:21:14','updated_at' => '2024-09-29 11:21:14')
          );

          Supplier::insert($suppliers);
    }
}
