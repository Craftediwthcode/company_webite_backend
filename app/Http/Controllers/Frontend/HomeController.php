<?php

namespace App\Http\Controllers\Frontend;

use App\Models\{Page,Setting,ContactUs};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $our_latest_program = Page::where('slug', 'our-latest-program-for-seo-marketing')->first();
        $digital_marketing  = Page::where('slug', 'digital-marketing')->first();
        $our_services = Page::where('type', 'our_services')->get();
        $industries = Page::where('type','industries')->get();
        return view('frontend.index',compact('our_latest_program','digital_marketing','our_services','industries'));
    }
    public function aboutUs()
    {
        $module_data = Page::where('slug', 'about-us')->with('children')->first();
        return view('frontend.about',compact('module_data'));
    }
    public function portfolio()
    {
        $module_data = Page::where('type','portfolio')->get();
        // dd($module_data);
        return view('frontend.portfolio',compact('module_data'));
    }
    public function contactUs()
    {
        $data['address'] = Setting::where('key', 'address')->first();
        $data['email'] = Setting::where('key', 'email')->first();
        $data['phone'] = Setting::where('key', 'phone')->first();
        $data['facebook_url'] = Setting::where('key', 'facebook_url')->first();
        $data['instagram_url'] = Setting::where('key', 'instagram_url')->first();
        $data['linkedin_url'] = Setting::where('key', 'linkedin_url')->first();
        return view('frontend.contact-us',compact('data'));
    }
    public function submitContactUs(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);
        $data = ContactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message
        ]);
        // Mail::send('emails.contact-us', $data, function ($message) use ($data) {
        //     $message->from($data['email'], $data['name']);
        //     $message->subject($data['subject']);
        //     $message->to('n2V0l@example.com', 'Admin');
        // });
        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }
}
