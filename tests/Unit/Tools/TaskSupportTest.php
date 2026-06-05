<?php

use Laravel\Mcp\Enums\TaskSupport;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\TaskSupport as TaskSupportAttribute;
use Laravel\Mcp\Server\Tool;

it('omits execution key when no TaskSupport attribute is declared', function (): void {
    $tool = new class extends Tool {
        public function handle(Request $request): Response
        {
            return Response::text('test');
        }
    };

    expect($tool->toArray())->not->toHaveKey('execution');
});

it('includes execution key with taskSupport when attribute is declared as Optional', function (): void {
    $tool = new #[TaskSupportAttribute(TaskSupport::Optional)] class extends Tool {
        public function handle(Request $request): Response
        {
            return Response::text('test');
        }
    };

    expect($tool->toArray()['execution'])->toBe(['taskSupport' => 'optional']);
});

it('includes execution key with taskSupport when attribute is declared as Required', function (): void {
    $tool = new #[TaskSupportAttribute(TaskSupport::Required)] class extends Tool {
        public function handle(Request $request): Response
        {
            return Response::text('test');
        }
    };

    expect($tool->toArray()['execution'])->toBe(['taskSupport' => 'required']);
});

it('includes execution key with taskSupport when attribute is declared as Forbidden', function (): void {
    $tool = new #[TaskSupportAttribute(TaskSupport::Forbidden)] class extends Tool {
        public function handle(Request $request): Response
        {
            return Response::text('test');
        }
    };

    expect($tool->toArray()['execution'])->toBe(['taskSupport' => 'forbidden']);
});

it('uses Forbidden as the default taskSupport value when no value is provided', function (): void {
    $tool = new #[TaskSupportAttribute] class extends Tool {
        public function handle(Request $request): Response
        {
            return Response::text('test');
        }
    };

    expect($tool->toArray()['execution'])->toBe(['taskSupport' => 'forbidden']);
});
