<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FbPostTemplate;

class FbSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth');
        
    }
    public function setDefault($id)
    {
        $DB = FbPostTemplate::findOrFail($id);
        FbPostTemplate::where('category', $DB->category)->update(['is_default' => false]);
        $DB->is_default = true;
        $DB->save();
        return redirect(route('fb-settings.index'));
    }

    public function index()
    {
        //
        $goodTP = FbPostTemplate::where('category', 'Good')->get();
        $moderateTP = FbPostTemplate::where('category', 'Moderate')->get();
        $USGTP = FbPostTemplate::where('category', 'UnhealthyForSensitiveGroups')->get();
        $unhealthyTP = FbPostTemplate::where('category', 'Unhealthy')->get();
        $veryUnhealthyTP = FbPostTemplate::where('category', 'VeryUnhealthy')->get();
        $hazardousTP = FbPostTemplate::where('category', 'Hazardous')->get();
        $defaults = FbPostTemplate::select('id')->where('is_default', true)->get();
        return view('admin.fbsettings.index', compact(['goodTP', 'moderateTP', 'USGTP', 'unhealthyTP',
                            'veryUnhealthyTP', 'hazardousTP', 'defaults']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.fbsettings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated_data = $request->validate([
            'name' =>'required',
            'templateEN' => 'required',
            'templateMM' => 'required',
            'category' => 'required'
        ]);
        $FB_db = FbPostTemplate::create([
            'name' => $validated_data['name'],
            'template_en' => $validated_data['templateEN'],
            'template_my_MM' => $validated_data['templateMM'],
            'category' => $validated_data['category']
        ]);
        return redirect(route('fb-settings.index'));
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
        $template = FbPostTemplate::findOrFail($id);
        return view('admin.fbsettings.show', compact([
            'template'
        ]));
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
        $template = FbPostTemplate::findOrFail($id);
        return view('admin.fbsettings.edit', compact('template'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validated_data = $request->validate([
            'name' => 'required',
            'templateEN' => 'required',
            'templateMM' => 'required',
            'category' => 'required'
        ]);
        $template = FbPostTemplate::findOrFail($id);
        $template->name = $validated_data['name'];
        $template->template_en = $validated_data['templateEN'];
        $template->template_my_MM = $validated_data['templateMM'];
        $template->category = $validated_data['category'];
        $template->save();
        return redirect(route('fb-settings.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $FB_db = FbPostTemplate::destroy($id);
        return redirect(route('fb-settings.index'));
    }
}
