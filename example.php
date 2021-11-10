<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client as GuzzleClient;
use LBHounslow\GovPay\Client\Client as GovPayClient;
use LBHounslow\GovPay\Entity\PaginatedResults;
use LBHounslow\GovPay\Entity\Payment;
use LBHounslow\GovPay\Entity\PaymentEvent;
use LBHounslow\GovPay\Entity\Refund;
use LBHounslow\GovPay\Repository\PaymentRepository;
use LBHounslow\GovPay\Repository\RefundRepository;

// @link https://www.php.net/manual/en/timezones.php
date_default_timezone_set('Europe/London');

$govPayClient = new GovPayClient(
    new GuzzleClient(),
    'YOUR-GOV-PAY-API-KEY'
);

/*** FIND A SPECIFIC PAYMENT **/

try {
    /** @var Payment $payment */
    $payment = $govPayClient
        ->getRepository(Payment::class) /** @var PaymentRepository */
        ->find('INSERT-PAYMENT-ID');

    echo $payment->getPaymentId() . ' '
        . $payment->getDescription() . ' '
        . $payment->getCreatedDate() . PHP_EOL;

} catch (\Exception $e) {
    // Handle $e
}

/*** FETCH A PAYMENTS EVENTS **/

try {
    /** @var PaymentEvent[] $results */
    $results = $govPayClient
        ->getRepository(Payment::class) /** @var PaymentRepository */
        ->fetchPaymentEvents('INSERT-PAYMENT-ID');

    $paymentEvent = array_shift($results);  // grab the first one

    echo $paymentEvent->getPaymentId() . ' '
        . $paymentEvent->getState()->getStatus()
        . ($paymentEvent->getState()->isFinished() ? ' is finished' : '') . PHP_EOL;

} catch (\Exception $e) {
    // Handle $e
}

/*** FETCH A PAYMENTS REFUNDS **/

try {
    /** @var Refund[] $results */
    $results = $govPayClient
        ->getRepository(Payment::class) /** @var PaymentRepository */
        ->fetchPaymentRefunds('INSERT-PAYMENT-ID');

    $refund = array_shift($results);  // grab the first one

    echo $refund->getPaymentId() . ' '
        . $refund->getCreatedDate() . ' '
        . $refund->getAmount() . ' '
        . $refund->getStatus() . PHP_EOL;

} catch (\Exception $e) {
    // Handle $e
}

/*** SEARCH ALL PAYMENTS **/

try {
    /** @var PaginatedResults $paginatedResults */
    $paginatedResults = $govPayClient
        ->getRepository(Payment::class) /** @var PaymentRepository */
        ->setFromDate('2021-10-01 00:00:00')
        ->setToDate('2021-10-31 23:59:59')
        ->setPerPage(20)
        ->fetchAll();

    $payments = $paginatedResults->getResults();
    $payment = array_shift($payments);  // grab the first one

    echo $payment->getPaymentId() . ' '
        . $payment->getDescription() . ' '
        . $payment->getCreatedDate() . PHP_EOL;

} catch (\Exception $e) {
    // Handle $e
}

/*** SEARCH ALL REFUNDS **/

try {
    /** @var PaginatedResults $paginatedResults */
    $paginatedResults = $govPayClient
        ->getRepository(Refund::class) /** @var RefundRepository */
        ->setFromDate('2021-10-01 00:00:00')
        ->setToDate('2021-10-31 23:59:59')
        ->setPerPage(20)
        ->fetchAll();

    $refunds = $paginatedResults->getResults();
    $refund = array_shift($refunds);  // grab the first one

    echo $refund->getPaymentId() . ' '
        . $refund->getCreatedDate() . ' '
        . $refund->getAmount() . ' '
        . $refund->getStatus() . PHP_EOL;

} catch (\Exception $e) {
    // Handle $e
}

