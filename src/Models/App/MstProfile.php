<?php

namespace Adw\Models\App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class MstProfile extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use \Adw\Traits\TraitUuid;

    protected $table = 'mst_profile';

    protected $primaryKey = 'mpr_id';

    protected $guarded = [];
}