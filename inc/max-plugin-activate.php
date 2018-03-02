<?php
/**
  * @package MaxPlugin
  */

class MaxPluginActivate
{
  public static function activate() {
    flush_rewrite_rules();
  }
}  