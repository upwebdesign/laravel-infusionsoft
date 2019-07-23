<?php

namespace Upwebdesign\Infusionsoft\Custom\Api\Rest;


class OrderService extends \Infusionsoft\Api\Rest\OrderService
{

  public function modifyPaymentPlan($payPlanDetails)
  {
    $response = $this->client->restfulRequest('put', $this->getFullUrl($this->id . '/paymentPlan'), $payPlanDetails);

    return $response;
  }
}
