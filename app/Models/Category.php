<?php

namespace App\Models;

use App\Models\Notice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
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
    protected $table = 'categories';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'name',
    ];

    /** 
     * @return  \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notices(): HasMany
    {
        return $this->hasMany(Notice::class);
    }
}
