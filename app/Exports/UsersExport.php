<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::get(['id','name','phone','email','gender','birthday','country','location','created_at']);
    }

    public function headings(): array
    {

        return ["ID", "Name", "Phone", "Email", "Gender", "Birthday", "Country","Location","Created At"];
    }
}
