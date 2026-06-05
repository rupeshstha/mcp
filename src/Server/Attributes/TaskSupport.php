<?php

declare(strict_types=1);

namespace Laravel\Mcp\Server\Attributes;

use Attribute;
use Laravel\Mcp\Enums\TaskSupport as TaskSupportEnum;

#[Attribute(Attribute::TARGET_CLASS)]
  class TaskSupport
  {
        public function __construct(
                  public TaskSupportEnum $value = TaskSupportEnum::Forbidden,
              ) {
                  //
        }
  }
