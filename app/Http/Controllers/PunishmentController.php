<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Punishment;
use App\Http\Requests\StorePunishment;

class PunishmentController extends Controller
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
        $Punishments = Punishment::all();
        return view('pages.Punishments.Punishments',compact('Punishments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePunishment $request)
    {
        $List_Punishments = $request->List_Punishments;

        try {

            $validated = $request->validated();

            foreach ($List_Punishments as $List_Punishment) {

                $Punishment = new Punishment();

                $Punishment->Name = ['en' => $List_Punishment['Name_Punishment_en'], 'ar' => $List_Punishment['Name_Punishment_ar']];

                $Punishment->Description = $List_Punishment['description'];
                $Punishment->Deducted_Amount = $List_Punishment['amount'];

                $Punishment->save();

            }

            toastr()->success(trans('messages.Success'));
            return redirect()->route('punishment.index');
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
    public function update(StorePunishment $request)
    {
        try {

            $validated = $request->validated();

            $Punishment = Punishment::findOrFail($request->id);

            $Punishment->Name = ['ar' => $request->Name_Punishment_ar, 'en' => $request->Name_Punishment_en];


            $Punishment->Description = $request->description;
            $Punishment->Deducted_Amount =  $request->amount;

            $Punishment->save();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('punishment.index');
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
    public function delete_all_Punishments(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        $Punishments = Punishment::whereIn('id', $delete_all_id);

        $Punishments->Delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('punishment.index');


    }
    public function destroy(Request $request)
    {
          $Punishment = Punishment::findOrFail($request->id)->delete();
          toastr()->error(trans('messages.Delete'));
          return redirect()->route('punishment.index');

    }
}
