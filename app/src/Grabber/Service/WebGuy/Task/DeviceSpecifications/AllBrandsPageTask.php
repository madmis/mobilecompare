<?php

namespace App\Grabber\Service\WebGuy\Task\DeviceSpecifications;

use App\Grabber\Service\WebGuy\TaskInterface;
use App\Grabber\Service\WebGuy\WebGuyInterface;

/**
 * Class AllBrandsPageTask
 * @package App\Grabber\Service\WebGuy\Task\DeviceSpecifications
 */
class AllBrandsPageTask implements TaskInterface
{
    private string $targetUri = 'https://www.devicespecifications.com/en/brand-more';

    public function run(WebGuyInterface $webGuy) : void
    {
//        $webGuy->
    }
}
