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

namespace IronLions\WHMCS\Infra\Query;

use DateTimeImmutable;
use Exception;
use Illuminate\Support\Collection;
use IronLions\WHMCS\App\Service\EntityManager as em;
use IronLions\WHMCS\Domain\Client as C;
use IronLions\WHMCS\Domain\Repo\ClientRepositoryInterface;
use IronLions\WHMCS\Infra\AbstractQuery;

final class Client extends AbstractQuery implements ClientRepositoryInterface
{
    /**
     * @throws Exception
     */
    public function getOneById(int $id): C
    {
        /** @var Collection|array $results */
        $results = em::_table(C::TABLE)
            ->where(C::FIELD_ID, '=', $id)
            ->limit(1)
            ->get();

        return $this->mapEntity($results)[0];
    }

    /**
     * @param C $client
     */
    public function update(C $client): void
    {
        em::_table(C::TABLE)
            ->where(C::FIELD_ID, '=', $client->getId())
            ->update(
                [
                    C::FIELD_FIRST_NAME               => $client->firstname,
                    C::FIELD_LAST_NAME                => $client->lastname,
                    C::FIELD_COMPANY_NAME             => $client->companyName,
                    C::FIELD_EMAIL                    => $client->email,
                    C::FIELD_ADDRESS_1                => $client->address1,
                    C::FIELD_ADDRESS_2                => $client->address2,
                    C::FIELD_CITY                     => $client->city,
                    C::FIELD_STATE                    => $client->state,
                    C::FIELD_POST_CODE                => $client->postCode,
                    C::FIELD_COUNTRY                  => $client->country,
                    C::FIELD_PHONE_NUMBER             => $client->phoneNumber,
                    C::FIELD_TAX_ID                   => $client->taxId,
                    C::FIELD_PASSWORD                 => $client->password,
                    C::FIELD_AUTH                     => $client->authModule,
                    C::FIELD_AUTH_DATA                => $client->authData,
                    C::FIELD_CURRENCY                 => $client->currency,
                    C::FIELD_DEFAULT_GATEWAY          => $client->defaultGateway,
                    C::FIELD_CREDIT                   => $client->credit,
                    C::FIELD_TAX_EXEMPT               => $client->taxExempt,
                    C::FIELD_LATE_FEE_OVERRIDE        => $client->lateFeeOverride,
                    C::FIELD_DUE_NOTICES_OVERRIDE     => $client->dueNoticesOverride,
                    C::FIELD_SEPARATE_INVOICES        => $client->separateInvoices,
                    C::FIELD_DISABLE_AUTO_CC          => $client->disableAutoCC,
                    C::FIELD_DATE_CREATED             => $client->created,
                    C::FIELD_NOTES                    => $client->notes,
                    C::FIELD_BILLING_CID              => $client->billingCid,
                    C::FIELD_SECURITY_QUESTION_ID     => $client->securityQid,
                    C::FIELD_SECURITY_QUESTION_ANSWER => $client->securityQuestionAnswer,
                    C::FIELD_GROUP_ID                 => $client->groupId,
                    C::FIELD_CARD_TYPE                => $client->cardType,
                    C::FIELD_CARD_LAST_FOUR           => $client->cardLastFour,
                    C::FIELD_CARD_NUM                 => $client->cardNumber,
                    C::FIELD_CARD_START_DATE          => $client->startDate,
                    C::FIELD_CARD_EXPIRY_DATE         => $client->expDate,
                    C::FIELD_ISSUE_NUMBER             => $client->issueNumber,
                    C::FIELD_BANK_NAME                => $client->bankName,
                    C::FIELD_BANK_TYPE                => $client->bankType,
                    C::FIELD_BANK_CODE                => $client->bankCode,
                    C::FIELD_BANK_ACCOUNT             => $client->bankAcct,
                    C::FIELD_GATEWAY_ID               => $client->gatewayId,
                    C::FIELD_LAST_LOGIN               => $client->lastLogin,
                    C::FIELD_IP                       => $client->ip,
                    C::FIELD_HOST                     => $client->host,
                    C::FIELD_STATUS                   => (string) $client->status,
                    C::FIELD_LANGUAGE                 => $client->language,
                    C::FIELD_PW_RESET_KEY             => $client->pwResetKey,
                    C::FIELD_EMAIL_OPT_OUT            => $client->emailOptOut,
                    C::FIELD_EMAIL_MARKETING_OPT_IN   => $client->marketingEmailsOptIn,
                    C::FIELD_AUTO_CLOSE_OVERRIDE      => $client->autoCloseOverride,
                    C::FIELD_ALLOW_SSO                => $client->allowSSO,
                    C::FIELD_EMAIL_VERIFIED           => $client->emailVerified,
                    C::FIELD_CREATED_AT               => $client->created,
                    C::FIELD_UPDATED_AT               => $client->updated,
                    C::FIELD_PW_RESET_EXPIRY          => $client->pwResetKeyExpire,
                ]
            );
    }

