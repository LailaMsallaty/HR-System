<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Employee;
use App\Http\Requests\StoreDepartments;



class DepartmentController extends Controller
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
    return view('pages.Departments.Departments', compact('Departments'));

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
  public function store(StoreDepartments $request)
  {

    $List_Departments = $request->List_Departments;

    try {

        $validated = $request->validated();

        foreach ($List_Departments as $List_Department) {

            $Departments = new Department();

            $Departments->Name = ['en' => $List_Department['Name_department_en'], 'ar' => $List_Department['Name_department_ar']];

            $Departments->save();

        }

        toastr()->success(trans('messages.Success'));
        return redirect()->route('department.index');
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
  public function update(StoreDepartments $request)
  {
    try {

        $validated = $request->validated();

        $Departments = Department::findOrFail($request->id);

        $Departments->Name = ['ar' => $request->Name_department_ar, 'en' => $request->Name_department_en];

        $Departments->save();

        toastr()->success(trans('messages.Update'));
        return redirect()->route('department.index');
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

      $Departments = Department::whereIn('id', $delete_all_id);

      $Employees = Employee::whereIn('Department_Id',$delete_all_id)->pluck('Department_Id');


            if ($Employees->count() == 0) {
                $Departments->Delete();
                toastr()->error(trans('messages.Delete'));
                return redirect()->route('department.index');
            }
            else{

                toastr()->error(trans('system-trans.delete_Departmnt_Error'));
                return redirect()->route('department.index');

            }

  }
  public function destroy(Request $request)
  {
    $Employee_id = Employee::where('Department_Id',$request->id)->pluck('Department_Id');

    if($Employee_id->count() == 0){

        $Departments = Department::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('department.index');
    }

    else{

        toastr()->error(trans('departments-trans.delete_Departmnt_Error'));
        return redirect()->route('department.index');

    }
  }

}

?>
