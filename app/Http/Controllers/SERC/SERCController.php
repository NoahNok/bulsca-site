<?php

namespace App\Http\Controllers\SERC;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\SERC\StoreSERCRequest;
use App\Http\Requests\SERC\StoreTagRequest;
use App\Models\Casualty\Casualty;
use App\Models\Casualty\CasualtyGroup;
use App\Models\Resource;
use App\Models\SERC\SERC;
use App\Models\SERC\SERCTag;
use DB;
use Illuminate\Http\Request;
use Storage;

class SERCController extends Controller
{
    public function index()
    {


        $sercs = null;





        if (request('s') != null) {
            $sercs = SERC::where('name', 'LIKE', '%' . request('s') . '%');
        }

        if (request('orderByViews')) {
            $sercs = $sercs == null ? SERC::orderBy('views', 'DESC') : $sercs->orderBy('views', 'DESC');
            $sercs->orderBy('when', 'DESC');
        } else {
            $sercs = $sercs == null ? SERC::orderBy('when', 'DESC') : $sercs->orderBy('when', 'DESC');
        }

        $count = [
            'casualties' => Casualty::count(),
            'groups' => CasualtyGroup::count(),
        ];

        return view('admin.sercs.index', ['sercs' => $sercs->paginate(12), 'count' => $count]);
    }

    public function add()
    {

        return view('admin.sercs.add');
    }

    public function store(StoreSERCRequest $request)
    {

        $serc = new \App\Models\SERC\SERC();
        $serc->name = $request->name;
        $serc->description = $request->description;
        $serc->when = $request->when;
        $serc->where = $request->where;
        $serc->casualties = $request->no_cas;
        $serc->author = $request->author;
        $serc->save();

        $files = $request->file('files');
        if ($files != null) {

            foreach ($files as $file) {



                $res = ResourceController::storeFile($file, 'sercs/' . $serc->id, 'self');
                $res->save();

                DB::table('serc_resources')->insert(['serc_id' => $serc->id, 'resource_id' => $res->id]);
            }
        }

        $tags = explode(',', $request->tags);
        foreach ($tags as $tag) {
            if ($tag == '') continue;
            $tag = SERCTag::firstOrCreate(['name' => $tag]);
            $tag->save();
            DB::table('tagged_sercs')->insert(['serc_id' => $serc->id, 'serc_tag_id' => $tag->id]);
        }

        return redirect()->route('admin.sercs.show', ['serc' => $serc]);
    }

    public function show(SERC $serc)
    {

        return view('admin.sercs.show', ['serc' => $serc]);
    }

    public function update(StoreSERCRequest $request, SERC $serc)
    {

        $serc->name = $request->name;
        $serc->description = $request->description;
        $serc->when = $request->when;
        $serc->where = $request->where;
        $serc->casualties = $request->no_cas;
        $serc->author = $request->author;
        $serc->save();

        // Handle files

        $files = $request->file('files');
        if ($files != null) {

            foreach ($files as $file) {



                $res = ResourceController::storeFile($file, 'sercs/' . $serc->id, 'self');
                $res->save();

                DB::table('serc_resources')->insert(['serc_id' => $serc->id, 'resource_id' => $res->id]);
            }
        }




        // Handle tags - remove all tags and re-add
        $tags = explode(',', $request->tags);
        DB::table('tagged_sercs')->where('serc_id', $serc->id)->delete();
        foreach ($tags as $tag) {
            if ($tag == '') continue;
            $tag = SERCTag::firstOrCreate(['name' => $tag]);
            $tag->save();
            DB::table('tagged_sercs')->insert(['serc_id' => $serc->id, 'serc_tag_id' => $tag->id]);
        }

        return redirect()->route('admin.sercs.show', $serc)->with('message', 'Updated SERC!');
    }

    public function tags()
    {
        return response()->json(SERCTag::select('name')->distinct()->pluck('name')->toArray());
    }

    public function delete(SERC $serc)
    {


        $resources = $serc->getResources;

        foreach ($resources as $res) {
            Storage::delete($res->location);
            $res->delete();
        }

        $serc->delete();
        return redirect()->route('admin.sercs')->with('message', 'SERC Deleted!');
    }

