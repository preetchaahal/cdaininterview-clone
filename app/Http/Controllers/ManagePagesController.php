<?php
namespace App\Http\Controllers;

use Mail;
use App\SitePage;
use App\SiteConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class ManagePagesController extends Controller
{
 
    public function save(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        
        $formDataNoindex = 0;
        if (!empty($request->get('noindex')) && strtolower($request->get('noindex')) == 'on') {
            $formDataNoindex = 1;
        }

        SitePage::where('id', $request->get('id'))
            ->update([
                'meta_title' => $request->get('meta_title'),
                'meta_description' => $request->get('meta_description'),
                'noindex' => $formDataNoindex,
                'html_content' => $request->get('html_content')
            ]);

        return Response()->json([
            "status" => 1
        ], Response::HTTP_OK);

 
    }

    public function contact(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        $config = SiteConfig::where('key', 'contact_email')->first();

        if (!empty($config)) {
            $site_email = $config->value;
            $query = <<<EOT
New Contact-Form Query received
Name: {$request->name}
Email:{$request->email}
Message: {$request->message}
EOT;
            Mail::raw($query, function($message) use ($site_email) {
                $message->subject('Contact-us: New Form-query');
                $message->from('gurpreet.24.chahal@gmail.com','Gurpreet S Chahal');
                $message->to($site_email);
            });
        }

    }

    public function saveSiteConfig(Request $request)
    {
        $request->validate([
            'contact_email' => 'required',
        ]);
        
        SiteConfig::where('key', 'contact_email')
            ->update([
                'value' => $request->get('contact_email')
            ]);

        SiteConfig::where('key', 'google_analytics_tracking_id')
            ->update([
                'value' => $request->get('google_analytics_tracking_id')
            ]);

        SiteConfig::where('key', 'fb_pixel_code')
            ->update([
                'value' => $request->get('fb_pixel_code')
            ]);

        return Response()->json([
            "status" => 1
        ], Response::HTTP_OK);

 
    }
}
