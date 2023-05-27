<?php

namespace Modules\Modulescon\Http\Controllers;

use App\Abstracts\Http\Controller;
use Illuminate\Http\Response;
use Modules\Modulescon\Http\Requests\Setting as SettingRequest;
use Modules\Modulescon\Http\Requests\SettingGet as SettingGetRequest;

class Settings extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit()
    {
        return view('modulescon::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SettingRequest $request
     *
     * @return Response
     */
    public function update(SettingRequest $request)
    {
        // Handle the update logic for your module's settings
        // ...

        $message = "Settings updated successfully.";

        flash($message)->success();

        return redirect()->route('modulescon.settings.edit')->with([
            'success' => true,
            'error' => false,
            'message' => $message,
        ]);
    }

    /**
     * Get the specified resource from storage.
     *
     * @param  SettingGetRequest  $request
     *
     * @return Response
     */
    public function get(SettingGetRequest $request)
    {
        // Retrieve and return the requested resource from storage
        // ...

        $data = [];

        return response()->json([
            'errors' => false,
            'success' => true,
            'data'    => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        // Handle the deletion logic for your module's settings
        // ...

        $message = "Settings deleted successfully.";

        flash($message)->success();

        return redirect()->route('modulescon.settings.edit')->with([
            'success' => true,
            'error' => false,
            'message' => $message,
        ]);
    }
}
