<?php /** @noinspection ALL */
namespace WHMCS\Service;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;

abstract class Service extends \WHMCS\Model\AbstractModel
{
    protected $table = "tblhosting";
    protected $columnMap = ["clientId" => "userid", "productId" => "packageid", "serverId" => "server", "registrationDate" => "regdate", "paymentGateway" => "paymentmethod", "status" => "domainstatus", "promotionId" => "promoid", "overrideAutoSuspend" => "overideautosuspend", "overrideSuspendUntilDate" => "overidesuspenduntil", "bandwidthUsage" => "bwusage", "bandwidthLimit" => "bwlimit", "lastUpdateDate" => "lastupdate", "firstPaymentAmount" => "firstpaymentamount", "recurringAmount" => "amount", "recurringFee" => "amount"];
    protected $dates = ["registrationDate", "overrideSuspendUntilDate", "lastUpdateDate"];
    protected $booleans = ["overideautosuspend"];
    protected $appends = ["serviceProperties"];
    protected $hidden = ["password"];
    const STATUS_PENDING = "Pending";
    const STATUS_ACTIVE = "Active";
    const STATUS_SUSPENDED = "Suspended";
    public function scopeUserId(\Illuminate\Database\Eloquent\Builder $query, string $userId): \Illuminate\Database\Eloquent\Builder {}
    public function scopeActive(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder {}
    public function scopeMarketConnect($query): Builder {}
    public function scopeIsConsideredActive(\Illuminate\Database\Eloquent\Builder $query): Builder {}
    public function scopeIsNotRecurring(\Illuminate\Database\Eloquent\Builder $query): Builder {}
    public function client(): BelongsTo {}
    public function product(): BelongsTo {}
    public function addons(): HasMany {}
    public function order(): BelongsTo {}
    public function cancellationRequests(): HasMany {}
    public function ssl(): HasMany {}
    public function hasAvailableUpgrades(): bool {}
    public function failedActions(): HasMany {}
    public function customFieldValues(): HasMany {}
    protected function getCustomFieldType(): string
    {
        return "product";
    }
    public function getServicePropertiesAttribute(): WHMCS\Service\Properties {}
    public function canBeUpgraded(): bool {}
    public function isService(): bool {}
    public function isAddon(): bool {}
    public function serverModel(): HasOne {}
}

?>
