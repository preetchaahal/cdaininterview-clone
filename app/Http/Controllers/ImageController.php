<?php
namespace App\Http\Controllers;

use App\SiteConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    public function index() {
        return view('image');
    }
 
    public function save(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        if ($files = $request->file('image')) {
            $fileName =  "image-".time().'.'.$request->image->getClientOriginalExtension();
            Storage::disk('public')->put($fileName, File::get($request->image));
            
            $url = URL::to('uploads/'.$fileName);
            SiteConfig::where('key', $request->get('key'))
                ->update(['value' => $url]);

            return Response()->json([
                "image" => $url
            ], Response::HTTP_OK);
 
        }
 
    }
}
