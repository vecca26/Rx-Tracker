<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Doctors extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_name',
        'status',
        'city',
        'speciality_id',
        'institute_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y h:i:s',
        'updated_at' => 'datetime:d-m-Y h:i:s'
    ];

    public static function getDoctorList(){
    return DB::table('doctors')
                  ->join('medical_speciality', 'doctors.speciality_id', '=', 'medical_speciality.id')
                  ->join('institute', 'doctors.institute_id', '=', 'institute.id')
                  ->get();
    }

    public static function specialityList(){
    return DB::table('medical_speciality')
                ->get();
        
    }

    public static function cityList(){
    return DB::table('city')
                ->get();
        
    }
    public static function instituteList(){
    return DB::table('institute')
                ->get();
        
    }
    public static function AddDoctor($request){
        $ff_select = $request->input('ff_selects');
//$ff_select = implode(',', $ff_select);
        
        $insert_array = [
            'doctor_name'    => $request->doctor_name,
            'status'         => '1',
            'city'        => $request->city_select,
            'institute_id'   => $request->institute_select,
            'speciality_id'  => $request->speciality_select
             ];
        
        $sts = Self::create($insert_array);      
        // foreach ($ff_select as  $ff_ids){ 
        //       DB::table('ff_doctor')->insert(
        //                        ['ff_id' => $ff_ids, 'doctor_id' =>$sts->id]
        //                                );
        //         }

              DB::table('ff_doctor')->insert(
                               ['ff_id' => $ff_select, 'doctor_id' =>$sts->id]
                                       );
             
        $response = [
            'status'      => true,
            'message'     => 'Doctor added successfully'
        ];
        return $response;
        
    }
    public static function searchDoctor($keyword){

        $doctorData = DB::table('doctors')
                    ->join('medical_speciality', 'doctors.speciality_id', '=', 'medical_speciality.id')
                    ->join('institute', 'doctors.institute_id', '=', 'institute.id')
                    ->where('doctors.doctor_name','LIKE',"%".$keyword."%")
                    ->get();
    return $doctorData;
    }
   public static function deleteDoctor($doctor_id){

        $brandDelete = Self::where('id', $doctor_id)->delete();
    
        if($brandDelete){
            return true;
        }
        else{
            return false;
        }
    }
}
