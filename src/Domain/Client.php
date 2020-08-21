<?php

declare(strict_types=1);

/**
 *
 * WHMCS Abstract 2020 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * Please see LICENSE file for more specific licensing terms.
 * @copyright 2017-2020 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2020 (c) Fiteco (https://fiteco.fi)
 *
 */

namespace IronLions\WHMCS\Domain;

use DateTimeImmutable;
use IronLions\WHMCS\Domain\Client\Status;

final class Client
{
    public const TABLE = 'tblclients';
    public const FIELD_ID = 'id';
    public const FIELD_UUID = 'uuid';
    public const FIELD_FIRST_NAME = 'firstname';
    public const FIELD_LAST_NAME = 'lastname';
    public const FIELD_COMPANY_NAME = 'companyname';
    public const FIELD_EMAIL = 'email';
    public const FIELD_ADDRESS_1 = 'address1';
    public const FIELD_ADDRESS_2 = 'address2';
    public const FIELD_CITY = 'city';
    public const FIELD_STATE = 'state';
    public const FIELD_POST_CODE = 'postcode';
    public const FIELD_COUNTRY = 'country';
    public const FIELD_PHONE_NUMBER = 'phonenumber';
    public const FIELD_TAX_ID = 'tax_id';
    public const FIELD_PASSWORD = 'password';
    public const FIELD_AUTH = 'authmodule';
    public const FIELD_AUTH_DATA = 'authdata';
    public const FIELD_CURRENCY = 'currency';
    public const FIELD_DEFAULT_GATEWAY = 'defaultgateway';
    public const FIELD_CREDIT = 'credit';
    public const FIELD_TAX_EXEMPT = 'taxexempt';
    public const FIELD_LATE_FEE_OVERRIDE = 'latefeeoveride';
    public const FIELD_DUE_NOTICES_OVERRIDE = 'overideduenotices';
    public const FIELD_SEPARATE_INVOICES = 'separateinvoices';
    public const FIELD_DISABLE_AUTO_CC = 'disableautocc';
    public const FIELD_DATE_CREATED = 'datecreated';
    public const FIELD_NOTES = 'notes';
    public const FIELD_BILLING_CID = 'billingcid';
    public const FIELD_SECURITY_QUESTION_ID = 'securityqid';
    public const FIELD_SECURITY_QUESTION_ANSWER = 'securityqans';
    public const FIELD_GROUP_ID = 'groupid';
    public const FIELD_CARD_TYPE = 'cardtype';
    public const FIELD_CARD_LAST_FOUR = 'cardlastfour';
    public const FIELD_CARD_NUM = 'cardnum';
    public const FIELD_CARD_START_DATE = 'startdate';
    public const FIELD_CARD_EXPIRY_DATE = 'expdate';
    public const FIELD_ISSUE_NUMBER = 'issuenumber';
    public const FIELD_BANK_NAME = 'bankname';
    public const FIELD_BANK_TYPE = 'banktype';
    public const FIELD_BANK_CODE = 'bankcode';
    public const FIELD_BANK_ACCOUNT = 'bankacct';
    public const FIELD_GATEWAY_ID = 'gatewayid';
    public const FIELD_LAST_LOGIN = 'lastlogin';
    public const FIELD_IP = 'ip';
    public const FIELD_HOST = 'host';
    public const FIELD_STATUS = 'status';
    public const FIELD_LANGUAGE = 'language';
    public const FIELD_PW_RESET_KEY = 'pwresetkey';
    public const FIELD_EMAIL_OPT_OUT = 'emailoptout';
    public const FIELD_EMAIL_MARKETING_OPT_IN = 'marketing_emails_opt_in';
    public const FIELD_AUTO_CLOSE_OVERRIDE = 'overrideautoclose';
    public const FIELD_ALLOW_SSO = 'allow_sso';
    public const FIELD_EMAIL_VERIFIED = 'email_verified';
    public const FIELD_CREATED_AT = 'created_at';
    public const FIELD_UPDATED_AT = 'updated_at';
    public const FIELD_PW_RESET_EXPIRY = 'pwresetexpiry';

