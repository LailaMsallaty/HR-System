<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\City;
use App\Location;
use App\Http\Requests\StoreCity;


class CityController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function __construct()
  {
      $this->middleware(['permission:General_Management|إدارة_عامة']);
  }
  public function index()
  {
    $Countries = Country::all();
    $Cities = City::all();

    return view('pages.manage_system.City', compact('Countries','Cities'));


  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreCity $request)
  {
    $List_Cities = $request->List_Cities;

    try {

        $validated = $request->validated();

        foreach ($List_Cities as $List_City) {

            $City = new City();

            $City->Name = ['en' => $List_City['Name_en'], 'ar' => $List_City['Name_ar']];

            $City->Country_Id = $List_City['country'];

            $City->save();

        }

        toastr()->success(trans('messages.Success'));
        return redirect()->route('city.index');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }




  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(StoreCity $request)
  {
    try {
        $validated = $request->validated();

        $Cities = City::findOrFail($request->id);

        $Cities->Name = ['ar' => $request->Name_ar, 'en' => $request->Name_en];

        $Cities->Country_Id = $request->country;

        $Cities->save();

        toastr()->success(trans('messages.Update'));
        return redirect()->route('city.index');
    }

    catch
    (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */

  public function delete_all(Request $request)
  {
      $delete_all_id = explode(",", $request->delete_all_id);

      $Cities = City::whereIn('id', $delete_all_id);

      $Locations = Location::whereIn('City_Id',$delete_all_id)->pluck('City_Id');


            if ($Locations->count() == 0) {
                $Cities->Delete();
                toastr()->error(trans('messages.Delete'));
                return redirect()->route('city.index');
            }
            else{

                toastr()->error(trans('system-trans.delete_Choose_City_Error'));
                return redirect()->route('city.index');

            }
  }
  public function destroy(Request $request)
  {
    $Location_id = Location::where('City_Id',$request->id)->pluck('City_Id');

    if($Location_id->count() == 0){

        $City = City::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('city.index');
    }

    else{

        toastr()->error(trans('system-trans.delete_City_Error'));
        return redirect()->route('city.index');

    }

  }

}

?>
