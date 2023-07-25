<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\RxEntryModel;



class ExportUser implements FromCollection
{
	public function collection()
    {
    	 return RxEntryModel::get();
    	//$this->collectionss();
    }
   public function collectionss()
   {

   	       

   }
}
