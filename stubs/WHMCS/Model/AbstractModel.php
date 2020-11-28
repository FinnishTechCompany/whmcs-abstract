<?php
/** @noinspection PhpInconsistentReturnPointsInspection */

namespace WHMCS\Model;

abstract class AbstractModel extends \Illuminate\Database\Eloquent\Model implements Contracts\ModelInterface
{
    public function clearColumnCache(): AbstractModel {}
    public function isAttributeSet($key): bool {}
    public function getRawAttribute($key = NULL, $default = NULL) {}
    public function fromBoolean($value): int {}
    public function fromString($value): string {}
    public function fromInt($value): int {}
    public function asBoolean($value): bool {}
    public function asArrayFromCharacterSeparatedValue(string $data = "", string $character = ","): array {}
    public function fromArrayToCharacterSeparatedValue(array $list = array(), string $character = ","): array {}
    public function fromSemanticVersion(\WHMCS\Version\SemanticVersion $version): string {}
    public function asSemanticVersion(string $version): \WHMCS\Version\SemanticVersion {}
    public static function convertBoolean($value): bool {}
    public static function convertBooleanColumn(string $column): void {}
    public static function convertUnixTimestampIntegerToTimestampColumn(string $column): void {}
    protected function isBooleanColumn($column): bool {}
    protected function isSemanticVersionColumn($column): bool {}
    protected function isCommaSeparatedColumn($column): bool {}
    protected function decryptValue(string $cipherText, string $key): string {}
    protected function encryptValue(string $text, string $key): string {}
    protected function aesEncryptValue($text, $key): string {}
    protected function aesDecryptValue($text, $key): string {}
    protected function decrypt($value): string {}
    protected function encrypt($value): string {}
    public function toArrayUsingColumnMapNames(): array {}
    public function validate(): bool {}
    public function setCustomValidationMessages(array $messages): AbstractModel {}
    public function errors(): array {}
    public function getCustomFieldValuesAttribute() {}
}
