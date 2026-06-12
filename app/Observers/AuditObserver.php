<?php

namespace App\Observers;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class AuditObserver
{
    public function created(Model $model): void
    {
        $this->log('created', $model);
    }

    public function updated(Model $model): void
    {
        $changes = $model->getChanges();
        $original = $model->getOriginal();

        $oldValues = [];
        $newValues = [];
        foreach ($changes as $key => $value) {
            if ($key !== 'updated_at') {
                $oldValues[$key] = array_key_exists($key, $original) ? $original[$key] : null;
                $newValues[$key] = $value;
            }
        }

        if (empty($newValues)) {
            return;
        }

        $this->log('updated', $model, $oldValues, $newValues);
    }

    public function deleted(Model $model): void
    {
        $this->log('deleted', $model, $model->toArray());
    }

    protected function log(string $action, Model $model, ?array $oldValues = null, ?array $newValues = null): void
    {
        try {
            AuditLog::create([
                'user_id' => auth()->id(),
                'action' => $action,
                'model_type' => get_class($model),
                'model_id' => $model->getKey(),
                'old_values' => $oldValues ? json_encode($oldValues) : null,
                'new_values' => $newValues ? json_encode($newValues) : null,
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
            ]);
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
