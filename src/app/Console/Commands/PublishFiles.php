<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PublishFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:publish-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish done';

    /**
     * Execute the console command.
     */
    public function publishFiles($files, $pathFrom)
    {
        foreach ($files as $fileFrom => $fileTo)
        {
            $fileFromOrigin = $fileFrom;
            $fileToOrigin   = $fileTo;

            $fileFrom   = base_path($pathFrom . '/' . $fileFrom);
            $fileToData = strpos($fileTo, '/') !== false ? explode('/', $fileTo) : [''];

            switch ($fileToData[0])
            {
                case 'js':
                case 'php':
                case 'sass':
                case 'views':
                    $fileTo = resource_path($fileTo);
                    break;
                default:
                    $fileTo = base_path($fileTo);
                    break;
            }

            $fileDirectoryInfo = pathinfo($fileTo);

            if(!File::exists($fileDirectoryInfo['dirname']))
            {
                File::makeDirectory($fileDirectoryInfo['dirname'], 755, true);
            }

            File::copy($fileFrom , $fileTo);

            print 'Copy ' . $fileFromOrigin . ' to ' . $fileToOrigin . PHP_EOL;
        }
    }
}
