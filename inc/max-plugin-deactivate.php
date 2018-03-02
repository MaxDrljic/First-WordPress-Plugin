<?php
/**
  * @package MaxPlugin
  */

class MaxPluginDeactivate
{
  public static function deactivate() {
    flush_rewrite_rules();
  }
}  