    private int $id;
    public string $uuid;
    public string $firstname;
    public string $lastname;
    public string $companyName;
    public string $email;
    public string $address1;
    public string $address2;
    public string $city;
    public string $state;
    public string $postCode;
    public string $country;
    public string $phoneNumber;
    public string $taxId;
    public string $password;
    public string $authModule;
    public string $authData;
    public int $currency;
    public string $defaultGateway;
    public float $credit;
    public bool $taxExempt;
    public bool $lateFeeOverride;
    public bool $dueNoticesOverride;
    public bool $separateInvoices;
    public bool $disableAutoCC;
    public DateTimeImmutable $dateCreated;
    public string $notes;
    public int $billingCid;
    public int $securityQid;
    public string $securityQuestionAnswer;
    public int $groupId;
    public string $cardType;
    public string $cardLastFour;
    public string $cardNumber;
    public string $startDate;
    public string $expDate;
    public string $issueNumber;
    public string $bankName;
    public string $bankType;
    public string $bankCode;
    public string $bankAcct;
    public string $gatewayId;
    public DateTimeImmutable $lastLogin;
    public string $ip;
    public string $host;
    public Status $status;
    public string $language;
    public string $pwResetKey;
    public bool $emailOptOut;
    public bool $marketingEmailsOptIn;
    public bool $autoCloseOverride;
    public bool $allowSSO;
    public bool $emailVerified;
    public DateTimeImmutable $created;
    public DateTimeImmutable $updated;
    public DateTimeImmutable $pwResetKeyExpire;

    public function __construct(
        int $id,
        string $uuid,
        string $firstname,
        string $lastname,
        string $companyName,
        string $email,
        string $address1,
        string $address2,
        string $city,
        string $state,
        string $postCode,
        string $country,
        string $phoneNumber,
        string $taxId,
        string $password,
        string $authModule,
        string $authData,
        int $currency,
        string $defaultGateway,
        float $credit,
        bool $taxExempt,
        bool $lateFeeOverride,
        bool $dueNoticesOverride,
        bool $separateInvoices,
        bool $disableAutoCC,
        DateTimeImmutable $dateCreated,
        string $notes,
        int $billingCid,
        int $securityQid,
        string $securityQuestionAnswer,
        int $groupId,
        string $cardType,
        string $cardLastFour,
        string $cardNumber,
        string $startDate,
        string $expDate,
        string $issueNumber,
        string $bankName,
        string $bankType,
        string $bankCode,
        string $bankAcct,
        string $gatewayId,
        DateTimeImmutable $lastLogin,
        string $ip,
        string $host,
        Status $status,
        string $language,
        string $pwResetKey,
        bool $emailOptOut,
        bool $marketingEmailsOptIn,
        bool $autoCloseOverride,
        bool $allowSSO,
        bool $emailVerified,
        DateTimeImmutable $created,
        DateTimeImmutable $updated,
        DateTimeImmutable $pwResetKeyExpire
    ) {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->companyName = $companyName;
        $this->email = $email;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->city = $city;
        $this->state = $state;
        $this->postCode = $postCode;
        $this->country = $country;
        $this->phoneNumber = $phoneNumber;
        $this->taxId = $taxId;
        $this->password = $password;
        $this->authModule = $authModule;
        $this->authData = $authData;
        $this->currency = $currency;
        $this->defaultGateway = $defaultGateway;
        $this->credit = $credit;
        $this->taxExempt = $taxExempt;
        $this->lateFeeOverride = $lateFeeOverride;
        $this->dueNoticesOverride = $dueNoticesOverride;
        $this->separateInvoices = $separateInvoices;
        $this->disableAutoCC = $disableAutoCC;
        $this->dateCreated = $dateCreated;
        $this->notes = $notes;
        $this->billingCid = $billingCid;
        $this->securityQid = $securityQid;
        $this->securityQuestionAnswer = $securityQuestionAnswer;
        $this->groupId = $groupId;
        $this->cardType = $cardType;
        $this->cardLastFour = $cardLastFour;
        $this->cardNumber = $cardNumber;
        $this->startDate = $startDate;
        $this->expDate = $expDate;
        $this->issueNumber = $issueNumber;
        $this->bankName = $bankName;
        $this->bankType = $bankType;
        $this->bankCode = $bankCode;
        $this->bankAcct = $bankAcct;
        $this->gatewayId = $gatewayId;
        $this->lastLogin = $lastLogin;
        $this->ip = $ip;
        $this->host = $host;
        $this->status = $status;
        $this->language = $language;
        $this->pwResetKey = $pwResetKey;
        $this->emailOptOut = $emailOptOut;
        $this->marketingEmailsOptIn = $marketingEmailsOptIn;
        $this->autoCloseOverride = $autoCloseOverride;
        $this->allowSSO = $allowSSO;
        $this->emailVerified = $emailVerified;
        $this->created = $created;
        $this->updated = $updated;
        $this->pwResetKeyExpire = $pwResetKeyExpire;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
