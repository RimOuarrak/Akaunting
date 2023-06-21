<?php

namespace App\Http\Controllers\Modules;

use App\Abstracts\Http\Controller;
use App\Models\Module\Module;

class Home extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->response('modules.home.index');
    }

    /**
     * Show the form for viewing the specified resource.
     *
     * @return Response
     */
    public function show()
    {
        return redirect()->route('apps.home.index');
    }

    public function details($id)
    {
        $module = Module::find($id);
        return view('modules.home.details',compact('module'));
    }

    public function update(Request $request, $moduleId)
    {
        $module = Module::find($moduleId);
        $module->enabled = $request->enabled;
        $module->save();
        return redirect()->route('apps.home.details');
    }

    
}
