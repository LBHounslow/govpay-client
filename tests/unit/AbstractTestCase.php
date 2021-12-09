<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * Mock data for unit tests
 * @link https://docs.payments.service.gov.uk
 */
abstract class AbstractTestCase extends TestCase
{
    const SEARCH_RESULTS_TOTAL = 100;
    const SEARCH_RESULTS_COUNT = 20;
    const SEARCH_RESULTS_PAGE = 2;
    const SEARCH_LINKS_SELF_HREF = 'https://api.url?display_size=20&page=2';
    const SEARCH_LINKS_FIRST_HREF = 'https://api.url?display_size=20&page=1';
    const SEARCH_LINKS_LAST_HREF = 'https://api.url?display_size=20&page=5';
    const SEARCH_LINKS_PREV_HREF = 'https://api.url?display_size=20&page=1';
    const SEARCH_LINKS_NEXT_HREF = 'https://api.url?display_size=20&page=3';

    const PAYMENT_CREATED_DATE = '2021-11-07T14:08:26.988Z';
    const PAYMENT_UPDATED_DATE = '2021-11-07T14:08:26.988Z';
    const PAYMENT_AMOUNT = 3750;
    const PAYMENT_STATE_STATUS = 'success';
    const PAYMENT_STATE_FINISHED = true;
    const PAYMENT_STATE_MESSAGE = 'Payment expired';
    const PAYMENT_STATE_CODE = 'P0020';
    const PAYMENT_DESCRIPTION = 'Payment description';
    const PAYMENT_REFERENCE = '12345';
    const PAYMENT_LANGUAGE = 'en';
    const PAYMENT_METADATA_LEDGER_CODE_KEY = 'ledger_code';
    const PAYMENT_METADATA_LEDGER_CODE_VALUE = 'AB100';
    const PAYMENT_METADATA_AN_INTERNAL_REFERENCE_NUMBER_KEY = 'an_internal_reference_number';
    const PAYMENT_METADATA_AN_INTERNAL_REFERENCE_NUMBER_VALUE = '200';
    const PAYMENT_EMAIL = 'test.person@domain.com';
    const PAYMENT_CARD_DETAILS_CARD_BRAND = 'Visa';
    const PAYMENT_CARD_DETAILS_CARD_TYPE = 'debit';
    const PAYMENT_CARD_DETAILS_LAST_DIGITS_CARD_NUMBER = '1234';
    const PAYMENT_CARD_DETAILS_FIRST_DIGITS_CARD_NUMBER = '123456';
    const PAYMENT_CARD_DETAILS_EXPIRY_DATE = '01/25';
    const PAYMENT_CARD_DETAILS_CARDHOLDER_NAME = 'Test Person';
    const PAYMENT_CARD_DETAILS_BILLING_ADDRESS_LINE_1 = '123 Test Street';
    const PAYMENT_CARD_DETAILS_BILLING_ADDRESS_LINE_2 = 'Flat 1';
    const PAYMENT_CARD_DETAILS_BILLING_ADDRESS_POSTCODE = 'NW1 6XE';
    const PAYMENT_CARD_DETAILS_BILLING_ADDRESS_CITY = 'London';
    const PAYMENT_CARD_DETAILS_BILLING_ADDRESS_COUNTRY = 'GB';
    const PAYMENT_PAYMENT_ID = 'hu20sqlact5260q2nanm0q8u93';
    const PAYMENT_AUTHORISATION_SUMMARY_THREE_D_SECURE_REQUIRED = true;
    const PAYMENT_REFUND_SUMMARY_STATUS = 'available';
    const PAYMENT_REFUND_SUMMARY_AMOUNT_AVAILABLE = 4000;
    const PAYMENT_REFUND_SUMMARY_AMOUNT_SUBMITTED = 0;
    const PAYMENT_SETTLEMENT_SUMMARY_CAPTURE_SUBMIT_TIME = '2021-11-07T14:08:26.988Z';
    const PAYMENT_SETTLEMENT_SUMMARY_CAPTURED_DATE = '2021-11-06';
    const PAYMENT_SETTLEMENT_SUMMARY_SETTLED_DATE = '2021-11-06';
    const PAYMENT_DELAYED_CAPTURE = false;
    const PAYMENT_MOTO = false;
    const PAYMENT_CORPORATE_CARD_SURCHARGE = 250;
    const PAYMENT_TOTAL_AMOUNT = 4000;
    const PAYMENT_FEE = 200;
    const PAYMENT_NET_AMOUNT = 3800;
    const PAYMENT_PAYMENT_PROVIDER = 'worldpay';
    const PAYMENT_PROVIDER_ID = '10987654321';
    const PAYMENT_RETURN_URL = 'https://return.url';

