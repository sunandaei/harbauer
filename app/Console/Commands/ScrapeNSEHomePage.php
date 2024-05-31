<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Log;

class ScrapeNSEHomePage extends Command
{
    protected $signature = 'scrape:nse';

    protected $description = 'Scrape NSE homepage';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Log::debug('ScrapeNSEHomePage command started.');

        // Create a Guzzle HTTP client
        $client = new Client();

        // Send a GET request to the NSE homepage
        $response = $client->request('GET', 'https://trendlyne.com/features/');

        // Log response status code
        Log::debug('Response status code: ' . $response->getStatusCode());

        // Check if the request was successful
        if ($response->getStatusCode() == 200) {
            // Get the HTML content of the response
            $html = $response->getBody()->getContents();

            // Parse the HTML using Symfony DomCrawler
            $crawler = new Crawler($html);

            // Extract desired data from the HTML
            $title = $crawler->filter('title')->text();
            // You can add more filters to extract other elements as needed

            // Log extracted data
            Log::debug("Title: $title");
        } else {
            Log::error('Failed to retrieve NSE homepage.');
            $this->error('Failed to retrieve NSE homepage.');
        }

        Log::debug('ScrapeNSEHomePage command completed.');
    }
}
