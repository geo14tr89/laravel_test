<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @property int $user_id
 * @property string $source
 * @property string $method
 * @property int $count
 */

class Statistic extends Model
{
    use HasFactory;

    public const SOURCE_ORDER_INDEX = '/order/index';
    public const SOURCE_ORDER_SEND = '/order/send';
    public const SOURCE_DOCUMENT_DOWNLOAD = '/document/download';
    public const SOURCE_DOCUMENT_INDEX = '/document/index';
    public const SOURCE_USER_LOGIN = '/user/login';
    public const SOURCE_USER_LOGOUT = '/user/logout';
    public const SOURCE_USER_REGISTER = '/user/register';

    protected $primaryKey = 'id';

    public static function attributesForFilter(): array
    {
        return [
            'user_id',
            'source',
            'count',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
