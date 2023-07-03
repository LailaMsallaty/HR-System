<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Country;
use App\Location;
use App\Department;
use App\Http\Requests\StoreLocation;
use Illuminate\Support\Facades\DB;


//use App\Repository\LocationRepositoryInterface;


class LocationController extends Controller
{

    protected $Location;

    // public function __construct(LocationRepositoryInterface $Location)
    // {
    //     $this->Location = $Location;
    // }

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
    $Locations =  Location::all();
    $Countries = Country::all();
    $Cities = City::all();
    $Departments = Department::all();

    return view('pages.Locations.Locations', compact('Locations','Cities','Countries','Departments'));

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
  public function store(StoreLocation $request)
  {
    try {
        $validated = $request->validated();
        $Location = new Location();

        $Location->Address = ['en' => $request->Address_en , 'ar' => $request->Address_ar];
        $Location->City_Id = $request->location_city;


        $Location->save();
        $Location->departments()->attach($request->location_departments);

        toastr()->success(trans('messages.Success'));
        return redirect()->route('location.index');

    }

    catch (\Exception $e){
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
  public function update(StoreLocation $request)
  {
    try {
        $validated = $request->validated();
        $Location = Location::findOrFail($request->id);

        $Location->Address = ['en' => $request->Address_en , 'ar' => $request->Address_ar];
        $Location->City_Id = $request->location_city;
        $Location->departments()->sync($request->location_departments);


        $Location->save();

        toastr()->success(trans('messages.Update'));
        return redirect()->route('location.index');

    }

    catch (\Exception $e){
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

      $Locations = Location::whereIn('id', $delete_all_id);

      $departments = DB::table('Departments')
      ->select('*')
      ->join('Department_Location', 'Department_Location.Department_Id', '=', 'Departments.id')
      ->whereIn('Department_Location.Location_Id', $delete_all_id)
      ->get();

      $list_Departments = $departments->pluck('Department_Id');

            if ($list_Departments->count() == 0) {
                $Locations->Delete();
                toastr()->error(trans('messages.Delete'));
                return redirect()->route('location.index');
            }
            else{

                toastr()->error(trans('locations-trans.delete_Choose_Location_Error'));
                return redirect()->route('location.index');

            }
  }
  public function destroy(Request $request)
  {
    $departments = DB::table('Departments')
    ->select('*')
    ->join('Department_Location', 'Department_Location.Department_Id', '=', 'Departments.id')
    ->where('Department_Location.Location_Id', $request->id)
    ->get();

    $list_Departments = $departments->pluck('Department_Id');

    if($list_Departments->count() == 0){

        $Location = Location::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('location.index');
    }
    else{

        toastr()->error(trans('locations-trans.delete_Location_Error'));
        return redirect()->route('location.index');

    }


  }
  public function getCities($id)
  {
      $list_cities = City::where("Country_Id", $id)->pluck("Name", "id");

      return $list_cities;
  }

}

?>
