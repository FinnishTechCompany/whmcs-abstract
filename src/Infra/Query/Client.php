<?php

declare(strict_types=1);

/**
 *
 * WHMCS Abstract 2019 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * Please see LICENSE file for more specific licensing terms.
 * @copyright 2017-2019 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2019 (c) IronLions (https://ironlions.fi)
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
     * @param int $id
     *
     * @throws Exception
     *
     * @return C
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
                    C::FIELD_FIRST_NAME               => $client->getFirstname(),
                    C::FIELD_LAST_NAME                => $client->getLastname(),
                    C::FIELD_COMPANY_NAME             => $client->getCompanyName(),
                    C::FIELD_EMAIL                    => $client->getEmail(),
                    C::FIELD_ADDRESS_1                => $client->getAddress1(),
                    C::FIELD_ADDRESS_2                => $client->getAddress2(),
                    C::FIELD_CITY                     => $client->getCity(),
                    C::FIELD_STATE                    => $client->getState(),
                    C::FIELD_POST_CODE                => $client->getPostCode(),
                    C::FIELD_COUNTRY                  => $client->getCountry(),
                    C::FIELD_PHONE_NUMBER             => $client->getPhoneNumber(),
                    C::FIELD_TAX_ID                   => $client->getTaxId(),
                    C::FIELD_PASSWORD                 => $client->getPassword(),
                    C::FIELD_AUTH                     => $client->getAuthModule(),
                    C::FIELD_AUTH_DATA                => $client->getAuthData(),
                    C::FIELD_CURRENCY                 => $client->getCurrency(),
                    C::FIELD_DEFAULT_GATEWAY          => $client->getDefaultGateway(),
                    C::FIELD_CREDIT                   => $client->getCredit(),
                    C::FIELD_TAX_EXEMPT               => $client->isTaxExempt(),
                    C::FIELD_LATE_FEE_OVERRIDE        => $client->isLateFeeOverride(),
                    C::FIELD_DUE_NOTICES_OVERRIDE     => $client->isDueNoticesOverride(),
                    C::FIELD_SEPARATE_INVOICES        => $client->isSeparateInvoices(),
                    C::FIELD_DISABLE_AUTO_CC          => $client->isDisableAutoCC(),
                    C::FIELD_DATE_CREATED             => $client->getCreated(),
                    C::FIELD_NOTES                    => $client->getNotes(),
                    C::FIELD_BILLING_CID              => $client->getBillingCid(),
                    C::FIELD_SECURITY_QUESTION_ID     => $client->getSecurityQid(),
                    C::FIELD_SECURITY_QUESTION_ANSWER => $client->getSecurityQuestionAnswer(),
                    C::FIELD_GROUP_ID                 => $client->getGroupId(),
                    C::FIELD_CARD_TYPE                => $client->getCardType(),
                    C::FIELD_CARD_LAST_FOUR           => $client->getCardLastFour(),
                    C::FIELD_CARD_NUM                 => $client->getCardNumber(),
                    C::FIELD_CARD_START_DATE          => $client->getStartDate(),
                    C::FIELD_CARD_EXPIRY_DATE         => $client->getExpDate(),
                    C::FIELD_ISSUE_NUMBER             => $client->getIssueNumber(),
                    C::FIELD_BANK_NAME                => $client->getBankName(),
                    C::FIELD_BANK_TYPE                => $client->getBankType(),
                    C::FIELD_BANK_CODE                => $client->getBankCode(),
                    C::FIELD_BANK_ACCOUNT             => $client->getBankAcct(),
                    C::FIELD_GATEWAY_ID               => $client->getGatewayId(),
                    C::FIELD_LAST_LOGIN               => $client->getLastLogin(),
                    C::FIELD_IP                       => $client->getIp(),
                    C::FIELD_HOST                     => $client->getHost(),
                    C::FIELD_STATUS                   => (string) $client->getStatus(),
                    C::FIELD_LANGUAGE                 => $client->getLanguage(),
                    C::FIELD_PW_RESET_KEY             => $client->getPwResetKey(),
                    C::FIELD_EMAIL_OPT_OUT            => $client->isEmailOptOut(),
                    C::FIELD_EMAIL_MARKETING_OPT_IN   => $client->isMarketingEmailsOptIn(),
                    C::FIELD_AUTO_CLOSE_OVERRIDE      => $client->isAutoCloseOverride(),
                    C::FIELD_ALLOW_SSO                => $client->isAllowSSO(),
                    C::FIELD_EMAIL_VERIFIED           => $client->isEmailVerified(),
                    C::FIELD_CREATED_AT               => $client->getCreated(),
                    C::FIELD_UPDATED_AT               => $client->getUpdated(),
                    C::FIELD_PW_RESET_EXPIRY          => $client->getPwResetKeyExpire(),
                ]
            );
    }

    /**
     * @param array $results
     *
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
                new DateTimeImmutable($result->{C::FIELD_CARD_START_DATE}),
                new DateTimeImmutable($result->{C::FIELD_CARD_EXPIRY_DATE}),
                (string) $result->{C::FIELD_ISSUE_NUMBER},
                (string) $result->{C::FIELD_BANK_NAME},
                (string) $result->{C::FIELD_BANK_TYPE},
                (string) $result->{C::FIELD_BANK_CODE},
                (string) $result->{C::FIELD_BANK_ACCOUNT},
                (string) $result->{C::FIELD_GATEWAY_ID},
                (string) $result->{C::FIELD_LAST_LOGIN},
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
