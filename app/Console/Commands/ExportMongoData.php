<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Config;

use Storage;
use Carbon\Carbon;
use DB;
use App\Routine;

class ExportMongoData extends Command
{
    public $successStatus = 200;
    public $badRequestStatus = 400;
    public $unAuthorisedStatus = 401;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:mongo-data';
    /**
     * The console command description.
     *
     * @var string
     */
     protected $description = 'Export MongoDB data to S3';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $IAM_KEY =  config('values.AWS_ACCESS_KEY_ID','');
        $IAM_SECRET = config('values.AWS_SECRET_ACCESS_KEY','');
        $bucketName = config('values.AWS_BUCKET','');

    try {

        $s3 = S3Client::factory(
        array(
            'credentials' => array(
                'key' => $IAM_KEY,
                'secret' => $IAM_SECRET),
                'version' => 'latest',
                'region'  => 'ap-south-1'
            )
        );
        } 
        catch (Exception $e) 
        {

        $response['success'] = false;
        $response['resCode'] = $this->successStatus;
        $response['message'] = $e->getMessage();
        return response()->json($response, $this->successStatus);
        }









        $s3 = Storage::disk('s3');

        $mongoClient = new Client("mongodb://your-mongodb-host:27017");
        $mongoCollection = $mongoClient->your_database->your_collection;

        $data = $mongoCollection->find();

        foreach ($data as $document) {
            $date = Carbon::parse($document->date_field);
            $year = $date->year;
            $month = $date->format('M');
            $day = $date->day;

            $jsonFileName = "your-prefix/{$year}/{$month}/{$day}/{$document->_id}.json";
            $jsonData = json_encode($document);

            //$s3->put($jsonFileName, $jsonData);
            try {
                    // Uploaded:
                   // $file = $request->file('image');
                    //$s3FolderPath = $type.'/'.$name;

            $s3->putObject(
                array(
                'Bucket'=>$bucketName,
                'Key' =>  $s3FolderPath,
                'SourceFile' => $file,
                'StorageClass' => 'STANDARD',
                'ACL' => 'public-read',
                'ContentType' => $extension
                )
            );
            } 
            catch (S3Exception $e) 
            {
            $response['success'] = false;
            $response['resCode'] = $this->successStatus;
            $response['message'] = $e->getMessage();
            return response()->json($response, $this->successStatus);
            } 

        }

        $this->info('MongoDB data exported to S3.');
    }
}
