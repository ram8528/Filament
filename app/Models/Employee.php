<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'department',
        'designation',
        'salary',
        'joining_date',
        'status',
        'designation_id',
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
}
