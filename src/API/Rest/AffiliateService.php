<?php

namespace Upwebdesign\Infusionsoft\Api\Rest;

use Infusionsoft\Infusionsoft;
use Infusionsoft\Api\Rest\RestModel;
use Infusionsoft\Api\Rest\Traits\CannotSave;
use Infusionsoft\Api\Rest\Traits\CannotSync;
use Infusionsoft\Api\Rest\Traits\CannotDelete;

class AffiliateService extends RestModel
{
    use CannotSync;
    use CannotSave;
    use CannotDelete;

    public $full_url = 'https://api.infusionsoft.com/crm/rest/v1/affiliates';

    public $return_key = 'affiliates';

    public function __construct(Infusionsoft $client)
    {
        parent::__construct($client);
    }

    /**
     * Retrieves a list of all affiliate clawbacks
     *
     * @param array $params
     * @return array
     */
    public function clawbacks($params = [])
    {
        return $this->client->restfulRequest('get', $this->getFullUrl($this->id . '/clawbacks'), $params);
    }

    /**
     * Retrieves a list of all affiliate payments
     *
     * @param array $params
     * @return array
     */
    public function payments($params = [])
    {
        return $this->client->restfulRequest('get', $this->getFullUrl($this->id . '/payments'), $params);
    }

    /**
     * Retrieve a list of Commissions based on Affiliate or Date Range
     *
     * @param array $params
     * @return array
     */
    public function commissions($params = [])
    {
        return $this->client->restfulRequest('get', $this->getFullUrl('/commissions'), $params);
    }

    /**
     * Retrieve a list of Commission Programs
     *
     * @param array $params
     * @return array
     */
    public function programs($params = [])
    {
        return $this->client->restfulRequest('get', $this->getFullUrl('/programs'), $params);
    }

    /**
     * Retrieves a list of all affiliate redirects
     *
     * @param array $params
     * @return array
     */
    public function redirectLinks($params = [])
    {
        return $this->client->restfulRequest('get', $this->getFullUrl('/redirectlinks'), $params);
    }

    /**
     * Retrieve a list of affiliate summaries
     *
     * @param array $params
     * @return array
     */
    public function summaries($params = [])
    {
        return $this->client->restfulRequest('get', $this->getFullUrl('/summaries'), $params);
    }
}
