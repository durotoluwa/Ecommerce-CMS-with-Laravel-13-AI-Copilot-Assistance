<?php

namespace App\Services;

use App\Models\PaystackSettings;

class PaystackService
{
    protected $settings;

    public function __construct()
    {
        $this->settings = PaystackSettings::first();
    }

    public function getPublicKey(): string
    {
        return $this->settings->public_key ?? config('paystack.public_key');
    }

    public function getSecretKey(): string
    {
        return $this->settings->secret_key ?? config('paystack.secret_key');
    }

    public function getMerchantEmail(): string
    {
        return $this->settings->merchant_email ?? config('paystack.merchant_email');
    }

    public function isActive(): bool
    {
        return $this->settings->status ?? config('paystack.status', false);
    }




}
