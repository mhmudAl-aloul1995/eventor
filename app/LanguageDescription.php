<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $language_id
 * @property integer $table_language_id
 * @property string $id_ref
 * @property string $remarks
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Language $language
 */
class LanguageDescription extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'language_descriptions';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['languagable_type', 'languagable_id','language_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo('App\Language','language_id','id');
    }
    public function languagable()
    {
        return $this->morphTo();
    }
}
