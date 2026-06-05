<?php

declare(strict_types=1);

namespace Laravel\Mcp\Enums;

enum TaskSupport: string
{
    case Forbidden = 'forbidden';
    case Optional = 'optional';
    case Required = 'required';
}
