<?php /** @noinspection PhpInconsistentReturnPointsInspection */

namespace WHMCS\View\Menu;

class Item extends \Knp\Menu\MenuItem
{
    public function setBadge($badge): \Knp\Menu\ItemInterface {}
    public function getBadge(): string {}
    public function hasBadge(): bool {}
    public function setOrder(int $order): \Knp\Menu\ItemInterface {}
    public function getOrder(): int {}
    public function setClass($cssClassString): \Knp\Menu\ItemInterface {}
    public function getClass(): string {}
    public function disable(): \Knp\Menu\ItemInterface {}
    public function enable(): \Knp\Menu\ItemInterface {}
    public function isDisabled(): bool {}
    protected function isFontAwesomeIcon($icon): bool {}
    protected function isGlyphicon($icon): bool {}
    public function setIcon(string $icon): \Knp\Menu\ItemInterface {}
    public function getIcon(): string {}
    public function hasIcon(): bool {}
    public function hasFontAwesomeIcon(): bool {}
    public function hasGlyphicon(): bool {}
    public function getBodyHtml(): string{}
    public function setBodyHtml(string $html): \Knp\Menu\ItemInterface {}
    public function hasBodyHtml(): bool {}
    public function getFooterHtml(): string {}
    public function setFooterHtml(string $html): \Knp\Menu\ItemInterface {}
    public function hasFooterHtml(): bool {}
    public function getHeadingHtml(): string {}
    public function setHeadingHtml(string $html): \Knp\Menu\ItemInterface {}
    public function hasHeadingHtml(): bool {}
    public function getId(): string {}
    public static function sort(Item $menu, $sortChildren = true): \Knp\Menu\ItemInterface {}
    protected function swapOrder(string $swapOrder): \Knp\Menu\ItemInterface {}
    public function moveUp(): \Knp\Menu\ItemInterface {}
    public function moveDown(): \Knp\Menu\ItemInterface {}
    public function moveToFront(): \Knp\Menu\ItemInterface {}
    public function moveToBack(): \Knp\Menu\ItemInterface {}
}
