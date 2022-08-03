<?php

namespace Adw\Models\App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class MstTemplateEmailSetting extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'mst_template_email_setting';

    protected $primaryKey = 'id';

    protected $guarded = [];
}
