<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Brands extends Model
{
    use HasFactory;

    protected $table = 'brands';
    protected $fillable = [
        'brand_name',
        'dose_unit',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y h:i:s',
        'updated_at' => 'datetime:d-m-Y h:i:s'
    ];

    public static function getBrandList()
    {
        return DB::table('brands')
            ->get();
    }
    public static function searchBrands($keyword)
    {

        $brandData = DB::table('brands')
            ->where('brands.brand_name', 'LIKE', "%" . $keyword . "%")
            ->get();
        return $brandData;
    }
    public static function AddBrand($brandname, $team, $dose_unit)
    {

        $insert_array = [
            'brand_name' => $brandname,
            'dose_unit'  => $dose_unit,
            'status'     => '1'
        ];

        $sts = Self::create($insert_array);
        $team_array = [
            'team_id'     => $team,
            'brand_id'    => $sts->id
        ];
        $sts = DB::table('team_brands')->insert($team_array);
        $response = [
            'status'      => true,
            'message'     => 'Brand added successfully'
        ];

        return $response;
    }
    public static function UpdateBrand($request)
    {
        $updateArray = [
            'brand_name' => $request->brandnames,
            'dose_unit'  => $request->dose_units

        ];
        $teambrandsArray = [
            'team_id'    => $request->team_selects

        ];
        $updateResult  = Self::where('id', $request->brand_id)->update($updateArray);
        $updateResults = DB::table('team_brands')
            ->where('brand_id', $request->brand_id)->update($teambrandsArray);
        if ($updateResult) {
            return true;
        } else {
            return false;
        }
    }
    public static function deleteBrands($brand_id)
    {

        $brandDelete = Self::where('id', $brand_id)->firstorfail()->delete();

        if ($brandDelete) {
            return true;
        } else {
            return false;
        }
    }
}
