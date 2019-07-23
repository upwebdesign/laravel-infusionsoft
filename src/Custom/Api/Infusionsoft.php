<?php

namespace Upwebdesign\Infusionsoft\Custom;


use Infusionsoft\Infusionsoft as Inf;


class Infusionsoft extends Inf
{

  /**
   * Returns the requested class name, optionally using a cached array so no
   * object is instantiated more than once during a request.
   *
   * @param string $class
   *
   * @return mixed
   */
  public function getRestApi($class)
  {
    if ($class === 'OrderService') {
      $class = '\Upwebdesign\Infusionsoft\Custom\Api\Rest\\' . $class;
    } else {
      $class = '\Infusionsoft\Api\Rest\\' . $class;
    }

    return new $class($this);
  }
}