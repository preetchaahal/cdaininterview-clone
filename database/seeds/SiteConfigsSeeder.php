<?php

use Illuminate\Database\Seeder;

class SiteConfigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('site_configs')->insert([
            'key' => 'site_logo',
            'value' => 'https://cdainterview.com/rw_common/images/bemo-logo2.png'
        ]);

        DB::table('site_configs')->insert([
            'key' => 'home_page_image',
            'value' => 'https://cdainterview.com/resources/cda-interview-guide.jpg'
        ]);

        DB::table('site_configs')->insert([
            'key' => 'contact_page_image',
            'value' => 'https://cdainterview.com/resources/contact-us.png'
        ]);

        DB::table('site_configs')->insert([
            'key' => 'contact_email',
            'value' => 'gurpreet.24.chahal@gmail.com'
        ]);

        DB::table('site_configs')->insert([
            'key' => 'google_analytics_tracking_id',
            'value' => 'UA-173521238-1'
        ]);

        DB::table('site_configs')->insert([
            'key' => 'fb_pixel_code',
            'value' => <<<EOT
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '290384798878403');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=290384798878403&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
EOT
        ]);

    }

}