    const PAYMENT_ARRAY = [
        'created_date' => self::PAYMENT_CREATED_DATE,
        'amount' => self::PAYMENT_AMOUNT,
        'state' => [
            'status' => self::PAYMENT_STATE_STATUS,
            'finished' => self::PAYMENT_STATE_FINISHED,
            'message' => self::PAYMENT_STATE_MESSAGE,
            'code' => self::PAYMENT_STATE_CODE
        ],
        'description' => self::PAYMENT_DESCRIPTION,
        'reference' => self::PAYMENT_REFERENCE,
        'language' => self::PAYMENT_LANGUAGE,
        'metadata' => [
            self::PAYMENT_METADATA_LEDGER_CODE_KEY => self::PAYMENT_METADATA_LEDGER_CODE_VALUE,
            self::PAYMENT_METADATA_AN_INTERNAL_REFERENCE_NUMBER_KEY => self::PAYMENT_METADATA_AN_INTERNAL_REFERENCE_NUMBER_VALUE,
        ],
        'email' => self::PAYMENT_EMAIL,
        'card_details' => [
            'card_brand' => self::PAYMENT_CARD_DETAILS_CARD_BRAND,
            'card_type' => self::PAYMENT_CARD_DETAILS_CARD_TYPE,
            'last_digits_card_number' => self::PAYMENT_CARD_DETAILS_LAST_DIGITS_CARD_NUMBER,
            'first_digits_card_number' => self::PAYMENT_CARD_DETAILS_FIRST_DIGITS_CARD_NUMBER,
            'expiry_date' => self::PAYMENT_CARD_DETAILS_EXPIRY_DATE,
            'cardholder_name' => self::PAYMENT_CARD_DETAILS_CARDHOLDER_NAME,
            'billing_address' => [
                'line1' => self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_LINE_1,
                'line2' => self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_LINE_2,
                'postcode' => self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_POSTCODE,
                'city' => self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_CITY,
                'country' => self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_COUNTRY,
            ],
        ],
        'payment_id' => self::PAYMENT_PAYMENT_ID,
        'authorisation_summary' => [
            'three_d_secure' => [
                'required' => self::PAYMENT_AUTHORISATION_SUMMARY_THREE_D_SECURE_REQUIRED,
            ],
        ],
        'refund_summary' => [
            'status' => self::PAYMENT_REFUND_SUMMARY_STATUS,
            'amount_available' => self::PAYMENT_REFUND_SUMMARY_AMOUNT_AVAILABLE,
            'amount_submitted' => self::PAYMENT_REFUND_SUMMARY_AMOUNT_SUBMITTED,
        ],
        'settlement_summary' => [
            'capture_submit_time' => self::PAYMENT_SETTLEMENT_SUMMARY_CAPTURE_SUBMIT_TIME,
            'captured_date' => self::PAYMENT_SETTLEMENT_SUMMARY_CAPTURED_DATE,
            'settled_date' => self::PAYMENT_SETTLEMENT_SUMMARY_SETTLED_DATE,
        ],
        'delayed_capture' => self::PAYMENT_DELAYED_CAPTURE,
        'moto' => self::PAYMENT_MOTO,
        'corporate_card_surcharge' => self::PAYMENT_CORPORATE_CARD_SURCHARGE,
        'total_amount' => self::PAYMENT_TOTAL_AMOUNT,
        'fee' => self::PAYMENT_FEE,
        'net_amount' => self::PAYMENT_NET_AMOUNT,
        'payment_provider' => self::PAYMENT_PAYMENT_PROVIDER,
        'provider_id' => self::PAYMENT_PROVIDER_ID,
        'return_url' => self::PAYMENT_RETURN_URL,
    ];

    const PAYMENT_EVENT_UPDATED_DATE = '2021-11-07T14:08:26.988Z';

    const PAYMENT_EVENT_ARRAY = [
        'payment_id' => self::PAYMENT_PAYMENT_ID,
        'updated' => self::PAYMENT_EVENT_UPDATED_DATE,
        'state' => [
            'status' => self::PAYMENT_STATE_STATUS,
            'finished' => self::PAYMENT_STATE_FINISHED,
            'message' => self::PAYMENT_STATE_MESSAGE,
            'code' => self::PAYMENT_STATE_CODE
        ]
    ];

    const PAYMENT_EVENTS_RESULTS_ARRAY = [
        'payment_id' => self::PAYMENT_PAYMENT_ID,
        'events' => [
            self::PAYMENT_EVENT_ARRAY
        ]
    ];

    const SEARCH_RESULTS_EMPTY_ARRAY = [
        'total' => 0,
        'count' => 0,
        'page' => 1,
        'results' => []
    ];

