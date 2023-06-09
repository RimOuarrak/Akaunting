<?php

namespace Modules\Mycalendar\Http\Controllers;

use App\Abstracts\Http\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Document\Document;
use Illuminate\Support\Facades\Log;


class Main extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Document::all();
        return  view('mycalendar::index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('mycalendar::create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    
    public function store(Request $request)
    {
        $event = Event::create([
            'title' => $request->input('title'),
            'start' => $request->input('start'), // Check column name
            'end' => $request->input('end'), // Check column name
            'color' => '#6da252',
            'textColor' => 'white',
        ]);        
        return response()->json($event);
     }     

    /**
     * Show the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $document = Document::findOrFail($id);
        return response()->json($document);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('mycalendar::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    
     public function update(Request $request, $id)
     {
         $event = Event::findOrFail($id);
        $event->update([
            'start' => $request->input('start'), // Check column name
            'end' => $request->input('end'), // Check column name
        ]);     
         return response()->json($event);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(['message' => 'Event deleted']);
    }

    public function events()
    {
        $events = Event::all();

        $formattedEvents = [];
    
        foreach ($events as $event) {
            $formattedEvents[] = [
                'title' => $event->title,
                'start' => $event->start_date,
                'end' => $event->end_date,
                'color' => '#6da252',
                'textColor' => 'white',
            ];
        }
    
        return response()->json($formattedEvents);
    }

}
