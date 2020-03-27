<?php
   
namespace App\Exports;
   
use App\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
   
class ExportItems implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Item::where('activo', '>', '0')->orderBy('id', 'desc')->get();
    }
}