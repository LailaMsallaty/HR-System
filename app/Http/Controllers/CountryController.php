<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\City;
use App\Http\Requests\StoreCountry;


class CountryController extends Controller
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

    return view('pages.manage_system.Country', compact('Countries'));

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
  public function store(StoreCountry $request)
  {
    $List_Countries = $request->List_Countries;

    try {

        $validated = $request->validated();

        foreach ($List_Countries as $List_Country) {

            $Country = new Country();

            $Country->Name = ['en' => $List_Country['Name_en'], 'ar' => $List_Country['Name_ar']];

            $Country->save();

        }

        toastr()->success(trans('messages.Success'));
        return redirect()->route('country.index');
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
  public function update(StoreCountry $request)
  {

    try {
        $validated = $request->validated();

        $Country = Country::findOrFail($request->id);

        $Country->Name = ['ar' => $request->Name_ar, 'en' => $request->Name_en];

        $Country->save();

        toastr()->success(trans('messages.Update'));
        return redirect()->route('country.index');
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

      $Countries = Country::whereIn('id', $delete_all_id);

      $Cities = City::whereIn('Country_Id',$delete_all_id)->pluck('Country_Id');


            if ($Cities->count() == 0) {
                $Countries->Delete();
                toastr()->error(trans('messages.Delete'));
                return redirect()->route('country.index');
            }
            else{

                toastr()->error(trans('system-trans.delete_Choose_Country_Error'));
                return redirect()->route('country.index');

            }
  }
  public function destroy(Request $request)
  {
    $City_id = City::where('Country_Id',$request->id)->pluck('Country_Id');

    if($City_id->count() == 0){

        $Country = Country::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('country.index');
    }

    else{

        toastr()->error(trans('system-trans.delete_Country_Error'));
        return redirect()->route('country.index');

    }

  }

}

?>
