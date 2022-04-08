<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Category;

class Notice extends Model
{
    use HasFactory;

    /**
     * Name of primary key.
     * @var string
     */        
    protected $primaryKey = 'id';

    /**
    * @var string
    */
    protected $table = 'notices';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'description',
        'category_id'
    ];

    /** 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
