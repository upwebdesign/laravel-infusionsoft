<?php

namespace Upwebdesign\Infusionsoft\Console\Commands;

use Illuminate\Console\Command;

class TokenRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infusionsoft:token-refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh Infusionsoft access token(s)';

    /**
     * Infusionsoft client ID
     *
     * @var string
     */
    private $client_id;

    /**
     * Infusionsoft client secret
     *
     * @var string
     */
    private $client_secret;

    /**
     * Token store (cache) name
     *
     * @var string
     */
    private $token_name;

    /**
     * Type of data (cache) store
     *
     * @var string
     */
    private $store;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->store = config('infusionsoft.cache');
        if (config('infusionsoft.multi')) {
            $infusionsoft_accounts = json_decode(trim(stripslashes(config('infusionsoft.accounts'))), true);
            foreach ($infusionsoft_accounts as $account) {
                $key = array_key_first($account);
                $this->client_id = $account[$key]['client_id'];
                $this->client_secret = $account[$key]['client_secret'];
                $this->token_name = sprintf('%s.%s', config('infusionsoft.token_name'), $key);

                $this->refreshAccessToken();
            }
        } else {
            $this->client_id = config('infusionsoft.client_id');
            $this->client_secret = config('infusionsoft.client_secret');
            $this->token_name = sprintf('%s.default', config('infusionsoft.token_name'));

            $this->refreshAccessToken();
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function refreshAccessToken()
    {
        $inf = new \Infusionsoft\Infusionsoft([
            'clientId' => $this->client_id,
            'clientSecret' => $this->client_secret,
        ]);

        $token = cache()
            ->store($this->store)
            ->get($this->token_name, false);

        $token = new \Infusionsoft\Token(unserialize($token));
        $token->setEndOfLife($token->getEndOfLife() - time());
        $inf->setToken($token);
        $token = $inf->refreshAccessToken();
        $this->storeAccessToken($token);
    }

    /**
     * Store access token in the cache
     *
     * @return void
     */
    public function storeAccessToken($token)
    {
        $extra = $token->getExtraInfo();

        cache()
            ->store($this->store)
            ->forever(
                $this->token_name,
                serialize([
                    'access_token' => $token->getAccessToken(),
                    'refresh_token' => $token->getRefreshToken(),
                    'expires_in' => $token->getEndOfLife(),
                    'token_type' => $extra['token_type'],
                    'scope' => $extra['scope'],
                ])
            );
    }
}