    public function deleteResource(SERC $serc, Request $request)
    {
        $validated = $request->validate([
            'id' => 'required'
        ]);

        DB::table('serc_resources')->where('serc_id', $serc->id)->where('resource_id', $validated['id'])->delete();

        $res = Resource::findOrFail($validated['id']);

        Storage::delete($res->location);

        $res->delete();

        return;
    }

    public function publicSERCs()
    {

        $filterOptions = [];

        $filterOptions['cas_min'] = SERC::min('casualties');
        $filterOptions['cas_max'] = SERC::max('casualties');

        $filterOptions['whens'] = DB::select("SELECT DISTINCT year(sercs.when) AS years FROM sercs ORDER BY years DESC;");
        $filterOptions['wheres'] = DB::select("SELECT DISTINCT sercs.where FROM sercs ORDER BY sercs.where;");



        $filterOptions['whens'] = array_map(function ($item) {
            return $item->years;
        }, $filterOptions['whens']);

        $filterOptions['tags'] = SERCTag::where("name", "!=", "")->distinct()->orderBy('name')->get(['id', 'name', 'category'])->groupBy('category');


        return view('resources.sercs', ['count' => SERC::count(), 'filterOptions' => $filterOptions]);
    }

    public function publicSearch()
    {

        // Two queries - one for searching with no tags as its simple


        $query = SERC::with('tags:name,id');

        if (request('tags') != null) {

            $sercIds = DB::table('tagged_sercs')->select('serc_id')->whereIn('serc_tag_id', explode(',', request('tags')))->get()->pluck('serc_id')->toArray();

            $query->whereIn('id', $sercIds);
        }

        if (request('search') != '') {
            $query->where('name', 'LIKE', '%' . request('search') . '%');
        }

        if (request('cas_min') != null) {
            $query->where('casualties', '>=', request('cas_min'));
        }

        if (request('cas_max') != null) {
            $query->where('casualties', '<=', request('cas_max'));
        }

        if (request('when') != 'all') {
            $query->whereYear('when', request('when'));
        }

        if (request('where') != 'all') {
            $query->where('where', request('where'));
        }

        if (request('author') != null) {
            $query->where('author', 'LIKE', '%' . request('author') . '%');
        }






        // Another for searchign when using tags:
        //  SELECT * FROM sercs s INNER JOIN tagged_sercs ts ON ts.serc_id = s.id WHERE serc_tag_id IN (10);


        return response()->json($query->orderBy('when', 'DESC')->get());
    }

    public function getSerc(SERC $serc)
    {

        $serc->views = $serc->views + 1;
        $serc->save();

        $resources = [];

        $serc->load('tags');

        foreach ($serc->getResources as $res) {
            $resources[] = [
                'name' => $res->name,
                'link' => $res->getURL(),
            ];
        }

        $serc['resources'] = $resources;


        unset($serc['getResources']);

        // add view


        return response()->json($serc);
    }

    public function listTags()
    {
        $tags = null;

        if (request('s') != null) {
            $tags = SERCTag::where('name', 'LIKE', '%' . request('s') . '%');
        } else {
            $tags = SERCTag::orderBy('name');
        }

        return view('admin.sercs.tags.index', ['tags' => $tags->paginate(16)]);
    }

    public function getTag(SERCTag $tag)
    {

        $categories = [];

        foreach (SERCTag::select('category')->distinct()->get()->pluck('category')->toArray() as $tagg) {
            $c = new \stdClass();
            $c->id = $tagg ? $tagg : 'null';
            $c->name = $tagg ? $tagg : 'None';
            $categories[] = $c;
        }


        return view('admin.sercs.tags.show', ['tag' => $tag, 'categories' => $categories]);
    }

    public function updateTag(SERCTag $tag, StoreTagRequest $request)
    {
        $tag->name = $request->name;

        if ($request->input('category_new', null)) {
            $tag->category = $request->category_new;
        } else {
            $tag->category = $request->category == 'null' ? null : $request->category;
        }

        $tag->save();

        return redirect()->back()->with('message', 'Updated Tag!');
    }

    public function deleteTag(SERCTag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.sercs.tags.list')->with('message', 'Tag Deleted!');
    }
}
