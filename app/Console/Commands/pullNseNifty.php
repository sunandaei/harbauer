<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\OptionNifty;
use App\Models\OptionChainCurrent;
use App\Models\StrikePrice;
use App\Models\Expiry;
use App\Models\UnderlyingAsset;



class pullNseNifty extends Command
{
    protected $signature = 'pull:nseNifty {index}';
    protected $description = 'Pull NSE Nifty data and save it to OptionNifty table';

    public function handle()
    {
        date_default_timezone_set("Asia/Calcutta");
        $dataDateTime = Carbon::now();
        $index = strtoupper($this->argument('index'));

   
        if ($this->dataExists($dataDateTime,$index)) 
        {
            $this->info('Data for the current timestamp already exists.');
            return;
        }

        try {
            $curl = curl_init();
              curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://www.nseindia.com/api/option-chain-indices?symbol='.$index,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET'
            
            ));

            $response = curl_exec($curl);
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $response = json_decode($response);
            if ($statusCode == 200) 
            {
             $this->processOptionData($response,$dataDateTime,$index);
             $this->info('NSE '.$index.' data pulled and saved successfully!');
            } else {
                $this->error('Error: Unable to fetch data from the NSE API.');
            }
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            $this->error($e->getTraceAsString());
        }
    }

    protected function dataExists($dataDateTime,$index)
    {
        // Check if data for the current timestamp already exists in the database
        return OptionNifty::where('underlying', $index)
            ->where('dataCreatedDate', $dataDateTime)
            ->exists();
    }

    protected function processOptionData($res,$dataDateTime,$index)
    {   $i=1;

        $dataDateTime = Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i',strtotime($res->records->timestamp)));

        if ($this->dataExists($dataDateTime,$index)) 
        {
        $this->info('Data for '.$index.' the current timestamp already exists.');
        return;
        }

        $expiryTime = $dataDateTime->toTimeString();

        $craetedDay =Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i',strtotime($res->records->timestamp)))->day;
        $craetedMonth =Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i',strtotime($res->records->timestamp)))->month;

        $craetedYear =Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i',strtotime($res->records->timestamp)))->year;
        
        //if(exists($data->CE))dd($data->CE);
        echo $i;
      foreach($res->records->data as $d)
        {    

        echo "<br />";
        $i++;
        $phedStatusData = new OptionNifty;
        $phedStatusData->dataCreatedDate =$dataDateTime;
        $phedStatusData->dataCreatedTime =$expiryTime;

        $phedStatusData->dataCreatedDay =$craetedDay;

        $phedStatusData->dataCreatedMonth =$craetedMonth;

        $phedStatusData->dataCreatedYear =$craetedYear;
        

        $phedStatusData->strikePrice =(isset($d->strikePrice) ? $d->strikePrice : null);

        if(isset($d->expiryDate))
        {   
        $expiryDate = Carbon::createFromFormat('Y-m-d',date('Y-m-d',strtotime($d->expiryDate)));        
        }
        else
        {
        $expiryDate =null;
        }
        
        $phedStatusData->expiryDate =$expiryDate;

        $phedStatusData->expiryTime =$expiryTime;    

        //pe data collection

        $phedStatusData->identifierPe =(isset($d->PE->identifier) ? $d->PE->identifier : null);

        $phedStatusData->askPricePe =(isset($d->PE->askPrice) ? $d->PE->askPrice : null);
        
        $phedStatusData->askQtyPe =(isset($d->PE->askQty) ? $d->PE->askQty : null);
        
        $phedStatusData->bidpricePe =(isset($d->PE->bidprice) ? $d->PE->bidprice : null);
        
        $phedStatusData->bidQtyPe =(isset($d->PE->bidQty) ? $d->PE->bidQty : null);
        
        $phedStatusData->changePe =(isset($d->PE->change) ? $d->PE->change : null);
        
        $phedStatusData->changeinOpenInterestPe =(isset($d->PE->changeinOpenInterest) ? $d->PE->changeinOpenInterest : null);
                
        $phedStatusData->impliedVolatilityPe =(isset($d->PE->impliedVolatility) ? $d->PE->impliedVolatility : null);
        
        $phedStatusData->lastPricePe =(isset($d->PE->lastPrice) ? $d->PE->lastPrice : null);
        
        $phedStatusData->openInterestPe =(isset($d->PE->openInterest) ? $d->PE->openInterest : null);
        
        $phedStatusData->pChangePe =(isset($d->PE->pChange) ? $d->PE->pChange : null);
        
        $phedStatusData->pchangeinOpenInterestPe =(isset($d->PE->pchangeinOpenInterest) ? $d->PE->pchangeinOpenInterest : null);
                
        $phedStatusData->totalBuyQuantityPe =(isset($d->PE->totalBuyQuantity) ? $d->PE->totalBuyQuantity : null);
        
        $phedStatusData->totalSellQuantityPe =(isset($d->PE->totalSellQuantity) ? $d->PE->totalSellQuantity : null);
        
        $phedStatusData->totalTradedVolumePe =(isset($d->PE->totalTradedVolume) ? $d->PE->totalTradedVolume : null);
        $phedStatusData->underlyingPe =(isset($d->PE->underlying) ? $d->PE->underlying : null);
        
        $phedStatusData->underlyingValuePe =(isset($d->PE->underlyingValue) ? $d->PE->underlyingValue : null);
               
        //call data collection
        $phedStatusData->identifierCe =(isset($d->CE->identifier) ? $d->CE->identifier : null);

        $phedStatusData->askPriceCe =(isset($d->CE->askPrice) ? $d->CE->askPrice : null);
        
        $phedStatusData->askQtyCe =(isset($d->CE->askQty) ? $d->CE->askQty : null);
        
        $phedStatusData->bidpriceCe =(isset($d->CE->bidprice) ? $d->CE->bidprice : null);
        
        $phedStatusData->bidQtyCe =(isset($d->CE->bidQty) ? $d->CE->bidQty : null);
        
        $phedStatusData->changeCe =(isset($d->CE->change) ? $d->CE->change : null);
        
        $phedStatusData->changeinOpenInterestCe =(isset($d->CE->changeinOpenInterest) ? $d->CE->changeinOpenInterest : null);
                
        $phedStatusData->impliedVolatilityCe =(isset($d->CE->impliedVolatility) ? $d->CE->impliedVolatility : null);
        
        $phedStatusData->lastPriceCe =(isset($d->CE->lastPrice) ? $d->CE->lastPrice : null);
        
        $phedStatusData->openInterestCe =(isset($d->CE->openInterest) ? $d->CE->openInterest : null);
        
        $phedStatusData->pChangeCe =(isset($d->CE->pChange) ? $d->CE->pChange : null);
        
        $phedStatusData->pchangeinOpenInterestCe =(isset($d->CE->pchangeinOpenInterest) ? $d->CE->pchangeinOpenInterest : null);
                
        $phedStatusData->totalBuyQuantityCe =(isset($d->CE->totalBuyQuantity) ? $d->CE->totalBuyQuantity : null);
        
        $phedStatusData->totalSellQuantityCe =(isset($d->CE->totalSellQuantity) ? $d->CE->totalSellQuantity : null);
                
        $phedStatusData->totalTradedVolumeCe =(isset($d->CE->totalTradedVolume) ? $d->CE->totalTradedVolume : null);
                
        $phedStatusData->underlyingCe =(isset($d->CE->underlying) ? $d->CE->underlying : null);
                
        $phedStatusData->underlyingValueCe =(isset($d->CE->underlyingValue) ? $d->CE->underlyingValue : null);
        $phedStatusData->save();
           
        } //end of foreach 
      
        StrikePrice::where('underlying', $index)->delete();

        //dd($res->records->strikePrices);
        foreach($res->records->strikePrices as $c) 
        {    
          $StrikePrice = new StrikePrice;
          
          $StrikePrice->underlying =(isset($index) ? $index : null);

           $StrikePrice->underlyingValue =(isset($res->records->underlyingValue) ? $res->records->underlyingValue : null);

         
          $StrikePrice->dataCreatedDate =$dataDateTime;

          $StrikePrice->dataCreatedDay =$craetedDay;

          $StrikePrice->dataCreatedMonth =$craetedMonth;

          $StrikePrice->dataCreatedYear =$craetedYear;

           $StrikePrice->strikePrice =$c;

           $StrikePrice->save();
                 
        }

        Expiry::where('underlying', $index)->delete();

        //dd($res->records->strikePrices);
        foreach($res->records->expiryDates as $e) 
        {    
          $expiry = new Expiry;
          $eDate = Carbon::createFromFormat('Y-m-d',date('Y-m-d',strtotime($e)));
          $expiry->expiryDate =$eDate;
          $expiry->underlying =(isset($index) ? $index : null);
          $expiry->save();
        }

        UnderlyingAsset::where('underlying', $index)->delete();

        $underlyingAsset = new UnderlyingAsset;

        $timeStamp = Carbon::createFromFormat('d-M-Y H:i:s', $res->records->timestamp);
 
       $underlyingAsset->underlying =$index;
        $underlyingAsset->underlyingValue =$res->records->underlyingValue;
        $underlyingAsset->dataCreatedDate =$timeStamp;
        $underlyingAsset->save();

         OptionChainCurrent::where('underlying', $index)->delete();


        echo $i;
    foreach($res->filtered->data as $d) 
    {    

        echo "<br />";
        $i++;
        $optionStatusData = new OptionChainCurrent;
        
        $optionStatusData->dataCreatedDate =$dataDateTime;
        
        $optionStatusData->dataCreatedTime =$expiryTime;

        $optionStatusData->dataCreatedDay =$craetedDay;

        $optionStatusData->dataCreatedMonth =$craetedMonth;

        $optionStatusData->dataCreatedYear =$craetedYear;
            

        $optionStatusData->strikePrice =(isset($d->strikePrice) ? $d->strikePrice : null);

        if(isset($d->expiryDate))
        {   
        $expiryDate = Carbon::createFromFormat('Y-m-d',date('Y-m-d',strtotime($d->expiryDate)));        
        }
        else
        {
        $expiryDate =null;
        }
            
        $optionStatusData->expiryDate =$expiryDate;

        $optionStatusData->expiryTime =$expiryTime;    

        //pe data collection

        $optionStatusData->identifierPe =(isset($d->PE->identifier) ? $d->PE->identifier : null);

        $optionStatusData->askPricePe =(isset($d->PE->askPrice) ? $d->PE->askPrice : null);
            
        $optionStatusData->askQtyPe =(isset($d->PE->askQty) ? $d->PE->askQty : null);
            
        $optionStatusData->bidpricePe =(isset($d->PE->bidprice) ? $d->PE->bidprice : null);
            
        $optionStatusData->bidQtyPe =(isset($d->PE->bidQty) ? $d->PE->bidQty : null);
            
        $optionStatusData->changePe =(isset($d->PE->change) ? $d->PE->change : null);
            
        $optionStatusData->changeinOpenInterestPe =(isset($d->PE->changeinOpenInterest) ? $d->PE->changeinOpenInterest : null);
                    
        $optionStatusData->impliedVolatilityPe =(isset($d->PE->impliedVolatility) ? $d->PE->impliedVolatility : null);
            
        $optionStatusData->lastPricePe =(isset($d->PE->lastPrice) ? $d->PE->lastPrice : null);
            
        $optionStatusData->openInterestPe =(isset($d->PE->openInterest) ? $d->PE->openInterest : null);
            
        $optionStatusData->pChangePe =(isset($d->PE->pChange) ? $d->PE->pChange : null);
            
        $optionStatusData->pchangeinOpenInterestPe =(isset($d->PE->pchangeinOpenInterest) ? $d->PE->pchangeinOpenInterest : null);
                    
        $optionStatusData->totalBuyQuantityPe =(isset($d->PE->totalBuyQuantity) ? $d->PE->totalBuyQuantity : null);
            
        $optionStatusData->totalSellQuantityPe =(isset($d->PE->totalSellQuantity) ? $d->PE->totalSellQuantity : null);
            
        $optionStatusData->totalTradedVolumePe =(isset($d->PE->totalTradedVolume) ? $d->PE->totalTradedVolume : null);
        
        $optionStatusData->underlyingPe =(isset($d->PE->underlying) ? $d->PE->underlying : null);
            
        $optionStatusData->underlyingValuePe =(isset($d->PE->underlyingValue) ? $d->PE->underlyingValue : null);
                   
        //call data collection
        $optionStatusData->identifierCe =(isset($d->CE->identifier) ? $d->CE->identifier : null);

        $optionStatusData->askPriceCe =(isset($d->CE->askPrice) ? $d->CE->askPrice : null);
            
        $optionStatusData->askQtyCe =(isset($d->CE->askQty) ? $d->CE->askQty : null);
            
        $optionStatusData->bidpriceCe =(isset($d->CE->bidprice) ? $d->CE->bidprice : null);
            
        $optionStatusData->bidQtyCe =(isset($d->CE->bidQty) ? $d->CE->bidQty : null);
            
        $optionStatusData->changeCe =(isset($d->CE->change) ? $d->CE->change : null);
            
        $optionStatusData->changeinOpenInterestCe =(isset($d->CE->changeinOpenInterest) ? $d->CE->changeinOpenInterest : null);
                    
        $optionStatusData->impliedVolatilityCe =(isset($d->CE->impliedVolatility) ? $d->CE->impliedVolatility : null);
            
        $optionStatusData->lastPriceCe =(isset($d->CE->lastPrice) ? $d->CE->lastPrice : null);
            
        $optionStatusData->openInterestCe =(isset($d->CE->openInterest) ? $d->CE->openInterest : null);
            
        $optionStatusData->pChangeCe =(isset($d->CE->pChange) ? $d->CE->pChange : null);
            
        $optionStatusData->pchangeinOpenInterestCe =(isset($d->CE->pchangeinOpenInterest) ? $d->CE->pchangeinOpenInterest : null);
                    
        $optionStatusData->totalBuyQuantityCe =(isset($d->CE->totalBuyQuantity) ? $d->CE->totalBuyQuantity : null);
            
        $optionStatusData->totalSellQuantityCe =(isset($d->CE->totalSellQuantity) ? $d->CE->totalSellQuantity : null);
                    
        $optionStatusData->totalTradedVolumeCe =(isset($d->CE->totalTradedVolume) ? $d->CE->totalTradedVolume : null);
                    
        $optionStatusData->underlyingCe =(isset($d->CE->underlying) ? $d->CE->underlying : null);
                    
        $optionStatusData->underlyingValueCe =(isset($d->CE->underlyingValue) ? $d->CE->underlyingValue : null);
        $optionStatusData->save();
            
    } //end of foreach 
  }
}
