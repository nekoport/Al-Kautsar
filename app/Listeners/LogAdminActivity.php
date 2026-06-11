<?php

namespace App\Listeners;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class LogAdminActivity
{
    public function handle(string $event, Model $model): void
    {
        $user = auth()->user();
        $modelName = class_basename($model);
        $action = match (true) {
            str_contains($event, 'created') => 'create',
            str_contains($event, 'updated') => 'update',
            str_contains($event, 'deleted') => 'delete',
            str_contains($event, 'restored') => 'restore',
            default => 'unknown',
        };

        Log::channel('admin')->info("{$user?->name} {$action} {$modelName}#{$model->getKey()}", [
            'user_id' => $user?->id,
            'user_email' => $user?->email,
            'model' => $modelName,
            'model_id' => $model->getKey(),
            'action' => $action,
            'ip' => request()?->ip(),
        ]);
    }
}