    const PAYMENT_SEARCH_RESULTS_ARRAY = [
        'total' => self::SEARCH_RESULTS_TOTAL,
        'count' => self::SEARCH_RESULTS_COUNT,
        'page' => self::SEARCH_RESULTS_PAGE,
        'results' => [
            self::PAYMENT_ARRAY,
        ],
        '_links' => [
            'self' => [
                'href' => self::SEARCH_LINKS_SELF_HREF,
                'method' => 'GET',
            ],
            'first_page' => [
                'href' => self::SEARCH_LINKS_FIRST_HREF,
                'method' => 'GET',
            ],
            'last_page' => [
                'href' => self::SEARCH_LINKS_LAST_HREF,
                'method' => 'GET',
            ],
            'prev_page' => [
                'href' => self::SEARCH_LINKS_PREV_HREF,
                'method' => 'GET',
            ],
            'next_page' => [
                'href' => self::SEARCH_LINKS_NEXT_HREF,
                'method' => 'GET',
            ]
        ]
    ];

    const REFUND_REFUND_ID = 'act4c33g40j3edfmi8jknab84x';
    const REFUND_PAYMENT_ID = '5chu1yzxglqajfv97ous23s22i';
    const REFUND_CREATED_DATE = '2021-11-07T14:08:26.988Z';
    const REFUND_AMOUNT = 120;
    const REFUND_STATUS_SUCCESS = 'success';
    const REFUND_SETTLEMENT_SUMMARY_SETTLED_DATE = '2021-11-06';

    const REFUND_ARRAY_NO_PAYMENT_LINK = [
        'refund_id' => self::REFUND_REFUND_ID,
        'created_date' => self::REFUND_CREATED_DATE,
        'amount' => self::REFUND_AMOUNT,
        'status' => self::REFUND_STATUS_SUCCESS,
        'settlement_summary' => [
            'settled_date' => self::REFUND_SETTLEMENT_SUMMARY_SETTLED_DATE
        ]
    ];

    const REFUND_ARRAY_WITH_PAYMENT_LINK = [
        'refund_id' => self::REFUND_REFUND_ID,
        'created_date' => self::REFUND_CREATED_DATE,
        'amount' => self::REFUND_AMOUNT,
        'status' => self::REFUND_STATUS_SUCCESS,
        'settlement_summary' => [
            'settled_date' => self::REFUND_SETTLEMENT_SUMMARY_SETTLED_DATE
        ],
        '_links' => [
            'payment' => [
                'href' => 'https://publicapi.payments.service.gov.uk/v1/payments/5chu1yzxglqajfv97ous23s22i',
                'method' => 'GET',
            ]
        ]
    ];

    const PAYMENT_REFUNDS_RESULTS_ARRAY_NO_PAYMENT_LINK = [
        'payment_id' => self::PAYMENT_PAYMENT_ID,
        '_embedded' => [
            'refunds' => [
                self::REFUND_ARRAY_NO_PAYMENT_LINK
            ]
        ]
    ];

    const PAYMENT_REFUNDS_RESULTS_ARRAY_WITH_PAYMENT_LINK = [
        'payment_id' => self::PAYMENT_PAYMENT_ID,
        '_embedded' => [
            'refunds' => [
                self::REFUND_ARRAY_WITH_PAYMENT_LINK
            ]
        ]
    ];

    const REFUND_SEARCH_RESULTS_ARRAY = [
        'total' => self::SEARCH_RESULTS_TOTAL,
        'count' => self::SEARCH_RESULTS_COUNT,
        'page' => self::SEARCH_RESULTS_PAGE,
        'results' => [
            self::REFUND_ARRAY_WITH_PAYMENT_LINK
        ],
        '_links' => [
            'self' => [
                'href' => self::SEARCH_LINKS_SELF_HREF,
                'method' => 'GET',
            ],
            'first_page' => [
                'href' => self::SEARCH_LINKS_FIRST_HREF,
                'method' => 'GET',
            ],
            'last_page' => [
                'href' => self::SEARCH_LINKS_LAST_HREF,
                'method' => 'GET',
            ],
            'prev_page' => [
                'href' => self::SEARCH_LINKS_PREV_HREF,
                'method' => 'GET',
            ],
            'next_page' => [
                'href' => self::SEARCH_LINKS_NEXT_HREF,
                'method' => 'GET',
            ]
        ]
    ];

    const ERROR_FIELD = 'amount';
    const ERROR_CODE = 'P0102';
    const ERROR_DESCRIPTION = 'Invalid attribute value: amount. Must be less than or equal to 10000000';

    const ERROR_RESPONSE_WITHOUT_FIELD = [
        'code' => self::ERROR_CODE,
        'description' => self::ERROR_DESCRIPTION,
    ];

    const ERROR_RESPONSE_WITH_FIELD = [
        'field' => self::ERROR_FIELD,
        'code' => self::ERROR_CODE,
        'description' => self::ERROR_DESCRIPTION,
    ];

    const FROM_DATE_MYSQL = '2021-10-01 00:00:00';
    const FROM_DATE_UTC = '2021-10-01T00:00:00Z';
    const TO_DATE_MYSQL = '2021-10-31 23:59:59';
    const TO_DATE_UTC = '2021-10-31T23:59:59Z';
}