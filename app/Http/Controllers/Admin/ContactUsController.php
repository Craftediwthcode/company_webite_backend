<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('admin.contactus.index');
    }

    public function ajaxTable(Request $request)
    {
        $contactus = ContactUs::query();
        return Datatables::of($contactus)
            ->addIndexColumn()
            ->make(true);
    }
}
