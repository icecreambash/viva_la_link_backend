<?php

namespace App\Services\BatchBridge;

use App\Imports\AirTicketsImport;
use App\Imports\PipelineTicketsImport;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;



abstract class BatchBridgeAbstract implements BatchBridgeInterface
{

    protected string $basePath;

    protected Collection $filesCollection;


    public function __construct(
        string $customBasePath = null,
    )
    {
        if(is_null($customBasePath))
        {
            $this->basePath = base_path() . '\batches';
        } else {
            $this->basePath = $customBasePath;
        }

        $this->filesCollection = collect(File::allFiles($this->basePath));
    }

    /**
     * @throws \Throwable
     */
    public function batch(): void
    {
        $firstItem = $this->filesCollection->first();

        throw_if(!$firstItem instanceof \SplFileInfo,new \Exception('Collection file not SplFileInfo'));

        $importCollection = Excel::import(new PipelineTicketsImport(),$firstItem);
    }
}
