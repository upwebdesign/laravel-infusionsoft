<?php

namespace Upwebdesign\Infusionsoft\Api\Rest;


class OrderService extends \Infusionsoft\Api\Rest\OrderService
{

  public function modifyPaymentPlan($payPlanDetails)
  {
    $response = $this->client->restfulRequest('put', $this->getFullUrl($this->id . '/paymentPlan'), $payPlanDetails);

    return $response;
  }


  public function retrieveOrder()
  {
    $response = $this->client->restfulRequest('get', $this->getFullUrl($this->id));

    return $response;
  }
}
