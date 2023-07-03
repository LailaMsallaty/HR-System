<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendance;
use App\Employee;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Employees = Employee::count();
        $count_Employees = Employee::where('Trainee->en','No')->count();
        $count_Trainee_Employees = Employee::where('Trainee->en','Yes')->count();

        $employees = trans('employees-trans.title_page');
        $trainees = trans('reports-trans.Trainees');

        if($count_Employees == 0){
            $percent_employees = 0;
        }
        else{
            $percent_employees = $count_Employees / $Employees *100;
        }

          if($count_Trainee_Employees == 0){
              $percent_trainees = 0;
          }
          else{
              $percent_trainees = $count_Trainee_Employees / $Employees * 100;
          }

        $chartjs = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 300])
        ->labels([$employees,$trainees])
        ->datasets([
            [
                'backgroundColor' => ['#e39ae3', '#43bbbb'],
                'hoverBackgroundColor' => ['#e39ae3', '#43bbbb '],
                'data' => [$percent_employees, $percent_trainees]
            ]
        ])
        ->options([]);

        $now = Carbon::now();
        $count_all = Attendance::whereYear('attendance_date',$now->year)->count();
        $count_Presents = Attendance::where('attendance_status', 1)->whereYear('attendance_date',$now->year)->count();
        $count_Absents = Attendance::where('attendance_status', 0)->whereYear('attendance_date',$now->year)->count();

        if($count_Presents == 0){
            $percent1 = 0;
        }
        else{
            $percent1 = $count_Presents / $count_all *100;
        }

          if($count_Absents == 0){
              $percent2 = 0;
          }
          else{
              $percent2 = $count_Absents / $count_all * 100;
          }

          $Present = trans('attendance-trans.Present');
          $Absent = trans('attendance-trans.Absent');
          $Attendance = trans('attendance-trans.title_page');

          $chartjs2 = app()->chartjs
          ->name('barChartTest')
          ->type('bar')
          ->size(['width' => 400, 'height' => 200])
          ->labels([$Attendance.' '.$now->year])
          ->datasets([
              [
                  "label" => $Present,
                  'backgroundColor' => ['#43bbbb'] ,
                  'data' => [ $percent1]
              ],
              [
                  "label" => $Absent,
                  'backgroundColor' => ['#e39ae3'],
                  'data' => [ $percent2]
              ],


          ])
          ->options([
            'scales' => [
                'yAxes' => [
                    [
                        'ticks' => [
                            'beginAtZero' => true,

                        ],

                    ],
                ],
                'xAxes' => [
                    [
                        'barPercentage'=> 0.5,
                    ],
                ],
            ],
          ]);


return view('dashboard', compact('chartjs','chartjs2'));


 // example.blade.php
    }



    public function MarkAsRead_all(Request $request)
    {

        $userUnreadNotification = auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }


    }

    public function MarkAsRead(Request $request)
    {

        $userUnreadNotification = auth()->user()->unreadNotifications;

       return  $userUnreadNotification->markAsRead();

    }

    public function show($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
            return redirect()->route($notification->data['url']);
        }
    }


}
