<?php
use Illuminate\Support\Facades\Route;
use App\SitePage;
use App\SiteConfig;

function getCurrentPageInfo($key)
{
	$currentSlug = Route::currentRouteName();
	$pageInfo = SitePage::where('slug', $currentSlug)->first();

	if (!empty($pageInfo) && !empty($pageInfo->{$key})) {
		return $pageInfo->{$key};
	}

}

function getSiteLogo()
{
	$siteLogo = SiteConfig::where('key', 'site_logo')->first();
    if (!empty($siteLogo)) {
        return $siteLogo->value;
    }
}

function getHomePageImage()
{
	$homePageImage = SiteConfig::where('key', 'home_page_image')->first();
    if (!empty($homePageImage)) {
        return $homePageImage->value;
    }
}


function getContactPageImage()
{
    $contactPageImage = SiteConfig::where('key', 'contact_page_image')->first();
    if (!empty($contactPageImage)) {
        return $contactPageImage->value;
    }	
}

function getHomePageHtml()
{
    $homePageHtml = SitePage::where('id', 1)->first();
    if (!empty($homePageHtml)) {
        return $homePageHtml->html_content;
    }
}

function getContactPageHtml()
{
    $contactPageHtml = SitePage::where('id', 2)->first();
    if (!empty($contactPageHtml)) {
        return $contactPageHtml->html_content;
    }
}

function getGoogleAnalyticsTag()
{
    $config = SiteConfig::where('key', 'google_analytics_tracking_id')->first();
    if (empty($config) || empty($config->value)) {
        return;
    }
    $gTrackingId = $config->value;

$str = <<<EOT
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={$gTrackingId}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '{$gTrackingId}');
</script>
EOT;
    
    return $str;

}

function getFbPixelTag()
{
    $config = SiteConfig::where('key', 'fb_pixel_code')->first();
    if (empty($config) || empty($config->value)) {
        return;
    }

    return $config->value;
}