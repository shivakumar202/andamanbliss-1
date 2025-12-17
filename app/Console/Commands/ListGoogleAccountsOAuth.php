<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google\Client;
use Google\Service\MyBusinessAccountManagement;

class ListGoogleAccountsOAuth extends Command
{
    protected $signature = 'google:list-accounts-oauth';
    protected $description = 'List Google Business Profile accounts using Gmail OAuth';

    public function handle()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->setScopes(['https://www.googleapis.com/auth/business.manage']);
        $client->setRedirectUri('http://localhost/oauth2callback');

        $authUrl = $client->createAuthUrl();
        $this->info("Open this URL in your browser and authorize:");
        $this->info($authUrl);

        $code = $this->ask('Enter the authorization code here: ');

        $accessToken = $client->fetchAccessTokenWithAuthCode($code);
        $client->setAccessToken($accessToken);

        $service = new MyBusinessAccountManagement($client);
        $accounts = $service->accounts->listAccounts();

        foreach ($accounts->getAccounts() as $account) {
            $this->info("Account ID: " . $account->name);
            $this->info("Account Name: " . $account->accountName);

            $locations = $service->accounts_locations->listAccountsLocations($account->name);
            foreach ($locations->getLocations() as $location) {
                $this->info("  Location ID: " . $location->name);
                $this->info("  Location Title: " . $location->title);
            }
        }
    }
}
