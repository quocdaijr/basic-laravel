<?php

namespace Modules\Core\Traits;

trait RegisterDataTrait
{
    public function registerMultiConfig($conf_file_names): self
    {
        if (!is_array($conf_file_names)) {
            $conf_file_names = [$conf_file_names];
        }
        foreach ($conf_file_names as $conf_file_name) {
            $this->publishes([
                module_path($this->moduleName, 'Config/' . $conf_file_name . '.php') => config_path($this->moduleNameLower . '/' . $conf_file_name . '.php'),
            ], 'config');
            $this->mergeConfigFrom(
                module_path($this->moduleName, 'Config/' . $conf_file_name . '.php'), $this->moduleNameLower . '.' . $conf_file_name
            );
        }
        return $this;
    }

    public function registerMultiRootConfig($conf_file_names): self
    {
        if (!is_array($conf_file_names)) {
            $conf_file_names = [$conf_file_names];
        }
        foreach ($conf_file_names as $conf_file_name) {
            $this->publishes([
                module_path($this->moduleName, 'Config/' . $conf_file_name . '.php') => config_path($conf_file_name . '.php'),
            ], 'config');
            $this->mergeConfigFrom(
                module_path($this->moduleName, 'Config/' . $conf_file_name . '.php'), $conf_file_name
            );
        }
        return $this;
    }
}
