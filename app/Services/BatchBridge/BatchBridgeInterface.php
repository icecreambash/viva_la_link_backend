<?php

declare(strict_types=1);

namespace App\Services\BatchBridge;

interface BatchBridgeInterface
{
    public function batch(): void;
}
