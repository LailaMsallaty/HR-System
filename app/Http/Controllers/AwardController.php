<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Award;
use App\Http\Requests\StoreAwards;
use App\Http\Requests\StoreGiveAward;
use App\Location;
use App\Employee;
use App\EmployeeAward;
class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
{
    $this->middleware(['permission:General_Management|إدارة_عامة']);
}
    public function index()
    {
        $Awards = Award::all();
        return view('pages.Awards.index',compact('Awards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAwards $request)
    {
        $List_Awards = $request->List_awards;

        try {

            $validated = $request->validated();

            foreach ($List_Awards as $List_Award) {

                $Award = new Award();

                $Award->Name = ['en' => $List_Award['Name_Award_en'], 'ar' => $List_Award['Name_Award_ar']];
                $Award->Description = $List_Award['description'];

                $Award->save();

            }

            toastr()->success(trans('messages.Success'));
            return redirect()->route('employeeaward.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAwards $request)
    {
        try {
            $validated = $request->validated();

            $Award = Award::findOrFail($request->id);

            $Award->Name = ['ar' => $request->Name_Award_ar, 'en' => $request->Name_Award_en];

            $Award->Description = $request->description;

            $Award->save();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('employeeaward.index');
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
     * @return \Illuminate\Http\Response
     */
    public function delete_all(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        $Awards = Award::whereIn('id', $delete_all_id);

        $Awards->Delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('employeeaward.index');


    }
    public function destroy(Request $request)
    {
          $Awards = Award::findOrFail($request->id)->delete();
          toastr()->error(trans('messages.Delete'));
          return redirect()->route('employeeaward.index');

    }

}
