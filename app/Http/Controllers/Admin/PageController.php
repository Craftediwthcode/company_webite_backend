<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\Page;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{File,Response, Validator};

class PageController extends Controller
{
    /**
     * Show the admin page index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.index');
    }
    /**
     * Handles AJAX requests for the datatables of pages.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Yajra\DataTables\DataTableAbstract JSON response for DataTables
     */
    public function ajaxTable(Request $request)
    {
        $pages = Page::where('parent_id', 0);
        return Datatables::of($pages)
            ->addIndexColumn()
            ->editColumn('banner_image', function ($data) {
                $path = $data->banner_image && file_exists($data->banner_image) ? asset($data->banner_image) : asset('assets/placeholder.jpg');
                $image = "<img src='$path' width='80px' height='50px' alt='image' class='img-fluid avatar-md rounded'>";
                return $image;
            })
            ->editColumn('main_image', function ($data) {
                $path = $data->image && file_exists($data->image) ? asset($data->image) : asset('assets/placeholder.jpg');
                $image = "<img src='$path' width='80px' height='50px' alt='image' class='img-fluid avatar-md rounded'>";
                return $image;
            })
            ->addColumn('action', function ($data) {
                $action = "";
                $action = '<a href="' . route('page.edit', $data->id) . '" title="Edit" class="btn btn-sm btn-info waves-effect waves-light m-2"><i class="fa fa-edit"></i></a>';
                return $action;
            })
            ->rawColumns(['action', 'banner_image', 'main_image'])
            ->make(true);
    }
    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }
    /**
     * Store a newly created page in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'nullable',
                'image' => 'mimes:jpeg,jpg,png,gif|max:2048',
                'banner_image' => 'mimes:jpeg,jpg,png,gif|max:2048',
            ]);
            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()]);
            }
            $imagePath = null;
            if ($request->hasFile('image')) {
                try {
                    $imagePath = Helper::imageUpload($request->file('image'), 'uploads/pages/main_image');
                    $imagePath = 'uploads/pages/main_image/' . $imagePath;
                } catch (\Exception $e) {
                    return Response::json(['error' => __('Could not upload the main image: ' . $e->getMessage())]);
                }
            }
            $bannerImagePath = null;
            if ($request->hasFile('banner_image')) {
                try {
                    $bannerImagePath = Helper::imageUpload($request->file('banner_image'), 'uploads/pages/banner_image');
                    $bannerImagePath = 'uploads/pages/banner_image/' . $bannerImagePath;
                } catch (\Exception $e) {
                    return Response::json(['error' => __('Could not upload the banner image: ' . $e->getMessage())]);
                }
            }
            Page::create([
                'title' => $request->title,
                'description' => $request->description,
                'banner_image' => $bannerImagePath,
                'image' => $imagePath,
            ]);
            return Response::json(['success' => __('Page Created Successfully.')]);
        } catch (\Exception $e) {
            dd($e);
            return Response::json(['error' => __('Something went wrong. Please try again.')]);
        }
    }
    /**
     * Show the form for editing the specified page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module_data = Page::with('seo')->find($id);
        return view('admin.pages.edit', compact('module_data'));
    }
    /**
     * Update the specified page in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'nullable',
                'image' => 'mimes:jpeg,jpg,png,gif|max:2048',
                'banner_image' => 'mimes:jpeg,jpg,png,gif|max:2048',
            ]);
            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()]);
            }
            $page = Page::find($id);
            $imagePath = $page->image;
            if ($request->hasFile('image')) {
                try {
                    if ($imagePath && File::exists(public_path($imagePath))) {
                        File::delete(public_path($imagePath));
                    }
                    $imagePath = Helper::imageUpload($request->file('image'), 'uploads/pages/main_image');
                    $imagePath = 'uploads/pages/main_image/' . $imagePath;
                } catch (\Exception $e) {
                    return Response::json(['error' => __('Could not upload the main image: ' . $e->getMessage())]);
                }
            }
            $bannerImagePath = $page->banner_image;
            if ($request->hasFile('banner_image')) {
                try {
                    if ($bannerImagePath && File::exists(public_path($bannerImagePath))) {
                        File::delete(public_path($bannerImagePath));
                    }
                    $bannerImagePath = Helper::imageUpload($request->file('banner_image'), 'uploads/pages/banner_image');
                    $bannerImagePath = 'uploads/pages/banner_image/' . $bannerImagePath;
                } catch (\Exception $e) {
                    return Response::json(['error' => __('Could not upload the banner image: ' . $e->getMessage())]);
                }
            }
            $page->update([
                'title' => $request->title,
                'description' => $request->description,
                'banner_image' => $bannerImagePath,
                'image' => $imagePath,
            ]);
            return Response::json(['success' => __('Page Updated Successfully.')]);
        } catch (\Exception $e) {
            return Response::json(['error' => __('Something went wrong. Please try again.'), 'error' => $e->getMessage()]);
        }
    }
    /**
     * Checks if the provided title is unique in the pages table.
     *
     * This method takes the title and an optional title_id parameter.
     * If the title_id is provided, we will exclude that id from the unique validation.
     * If the title_id is not provided, we will do a standard unique validation.
     *
     * @param \Illuminate\Http\Request $request The request containing the title to check.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating if the title already exists.
     */
    public function checkUniqueTitle(Request $request)
    {
        $title_id = $request->input('title_id');
        $rules = [];
        if ($title_id) {
            $rules['title'] = 'unique:pages,title,' . $title_id;
        } else {
            $rules['title'] = 'unique:pages,title';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response::json(['exists' => true]);
        } else {
            return Response::json(['exists' => false]);
        }
    }
    /**
     * Fetches parent pages based on the given query.
     *
     * @param \Illuminate\Http\Request $request The request containing the query to search for.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the results of the search.
     */
    public function fetchParentPages(Request $request)
    {
        $query = $request["q"];
        $results = [];
        Page::where('title', 'LIKE', "%{$query}%")
            ->where('parent_id', '=', 0)
            ->chunk(100, function ($pages) use (&$results) {
                foreach ($pages as $page) {
                    $results[] = $page;
                }
            });
        return Response::json($results);
    }
}
