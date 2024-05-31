<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nesk\Puphpeteer\Puppeteer;

class WebScrapingController extends Controller
{
    public function scrapeWebsite()
    {
        // Launch a headless browser instance
        $puppeteer = new Puppeteer();
        $browser = $puppeteer->launch();

        // Create a new page
        $page = $browser->newPage();

        // Navigate to the URL you want to scrape
        $page->goto('https://www.niftytrader.in/options-max-pain-chart-live/FINNIFTY');

        // Extract information from the page
        $title = $page->title();
        $content = $page->content();

        // Close the browser
        $browser->close();

        dd($content);

        // Return the scraped data or do something with it
        return response()->json([
            'title' => $title,
            'content' => $content
        ]);
    }
}
