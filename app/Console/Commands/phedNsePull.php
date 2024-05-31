<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Models\OptionNifty;

class PhedNsePull extends Command
{
    protected $signature = 'phed:nse-pull';
    protected $description = 'Pull data from NSE server for OptionNifty';

    public function handle()
    {
        date_default_timezone_set("Asia/Calcutta");
        $time = date("h:i:sa");
        //start date for data sent to jjm       
    $to = Carbon::createFromFormat('Y-m-d H:i:s',date('Y-m-d 00:00:00',strtotime("-3 days")));

          $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.nseindia.com/api/option-chain-indices?symbol=NIFTY',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET'
        
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $res = json_decode($response);

        $i=1;

$dataDateTime = Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i',strtotime($res->records->timestamp)));

$expiryTime = $dataDateTime->toTimeString();

$craetedDay =Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i',strtotime($res->records->timestamp)))->day;
$craetedMonth =Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i',strtotime($res->records->timestamp)))->month;

$craetedYear =Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i',strtotime($res->records->timestamp)))->year;

$find = PhedStatus::where("underlying",'NIFTY')
        ->where('dataCreatedDate',$dataDateTime)
        ->first();

 if(!empty($find)) 
 {
    dd('We allready pushed this data of timeStamp'.$dataDateTime);
 }      


        foreach($res->records->data as $d) 
        {
            //check whether record exist or not

            



            
echo $i;
echo "<br />";
$i++;
            $phedStatusData = new OptionNifty;
            if(isset($d->PE->strikePrice))
            {   
            
            $phedStatusData->dataCreatedDate =$dataDateTime;
            $phedStatusData->dataCreatedTime =$expiryTime;

            $phedStatusData->dataCreatedDay =$craetedDay;

            $phedStatusData->dataCreatedMonth =$craetedMonth;

            $phedStatusData->dataCreatedYear =$craetedYear;
    

            $phedStatusData->strikePrice =(isset($d->PE->strikePrice) ? $d->PE->strikePrice : null);

            $phedStatusData->optionType ='PE';

            if(isset($d->PE->expiryDate))
            {   
                $expiryDate = Carbon::createFromFormat('Y-m-d',date('Y-m-d',strtotime($d->PE->expiryDate)));        
            }
            else
            {
                $expiryDate =null;
            }


            if(isset($d->PE->expiryDate))
            {   
                $expiryDate = Carbon::createFromFormat('Y-m-d',date('Y-m-d',strtotime($d->PE->expiryDate)));        
            }
            else
            {
                $expiryDate =null;
            }
            $phedStatusData->expiryDate =$expiryDate;

            $phedStatusData->expiryTime =$expiryTime;

            $phedStatusData->identifier =(isset($d->PE->identifier) ? $d->PE->identifier : null);

            $phedStatusData->askPrice =(isset($d->PE->askPrice) ? $d->PE->askPrice : null);
            $phedStatusData->askQty =(isset($d->PE->askQty) ? $d->PE->askQty : null);
            $phedStatusData->bidprice =(isset($d->PE->bidprice) ? $d->PE->bidprice : null);
            $phedStatusData->bidQty =(isset($d->PE->bidQty) ? $d->PE->bidQty : null);
            $phedStatusData->change =(isset($d->PE->change) ? $d->PE->change : null);
            $phedStatusData->changeinOpenInterest =(isset($d->PE->changeinOpenInterest) ? $d->PE->changeinOpenInterest : null);
            
            $phedStatusData->impliedVolatility =(isset($d->PE->impliedVolatility) ? $d->PE->impliedVolatility : null);
            $phedStatusData->lastPrice =(isset($d->PE->lastPrice) ? $d->PE->lastPrice : null);
            $phedStatusData->openInterest =(isset($d->PE->openInterest) ? $d->PE->openInterest : null);
            $phedStatusData->pChange =(isset($d->PE->pChange) ? $d->PE->pChange : null);
            $phedStatusData->pchangeinOpenInterest =(isset($d->PE->pchangeinOpenInterest) ? $d->PE->pchangeinOpenInterest : null);
            
            $phedStatusData->totalBuyQuantity =(isset($d->PE->totalBuyQuantity) ? $d->PE->totalBuyQuantity : null);
            $phedStatusData->totalSellQuantity =(isset($d->PE->totalSellQuantity) ? $d->PE->totalSellQuantity : null);
            $phedStatusData->totalTradedVolume =(isset($d->PE->totalTradedVolume) ? $d->PE->totalTradedVolume : null);
            $phedStatusData->underlying =(isset($d->PE->underlying) ? $d->PE->underlying : null);
            $phedStatusData->underlyingValue =(isset($d->PE->underlyingValue) ? $d->PE->underlyingValue : null);
            $phedStatusData->save();

            }


            if(isset($d->CE->strikePrice))
            {   
            $phedStatusData->strikePrice =(isset($d->CE->strikePrice) ? $d->CE->strikePrice : null);
            $phedStatusData->optionType ='CE';

            $phedStatusData->dataCreatedDate =$dataDateTime;
            $phedStatusData->dataCreatedTime =$expiryTime;

            $phedStatusData->dataCreatedDay =$craetedDay;

            $phedStatusData->dataCreatedMonth =$craetedMonth;

            $phedStatusData->dataCreatedYear =$craetedYear;

            if(isset($d->CE->expiryDate))
            {   
                $expiryDate = Carbon::createFromFormat('Y-m-d',date('Y-m-d',strtotime($d->CE->expiryDate)));        
            }
            else
            {
                $expiryDate =null;
            }
            $phedStatusData->expiryDate =$expiryDate;
            $phedStatusData->expiryTime =$expiryTime;
            $phedStatusData->identifier =(isset($d->CE->identifier) ? $d->CE->identifier : null);

            $phedStatusData->askPrice =(isset($d->CE->askPrice) ? $d->CE->askPrice : null);
            $phedStatusData->askQty =(isset($d->CE->askQty) ? $d->CE->askQty : null);
            $phedStatusData->bidprice =(isset($d->CE->bidprice) ? $d->CE->bidprice : null);
            $phedStatusData->bidQty =(isset($d->CE->bidQty) ? $d->CE->bidQty : null);
            $phedStatusData->change =(isset($d->CE->change) ? $d->CE->change : null);
            $phedStatusData->changeinOpenInterest =(isset($d->CE->changeinOpenInterest) ? $d->CE->changeinOpenInterest : null);
            
            $phedStatusData->impliedVolatility =(isset($d->CE->impliedVolatility) ? $d->CE->impliedVolatility : null);
            $phedStatusData->lastPrice =(isset($d->CE->lastPrice) ? $d->CE->lastPrice : null);
            $phedStatusData->openInterest =(isset($d->CE->openInterest) ? $d->CE->openInterest : null);
            $phedStatusData->pChange =(isset($d->CE->pChange) ? $d->CE->pChange : null);
            $phedStatusData->pchangeinOpenInterest =(isset($d->CE->pchangeinOpenInterest) ? $d->CE->pchangeinOpenInterest : null);
            
            $phedStatusData->totalBuyQuantity =(isset($d->CE->totalBuyQuantity) ? $d->CE->totalBuyQuantity : null);
            $phedStatusData->totalSellQuantity =(isset($d->CE->totalSellQuantity) ? $d->CE->totalSellQuantity : null);
            $phedStatusData->totalTradedVolume =(isset($d->CE->totalTradedVolume) ? $d->CE->totalTradedVolume : null);
            $phedStatusData->underlying =(isset($d->CE->underlying) ? $d->CE->underlying : null);
            $phedStatusData->underlyingValue =(isset($d->CE->underlyingValue) ? $d->CE->underlyingValue : null);
            $phedStatusData->save();
            }


            //dd($d->PE->askPrice);
        }

    }
}
