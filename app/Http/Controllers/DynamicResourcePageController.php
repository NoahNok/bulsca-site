<?php

namespace App\Http\Controllers;

use App\Models\ResourcePage;
use App\Models\ResourcePageSection;
use App\Models\ResourcePageSectionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DynamicResourcePageController extends Controller
{
    
    public function adminUpload(Request $request) {

        $validated = $request->validate([
            'resource' => 'file|required',
            'section' => 'required',
            'name' => 'required'
        ]);




    

        $storedRes = ResourceController::storeResource($request, 'resource', 'resources/resources', $validated['name']);

        $rps = ResourcePageSection::findOrFail($validated['section']);
        $rpsr = new ResourcePageSectionResource();

        $rpsr->section = $rps->id;
        $rpsr->resource = $storedRes->id;
        $rpsr->short = "";

        $rpsr->save();

        return redirect()->back();

    }

    public function createNewSection(Request $request) {

        $validated = $request->validate([
            'name' => 'required',
            'page' => 'required'
        ]);


        $rps = new ResourcePageSection();
        $rps->name = $validated['name'];
        $rps->page = $validated['page'];

        $rps->save();

        return redirect()->back();

    }

    public function deleteSection(Request $request) {
        $sec = ResourcePageSection::findOrFail($request->input('id', -1));

        $sec->delete();

        return redirect()->back();
    }

    public function createNewPage(Request $request) {

        $validated = $request->validate([
            'name' => 'required',
        ]);


        $rp = new ResourcePage();
        $rp->name = $validated['name'];
      

        $rp->save();

        return redirect()->back();

    }

    public function deletePage(Request $request) {
        $p = ResourcePage::findOrFail($request->input('id', -1));

        $p->delete();

        return redirect()->route('admin.resources');
    }

    public function index(){
        return view('resources.index', ['pages' => ResourcePage::orderBy('name')->get()]);
    }

    public function view($page) {

        $page = Str::replace('-', ' ', $page);

        $p = ResourcePage::where('name','like', $page)->first();

        if (!$p) {
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return response()->view('errors.404',$data,404);
        }

        return view('resources.view', ['p' => $p]);
    }

}