<?php

namespace App\Imports;

use App\Models\Ticket;
use App\Traits\Tools\AirImport\StopTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithTitle;


class AirTicketsImport implements
    ToCollection,
    WithBatchInserts,
    WithChunkReading,
    WithHeadingRow
{

    use StopTrait {
        StopTrait::__construct as private __stopConstruct;
    }

    private string $title;

    private object $credentials;
    public function __construct(
        string $titleName,
        object $credentials,
    )
    {
        $this->__stopConstruct();

        $this->title = $titleName;

        $this->credentials = $credentials;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $collect)
        {
            if($collect instanceof Collection && array_key_exists('stop',$collect->toArray()) && is_string($collect['stop']))
            {
                $val = trim(preg_replace('/\s\s+/', ' ', $collect['stop']));
            }else {
                $val = 0;
            }

            $fields = [
                'airline_id' => $this->credentials->airlines->where('slug',Str::lower(str_replace(' ', '',$collect->get('airline'))))->first()?->id,
                'code' => $collect->get('num_code'),
                'flight_time' => Carbon::parse($collect->get('time_take')),
                'start_time' => Carbon::parse($collect->get('date')),
                'start_city_id' => $this->credentials->cities->where('title',$collect->get('from'))->first()?->id,
                'end_city_id' => $this->credentials->cities->where('title',$collect->get('to'))->first()?->id,
                'count_step' => $this->getRealStop($val),
                'country_id' => $this->credentials->countries->where('title',$collect->get('ch_code'))->first()?->id,
                'category_id' => $this->credentials->categories->where('slug',$this->title)->first()?->id,
                'start_fly' => Carbon::parse($collect->get('dep_time')),
                'end_fly' => Carbon::parse($collect->get('arr_time')),
                'price' => floatval(str_replace(',','',$collect->get('price'))),
            ];


            Ticket::create($fields);
        }
    }

    public function chunkSize(): int {return 100;}

    public function batchSize(): int {return 100;}

    public function headingRow(): int{return 1;}

}