    /**
     * @throws Exception
     *
     * @return C[]
     */
    private function mapEntity(array $results): array
    {
        foreach ($results as &$result) {
            $result = new C(
                (int) $result->{C::FIELD_ID},
                (string) $result->{C::FIELD_UUID},
                (string) $result->{C::FIELD_FIRST_NAME},
                (string) $result->{C::FIELD_LAST_NAME},
                (string) $result->{C::FIELD_COMPANY_NAME},
                (string) $result->{C::FIELD_EMAIL},
                (string) $result->{C::FIELD_ADDRESS_1},
                (string) $result->{C::FIELD_ADDRESS_2},
                (string) $result->{C::FIELD_CITY},
                (string) $result->{C::FIELD_STATE},
                (string) $result->{C::FIELD_POST_CODE},
                (string) $result->{C::FIELD_COUNTRY},
                (string) $result->{C::FIELD_PHONE_NUMBER},
                (string) $result->{C::FIELD_TAX_ID},
                (string) $result->{C::FIELD_PASSWORD},
                (string) $result->{C::FIELD_AUTH},
                (string) $result->{C::FIELD_AUTH_DATA},
                (int) $result->{C::FIELD_CURRENCY},
                (string) $result->{C::FIELD_DEFAULT_GATEWAY},
                (float) $result->{C::FIELD_CREDIT},
                (bool) $result->{C::FIELD_TAX_EXEMPT},
                (bool) $result->{C::FIELD_LATE_FEE_OVERRIDE},
                (bool) $result->{C::FIELD_DUE_NOTICES_OVERRIDE},
                (bool) $result->{C::FIELD_SEPARATE_INVOICES},
                (bool) $result->{C::FIELD_DISABLE_AUTO_CC},
                new DateTimeImmutable($result->{C::FIELD_DATE_CREATED}),
                (string) $result->{C::FIELD_NOTES},
                (int) $result->{C::FIELD_BILLING_CID},
                (int) $result->{C::FIELD_SECURITY_QUESTION_ID},
                (string) $result->{C::FIELD_SECURITY_QUESTION_ANSWER},
                (int) $result->{C::FIELD_GROUP_ID},
                (string) $result->{C::FIELD_CARD_TYPE},
                (string) $result->{C::FIELD_CARD_LAST_FOUR},
                (string) $result->{C::FIELD_CARD_NUM},
                (string) $result->{C::FIELD_CARD_START_DATE},
                (string) $result->{C::FIELD_CARD_EXPIRY_DATE},
                (string) $result->{C::FIELD_ISSUE_NUMBER},
                (string) $result->{C::FIELD_BANK_NAME},
                (string) $result->{C::FIELD_BANK_TYPE},
                (string) $result->{C::FIELD_BANK_CODE},
                (string) $result->{C::FIELD_BANK_ACCOUNT},
                (string) $result->{C::FIELD_GATEWAY_ID},
                new DateTimeImmutable($result->{C::FIELD_LAST_LOGIN}),
                (string) $result->{C::FIELD_IP},
                (string) $result->{C::FIELD_HOST},
                new C\Status($result->{C::FIELD_STATUS}),
                (string) $result->{C::FIELD_LANGUAGE},
                (string) $result->{C::FIELD_PW_RESET_KEY},
                (bool) $result->{C::FIELD_EMAIL_OPT_OUT},
                (bool) $result->{C::FIELD_EMAIL_MARKETING_OPT_IN},
                (bool) $result->{C::FIELD_AUTO_CLOSE_OVERRIDE},
                (bool) $result->{C::FIELD_ALLOW_SSO},
                (bool) $result->{C::FIELD_EMAIL_VERIFIED},
                new DateTimeImmutable($result->{C::FIELD_CREATED_AT}),
                new DateTimeImmutable($result->{C::FIELD_UPDATED_AT}),
                new DateTimeImmutable($result->{C::FIELD_PW_RESET_EXPIRY})
            );
        }

        return $results;
    }
}
