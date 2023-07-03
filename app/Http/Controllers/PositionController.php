<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use App\Department;
use App\Employee;
use App\Http\Requests\StorePositions;

class PositionController extends Controller
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
    $Departments = Department::all();
    $departments_positions = Department::with(['positions'])->get();
    $department_employees = Department::with(['employees'])->get();
    return view('pages.Positions.Positions', compact('department_employees','Departments','departments_positions'));
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
  public function store(StorePositions $request)
  {





    try {
        $validated = $request->validated();
        $Position = new Position();
        /*
        $translations = [
            'en' => $request->Role_en,
            'ar' => $request->Role_ar
        ];
        $Grade->setTranslations('Role', $translations);
        */
        $Position->Role = ['en' => $request->Role_en, 'ar' => $request->Role_ar];
        $Position->Salary = $request->Salary;

        if ($request->FT_PT == "دوام كامل" || $request->FT_PT == "Full Time" ) {
            $Position->FT_PT  =['ar' => 'دوام كامل', 'en' => 'Full Time'];
        }
        elseif ($request->FT_PT == "دوام جزئي" || $request->FT_PT == "Part Time" ) {
            $Position->FT_PT  =['ar' => 'دوام جزئي', 'en' => 'Part Time'];
        }

        $Position->Requirements = $request->Requirements;
        $Position->Department_Id = $request->position_department;
        $Position->Status = 1;


        $Position->save();
        toastr()->success(trans('messages.Success'));
        return redirect()->route('position.index');
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
  public function update(StorePositions $request)
  {

    try {
        $validated = $request->validated();
        $position = Position::findOrFail($request->id);


            $position->Role = ['en' => $request->Role_en, 'ar' => $request->Role_ar];
            $position->Salary = $request->Salary;
            if ($request->FT_PT == "دوام كامل" || $request->FT_PT == "Full Time" ) {
                $position->FT_PT  =['ar' => 'دوام كامل', 'en' => 'Full Time'];
            }
            elseif ($request->FT_PT == "دوام جزئي" || $request->FT_PT == "Part Time" ) {
                $position->FT_PT  =['ar' => 'دوام جزئي', 'en' => 'Part Time'];
            }
            $position->Requirements = $request->Requirements;
            $position->Department_Id = $request->position_department;

            if(isset($request->Status)) {
                $position->Status = 1;
              } else {
                $position->Status = 0;
              }


               // update pivot tABLE


            $position->save();




        toastr()->success(trans('messages.Update'));
        return redirect()->route('position.index');
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
  public function destroy(Request $request)
  {
    $position = Position::findOrFail($request->id)->delete();
    toastr()->error(trans('messages.Delete'));
    return redirect()->route('position.index');
  }

}

?>
