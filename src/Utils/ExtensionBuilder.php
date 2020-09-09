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

namespace IronLions\WHMCS\Utils;

use IronLions\WHMCS\Infra\Kernel;
use IronLions\WHMCS\Utils\Extension\AllowExtensionFunctionInterface;
use IronLions\WHMCS\Utils\Extension\Entrypoint\ExtensionEntrypointInterface;
use IronLions\WHMCS\Utils\Extension\ProvisionBuilder;

final class ExtensionBuilder implements AllowExtensionFunctionInterface
{
    public const API_VERSION_1_1 = '1.1';
    public const API_VERSION_DEFAULT = self::API_VERSION_1_1;
    public const KERNEL = '$kernel = new IronLions\WHMCS\Infra\Kernel();';

    private string $name;
    private string $path;
    private string $code = "\n";

    public function __construct(string $path)
    {
        $this->name = \array_slice(explode(\DIRECTORY_SEPARATOR, $path), -1)[0];
        $this->path = $path;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function register(): void
    {
        eval($this->code);
        $this->code = '';
        $this->name = '';
        $this->code = '';
    }

    public function withHooks(): HookBuilder
    {
        return new HookBuilder($this);
    }

    public function withControllers(string $dir): self
    {
        Kernel::__rt()->import($dir, 'annotation');

        return $this;
    }

    public function withProvision(): ProvisionBuilder
    {
        return new ProvisionBuilder($this);
    }

    public function __func(
        string $name,
        string $code,
        string $returnType = 'void',
        string $params = ''
    ): self {
        $this->throwIfNotAllowed();
        $this->code .= "function {$this->name}_$name($params): $returnType {\n $code \n} \n";

        return $this;
    }

    /**
     * @param ExtensionEntrypointInterface[] $entrypoint
     *
     * @internal
     */
    public function __entryFunc(
        string $name,
        array $entrypoint,
        string $returnType,
        string $params,
        ?string $paramsClass,
        string $logCategory
    ): self {
        $this->throwIfNotAllowed();
        $code = ' '.self::KERNEL.PHP_EOL;
        $code .= null === $paramsClass ? '' : "  \$params = new $paramsClass(\$params);";
        foreach ($entrypoint as $item) {
            $code .= PHP_EOL.'  '.(string) $item;
        }
        $code .= "\n  return ".('string' === $returnType ? "'success';" : "['success'=>true,'error'=>''];");
        $code = sprintf($this->getDefaultTryCatchCode($logCategory, 'string' === $returnType), $code);
        $this->__func($name, $code, $returnType, $params);

        return $this;
    }

    /**
     * @internal
     */
    public function getDefaultTryCatchCode(string $type, bool $simple): string
    {
        return "try {\n %s\n } catch (\Throwable \$e) {\n"
            ."  logModuleCall($type, __FUNCTION__, \$params, \$e->getMessage(), \$e->getTraceAsString());\n"
            .($simple
                ? "  return \$e->getMessage();\n"
                : "  return ['success'=>false,'error'=>\$e->getMessage()];\n")
            .' }';
    }

    /**
     * @internal
     */
    public function __addCode(string $code): self
    {
        $this->throwIfNotAllowed();
        $this->code .= $code;

        return $this;
    }

    public function __debug(): string
    {
        return $this->code;
    }

    private function throwIfNotAllowed(): void
    {
        if (!\in_array(
            AllowExtensionFunctionInterface::class,
            class_implements(
                debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3)[2]['class']
            ),
            true
        )) {
            throw new \LogicException('You cannot use this function directly. Please use building functions!');
        }
    }
}
