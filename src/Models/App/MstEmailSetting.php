<?php

namespace Adw\Models\App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class MstEmailSetting extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use \Adw\Traits\TraitUuid;

    protected $table = 'mst_email_setting';

    protected $primaryKey = 'id';

    protected $guarded = [];
}
