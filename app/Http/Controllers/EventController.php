<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Http\Requests\StoreEvents;
use Illuminate\Support\Facades\DB;
use App;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCalendar()
    {

        $Events = Db::table('events')
        ->select('title->'.App::getLocale().'  as title','start','end')
        ->get();

        $events =  $Events->toArray();

        return json_encode($events);
    }

    public static function getNameAttribute($value)
    {
        return json_decode($value)->{\App::getLocale()};
    }


    public function index()
    {
        $events = Event::all();

        return view('pages.Events.Events',compact('events'));

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
    public function store(StoreEvents $request)
    {
        $List_Events = $request->List_Events;

        try {

            $validated = $request->validated();

            foreach ($List_Events as $List_Event) {

                $Events = new Event();

                $Events->title = ['en' => $List_Event['Name_Event_en'], 'ar' => $List_Event['Name_Event_ar']];
                $Events->start = $List_Event['From'];
                $Events->end = $List_Event['To'];

                $Events->save();

            }

            toastr()->success(trans('messages.Success'));
            return redirect()->route('event.index');
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
    public function update(StoreEvents $request)
    {
        try {

            $validated = $request->validated();

            $Events = Event::findOrFail($request->id);

            $Events->title = ['ar' => $request->Name_Event_ar, 'en' => $request->Name_Event_en];

            $Events->start = $request->From;
            $Events->end = $request->To;

            $Events->save();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('event.index');
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

        $Events = Event::whereIn('id', $delete_all_id);

        $Events->Delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('event.index');


    }
    public function destroy(Request $request)
    {
          $Events = Event::findOrFail($request->id)->delete();
          toastr()->error(trans('messages.Delete'));
          return redirect()->route('event.index');

    }

}
