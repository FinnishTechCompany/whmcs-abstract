<?php

declare(strict_types=1);

/**
 *
 * WHMCS Gateway Fees 2019 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * @copyright 2017-2019 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2019 (c) IronLions (https://ironlions.fi)
 *
 */

namespace IronLions\WHMCS\Domain;

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

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $uuid;
    /**
     * @var string
     */
    private $firstname;
    /**
     * @var string
     */
    private $lastname;
    /**
     * @var string
     */
    private $companyName;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $address1;
    /**
     * @var string
     */
    private $address2;
    /**
     * @var string
     */
    private $city;
    /**
     * @var string
     */
    private $state;
    /**
     * @var string
     */
    private $postCode;
    /**
     * @var string
     */
    private $country;
    /**
     * @var string
     */
    private $phoneNumber;
    /**
     * @var string
     */
    private $taxId;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $authModule;
    /**
     * @var string
     */
    private $authData;
    /**
     * @var int
     */
    private $currency;
    /**
     * @var string
     */
    private $defaultGateway;
    /**
     * @var float
     */
    private $credit;
    /**
     * @var bool
     */
    private $taxExempt;
    /**
     * @var bool
     */
    private $lateFeeOverride;
    /**
     * @var bool
     */
    private $dueNoticesOverride;
    /**
     * @var bool
     */
    private $separateInvoices;
    /**
     * @var bool
     */
    private $disableAutoCC;
    /**
     * @var \DateTimeImmutable
     */
    private $dateCreated;
    /**
     * @var string
     */
    private $notes;
    /**
     * @var int
     */
    private $billingCid;
    /**
     * @var int
     */
    private $securityQid;
    /**
     * @var string
     */
    private $securityQuestionAnswer;
    /**
     * @var int
     */
    private $groupId;
    /**
     * @var string
     */
    private $cardType;
    /**
     * @var string
     */
    private $cardLastFour;
    /**
     * @var string
     */
    private $cardNumber;
    /**
     * @var string
     */
    private $startDate;
    /**
     * @var string
     */
    private $expDate;
    /**
     * @var string
     */
    private $issueNumber;
    /**
     * @var string
     */
    private $bankName;
    /**
     * @var string
     */
    private $bankType;
    /**
     * @var string
     */
    private $bankCode;
    /**
     * @var string
     */
    private $bankAcct;
    /**
     * @var string
     */
    private $gatewayId;
    /**
     * @var \DateTimeImmutable
     */
    private $lastLogin;
    /**
     * @var string
     */
    private $ip;
    /**
     * @var string
     */
    private $host;
    /**
     * @var Status
     */
    private $status;
    /**
     * @var string
     */
    private $language;
    /**
     * @var string
     */
    private $pwResetKey;
    /**
     * @var bool
     */
    private $emailOptOut;
    /**
     * @var bool
     */
    private $marketingEmailsOptIn;
    /**
     * @var bool
     */
    private $autoCloseOverride;
    /**
     * @var bool
     */
    private $allowSSO;
    /**
     * @var bool
     */
    private $emailVerified;
    /**
     * @var \DateTimeImmutable
     */
    private $created;
    /**
     * @var \DateTimeImmutable
     */
    private $updated;
    /**
     * @var \DateTimeImmutable
     */
    private $pwResetKeyExpire;

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
        \DateTimeImmutable $dateCreated,
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
        \DateTimeImmutable $lastLogin,
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
        \DateTimeImmutable $created,
        \DateTimeImmutable $updated,
        \DateTimeImmutable $pwResetKeyExpire
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getAddress1(): string
    {
        return $this->address1;
    }

    /**
     * @return string
     */
    public function getAddress2(): string
    {
        return $this->address2;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getPostCode(): string
    {
        return $this->postCode;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getTaxId(): string
    {
        return $this->taxId;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getAuthModule(): string
    {
        return $this->authModule;
    }

    /**
     * @return string
     */
    public function getAuthData(): string
    {
        return $this->authData;
    }

    /**
     * @return int
     */
    public function getCurrency(): int
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getDefaultGateway(): string
    {
        return $this->defaultGateway;
    }

    /**
     * @return float
     */
    public function getCredit(): float
    {
        return $this->credit;
    }

    /**
     * @return bool
     */
    public function isTaxExempt(): bool
    {
        return $this->taxExempt;
    }

    /**
     * @return bool
     */
    public function isLateFeeOverride(): bool
    {
        return $this->lateFeeOverride;
    }

    /**
     * @return bool
     */
    public function isDueNoticesOverride(): bool
    {
        return $this->dueNoticesOverride;
    }

    /**
     * @return bool
     */
    public function isSeparateInvoices(): bool
    {
        return $this->separateInvoices;
    }

    /**
     * @return bool
     */
    public function isDisableAutoCC(): bool
    {
        return $this->disableAutoCC;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDateCreated(): \DateTimeImmutable
    {
        return $this->dateCreated;
    }

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @return int
     */
    public function getBillingCid(): int
    {
        return $this->billingCid;
    }

    /**
     * @return int
     */
    public function getSecurityQid(): int
    {
        return $this->securityQid;
    }

    /**
     * @return string
     */
    public function getSecurityQuestionAnswer(): string
    {
        return $this->securityQuestionAnswer;
    }

    /**
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
    }

    /**
     * @return string
     */
    public function getCardType(): string
    {
        return $this->cardType;
    }

    /**
     * @return string
     */
    public function getCardLastFour(): string
    {
        return $this->cardLastFour;
    }

    /**
     * @return string
     */
    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getExpDate(): string
    {
        return $this->expDate;
    }

    /**
     * @return string
     */
    public function getIssueNumber(): string
    {
        return $this->issueNumber;
    }

    /**
     * @return string
     */
    public function getBankName(): string
    {
        return $this->bankName;
    }

    /**
     * @return string
     */
    public function getBankType(): string
    {
        return $this->bankType;
    }

    /**
     * @return string
     */
    public function getBankCode(): string
    {
        return $this->bankCode;
    }

    /**
     * @return string
     */
    public function getBankAcct(): string
    {
        return $this->bankAcct;
    }

    /**
     * @return string
     */
    public function getGatewayId(): string
    {
        return $this->gatewayId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getLastLogin(): \DateTimeImmutable
    {
        return $this->lastLogin;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @return string
     */
    public function getPwResetKey(): string
    {
        return $this->pwResetKey;
    }

    /**
     * @return bool
     */
    public function isEmailOptOut(): bool
    {
        return $this->emailOptOut;
    }

    /**
     * @return bool
     */
    public function isMarketingEmailsOptIn(): bool
    {
        return $this->marketingEmailsOptIn;
    }

    /**
     * @return bool
     */
    public function isAutoCloseOverride(): bool
    {
        return $this->autoCloseOverride;
    }

    /**
     * @return bool
     */
    public function isAllowSSO(): bool
    {
        return $this->allowSSO;
    }

    /**
     * @return bool
     */
    public function isEmailVerified(): bool
    {
        return $this->emailVerified;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreated(): \DateTimeImmutable
    {
        return $this->created;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdated(): \DateTimeImmutable
    {
        return $this->updated;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getPwResetKeyExpire(): \DateTimeImmutable
    {
        return $this->pwResetKeyExpire;
    }

    /**
     * @param string $firstname
     *
     * @return Client
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @param string $lastname
     *
     * @return Client
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @param string $companyName
     *
     * @return Client
     */
    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * @param string $email
     *
     * @return Client
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string $address1
     *
     * @return Client
     */
    public function setAddress1(string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * @param string $address2
     *
     * @return Client
     */
    public function setAddress2(string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * @param string $city
     *
     * @return Client
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @param string $state
     *
     * @return Client
     */
    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @param string $postCode
     *
     * @return Client
     */
    public function setPostCode(string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * @param string $country
     *
     * @return Client
     */
    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @param string $phoneNumber
     *
     * @return Client
     */
    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @param string $taxId
     *
     * @return Client
     */
    public function setTaxId(string $taxId): self
    {
        $this->taxId = $taxId;

        return $this;
    }

    /**
     * @param string $password
     *
     * @return Client
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @param string $authModule
     *
     * @return Client
     */
    public function setAuthModule(string $authModule): self
    {
        $this->authModule = $authModule;

        return $this;
    }

    /**
     * @param string $authData
     *
     * @return Client
     */
    public function setAuthData(string $authData): self
    {
        $this->authData = $authData;

        return $this;
    }

    /**
     * @param int $currency
     *
     * @return Client
     */
    public function setCurrency(int $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @param string $defaultGateway
     *
     * @return Client
     */
    public function setDefaultGateway(string $defaultGateway): self
    {
        $this->defaultGateway = $defaultGateway;

        return $this;
    }

    /**
     * @param float $credit
     *
     * @return Client
     */
    public function setCredit(float $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * @param bool $taxExempt
     *
     * @return Client
     */
    public function setTaxExempt(bool $taxExempt): self
    {
        $this->taxExempt = $taxExempt;

        return $this;
    }

    /**
     * @param bool $lateFeeOverride
     *
     * @return Client
     */
    public function setLateFeeOverride(bool $lateFeeOverride): self
    {
        $this->lateFeeOverride = $lateFeeOverride;

        return $this;
    }

    /**
     * @param bool $dueNoticesOverride
     *
     * @return Client
     */
    public function setDueNoticesOverride(bool $dueNoticesOverride): self
    {
        $this->dueNoticesOverride = $dueNoticesOverride;

        return $this;
    }

    /**
     * @param bool $separateInvoices
     *
     * @return Client
     */
    public function setSeparateInvoices(bool $separateInvoices): self
    {
        $this->separateInvoices = $separateInvoices;

        return $this;
    }

    /**
     * @param bool $disableAutoCC
     *
     * @return Client
     */
    public function setDisableAutoCC(bool $disableAutoCC): self
    {
        $this->disableAutoCC = $disableAutoCC;

        return $this;
    }

    /**
     * @param \DateTimeImmutable $dateCreated
     *
     * @return Client
     */
    public function setDateCreated(\DateTimeImmutable $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @param string $notes
     *
     * @return Client
     */
    public function setNotes(string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * @param int $billingCid
     *
     * @return Client
     */
    public function setBillingCid(int $billingCid): self
    {
        $this->billingCid = $billingCid;

        return $this;
    }

    /**
     * @param int $securityQid
     *
     * @return Client
     */
    public function setSecurityQid(int $securityQid): self
    {
        $this->securityQid = $securityQid;

        return $this;
    }

    /**
     * @param string $securityQuestionAnswer
     *
     * @return Client
     */
    public function setSecurityQuestionAnswer(string $securityQuestionAnswer): self
    {
        $this->securityQuestionAnswer = $securityQuestionAnswer;

        return $this;
    }

    /**
     * @param int $groupId
     *
     * @return Client
     */
    public function setGroupId(int $groupId): self
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * @param string $cardType
     *
     * @return Client
     */
    public function setCardType(string $cardType): self
    {
        $this->cardType = $cardType;

        return $this;
    }

    /**
     * @param string $cardLastFour
     *
     * @return Client
     */
    public function setCardLastFour(string $cardLastFour): self
    {
        $this->cardLastFour = $cardLastFour;

        return $this;
    }

    /**
     * @param string $cardNumber
     *
     * @return Client
     */
    public function setCardNumber(string $cardNumber): self
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * @param string $startDate
     *
     * @return Client
     */
    public function setStartDate(string $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @param string $expDate
     *
     * @return Client
     */
    public function setExpDate(string $expDate): self
    {
        $this->expDate = $expDate;

        return $this;
    }

    /**
     * @param string $issueNumber
     *
     * @return Client
     */
    public function setIssueNumber(string $issueNumber): self
    {
        $this->issueNumber = $issueNumber;

        return $this;
    }

    /**
     * @param string $bankName
     *
     * @return Client
     */
    public function setBankName(string $bankName): self
    {
        $this->bankName = $bankName;

        return $this;
    }

    /**
     * @param string $bankType
     *
     * @return Client
     */
    public function setBankType(string $bankType): self
    {
        $this->bankType = $bankType;

        return $this;
    }

    /**
     * @param string $bankCode
     *
     * @return Client
     */
    public function setBankCode(string $bankCode): self
    {
        $this->bankCode = $bankCode;

        return $this;
    }

    /**
     * @param string $bankAcct
     *
     * @return Client
     */
    public function setBankAcct(string $bankAcct): self
    {
        $this->bankAcct = $bankAcct;

        return $this;
    }

    /**
     * @param string $gatewayId
     *
     * @return Client
     */
    public function setGatewayId(string $gatewayId): self
    {
        $this->gatewayId = $gatewayId;

        return $this;
    }

    /**
     * @param \DateTimeImmutable $lastLogin
     *
     * @return Client
     */
    public function setLastLogin(\DateTimeImmutable $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * @param string $ip
     *
     * @return Client
     */
    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @param string $host
     *
     * @return Client
     */
    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @param Status $status
     *
     * @return Client
     */
    public function setStatus(Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param string $language
     *
     * @return Client
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @param string $pwResetKey
     *
     * @return Client
     */
    public function setPwResetKey(string $pwResetKey): self
    {
        $this->pwResetKey = $pwResetKey;

        return $this;
    }

    /**
     * @param bool $emailOptOut
     *
     * @return Client
     */
    public function setEmailOptOut(bool $emailOptOut): self
    {
        $this->emailOptOut = $emailOptOut;

        return $this;
    }

    /**
     * @param bool $marketingEmailsOptIn
     *
     * @return Client
     */
    public function setMarketingEmailsOptIn(bool $marketingEmailsOptIn): self
    {
        $this->marketingEmailsOptIn = $marketingEmailsOptIn;

        return $this;
    }

    /**
     * @param bool $autoCloseOverride
     *
     * @return Client
     */
    public function setAutoCloseOverride(bool $autoCloseOverride): self
    {
        $this->autoCloseOverride = $autoCloseOverride;

        return $this;
    }

    /**
     * @param bool $allowSSO
     *
     * @return Client
     */
    public function setAllowSSO(bool $allowSSO): self
    {
        $this->allowSSO = $allowSSO;

        return $this;
    }

    /**
     * @param bool $emailVerified
     *
     * @return Client
     */
    public function setEmailVerified(bool $emailVerified): self
    {
        $this->emailVerified = $emailVerified;

        return $this;
    }

    /**
     * @param \DateTimeImmutable $created
     *
     * @return Client
     */
    public function setCreated(\DateTimeImmutable $created): self
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @param \DateTimeImmutable $updated
     *
     * @return Client
     */
    public function setUpdated(\DateTimeImmutable $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * @param \DateTimeImmutable $pwResetKeyExpire
     *
     * @return Client
     */
    public function setPwResetKeyExpire(\DateTimeImmutable $pwResetKeyExpire): self
    {
        $this->pwResetKeyExpire = $pwResetKeyExpire;

        return $this;
    }
}
