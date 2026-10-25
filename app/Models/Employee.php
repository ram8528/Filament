<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\Activitylog\Models\Concerns\LogsActivity;

class Employee extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'department',
        'designation',
        'department_id',
        'designation_id',
        'salary',
        'joining_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'salary' => 'decimal:2',
            'joining_date' => 'date',
        ];
    }

    public function departmentRelation(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function designationRelation(): BelongsTo
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'email',
                'department_id',
                'designation_id',
                'salary',
                'status',
            ])
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }

    protected static function booted(): void
    {
        static::created(function (Employee $employee): void {
            if (blank($employee->employee_code)) {
                $employee->forceFill([
                    'employee_code' => 'EMP-' . str_pad(
                        (string) $employee->getKey(),
                        5,
                        '0',
                        STR_PAD_LEFT,
                    ),
                ])->saveQuietly();
            }
        });
    }
}
