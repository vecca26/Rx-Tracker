<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Brands;
use Validator;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public $successStatus = 200;
    public function index()
    {
        $user = Auth::user();
        if ($user->user_type == 'zsm') {
            $brandData = Brands::where('status', '1')
                ->where('team_id', '=', $user->team_id)
                ->paginate('10');
        } else {
            $brandData = Brands::where('status', '1')
                ->paginate('10');
        }
        $returnData = [
            'brand_list' => $brandData
        ];
        return view('admin/brands/admin_brand_list', $returnData);
    }

    public function searchBrands(Request $request)
    {

        $brandData = Brands::where('brand_name', 'LIKE', "%" . $request->keyword . "%")
            ->paginate('10');
        $returnData = [
            'brand_list' => $brandData
        ];
        return view('admin/brands/admin_brand_list', $returnData);
    }
    public function addBrands(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'brandname'        => 'required',
            ]
        );
        if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        } else {
            $response = Brands::AddBrand($request->brandname, $request->team_select, $request->dose_unit);
            return redirect('/brands')->with('status', 'Brand Added!');
        }
    }
    public function updateBrand(Request $request)
    {

        $response = Brands::UpdateBrand($request);
        return redirect('/brands')->with('status', 'Brands Updated!');
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        //return   $id;
        if ($id) {
            $brands = Brands::where('id', $id)->first();
            if ($brands->id) {
                Brands::destroy($id);
                $msg = "1";
            } else {
                $msg = "0";
            }
        } else {
            $msg = "0";
        }
        return $msg;
    }





    public function fetch_brand_data(Request $request)
    {
        $brandData = Brands::select('brand_name', 'dose_unit', 'team_id', 'team')
            ->join('team_brands', 'team_brands.brand_id', '=', 'brands.id')
            ->join('teams', 'team_brands.team_id', '=', 'teams.id')
            ->where('brand_id', '=', $request->brand_id)
            ->get();
        $returnData = [
            'brand_list' => $brandData
        ];
        return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
    }
}
