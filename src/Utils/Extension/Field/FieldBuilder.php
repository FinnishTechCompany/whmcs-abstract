<?php

/**
 *
 * WHMCS Abstract 2020 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * Please see LICENSE file for more specific licensing terms.
 * @copyright 2017-2020 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2020 (c) Fiteco (https://fiteco.fi)
 *
 */

namespace IronLions\WHMCS\Utils\Extension\Field;

abstract class FieldBuilder
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASS = 'password';
    public const TYPE_BOX = 'yesno';
    public const TYPE_RADIO = 'radio';
    public const TYPE_DROP = 'dropdown';
    public const TYPE_AREA = 'textarea';

    public const VALUE_COMMAND = 'command';
    public const VALUE_STRING = 'string';
    public const VALUE_BOOL = 'bool';
    public const VALUE_INT = 'int';
    public const VALUE_ARRAY = 'array';
    public const VALUE_LOADER = 'loader';

    protected object $builder;
    protected string $name;
    protected array $fields = [];
    protected array $required = ['friendlyName'];

    public function __construct(object $builder, string $name, string $type)
    {
        $this->builder = $builder;
        $this->name = $name;
        $this->fields['Type'] = $this->value(self::VALUE_STRING, $type);

        switch ($type) {
            case self::TYPE_TEXT:
            case self::TYPE_PASS:
                $this->required[] = 'length';

                break;
            case self::TYPE_DROP:
            case self::TYPE_RADIO:
                $this->required[] = 'options';

                break;
            case self::TYPE_AREA:
                $this->required[] = 'size';
        }
    }

    /**
     * Please implement and specify exactly type you want use.
     */
    abstract public function next();

    /**
     * Applies to all fields.
     */
    public function friendlyName(string $name): self
    {
        unset($this->required[__FUNCTION__]);
        $this->fields['FriendlyName'] = $this->value(self::VALUE_STRING, $name);

        return $this;
    }

    /**
     * Applies only for Text and Pass.
     */
    public function length(int $length): self
    {
        unset($this->required[__FUNCTION__]);
        $this->fields['Size'] = $this->value(self::VALUE_STRING, (string) $length);

        return $this;
    }

    /**
     * Applies to all fields.
     */
    public function description(string $text): self
    {
        unset($this->required[__FUNCTION__]);
        $this->fields['Description'] = $this->value(self::VALUE_STRING, $text);

        return $this;
    }

    /**
     * Applies to all fields.
     */
    public function default(string $value): self
    {
        unset($this->required[__FUNCTION__]);
        $this->fields['Default'] = $this->value(self::VALUE_STRING, $value);

        return $this;
    }

    /**
     * Array where key is id and value display value.
     * Optionally array with only display values.
     */
    public function options(array $values): self
    {
        unset($this->required[__FUNCTION__]);
        if (\count(array_filter(array_keys($values), 'is_string')) > 0) {
            $this->fields['Options'] = $this->value(self::VALUE_ARRAY, $values);
        } else {
            $this->fields['Options'] = $this->value(self::VALUE_STRING, implode(',', $values));
        }

        return $this;
    }

    public function optionsViaCommand(string $command): self
    {
        unset($this->required[__FUNCTION__]);
        $this->fields['Options'] = $this->value(self::VALUE_COMMAND, $command);

        return $this;
    }

    public function simple(): self
    {
        $this->fields['SimpleMode'] = $this->value(self::VALUE_BOOL, true);

        return $this;
    }

    public function loader(string $command): self
    {
        if (!isset($this->fields['SimpleMode'])) {
            throw new \LogicException('You cannot use loader without using `simple`.');
        }

        $this->fields['Loader'] = $this->value(self::VALUE_LOADER, $command);

        return $this;
    }

    protected function value(string $type, $value): array
    {
        return [
            'type'  => $type,
            'value' => $value,
        ];
    }
}
