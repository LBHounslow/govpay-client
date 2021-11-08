<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client as GuzzleClient;
use LBHounslow\GovPay\Client\Client as GovPayClient;
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
        ->find('g84id4l6cq7o6mg0vrf4sfr0op');

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
        ->fetchPaymentEvents('k308j20dfo10e1673ie76eg4qb');

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
        ->fetchPaymentRefunds('26bspqeuo2e1b8ai8kgdkcja0q');

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
    /** @var Payment[] $results */
    $results = $govPayClient
        ->getRepository(Payment::class) /** @var PaymentRepository */
        ->setFromDate('2021-10-01 00:00:00')
        ->setToDate('2021-10-31 23:59:59')
        ->setPerPage(20)
        ->fetchAll();

    $payment = array_shift($results);  // grab the first one

    echo $payment->getPaymentId() . ' '
        . $payment->getDescription() . ' '
        . $payment->getCreatedDate() . PHP_EOL;

} catch (\Exception $e) {
    // Handle $e
}

/*** SEARCH ALL REFUNDS **/

try {
    /** @var Refund[] $results */
    $results = $govPayClient
        ->getRepository(Refund::class) /** @var RefundRepository */
        ->setFromDate('2021-10-01 00:00:00')
        ->setToDate('2021-10-31 23:59:59')
        ->setPerPage(20)
        ->fetchAll();

    $refund = array_shift($results);  // grab the first one

    echo $refund->getPaymentId() . ' '
        . $refund->getCreatedDate() . ' '
        . $refund->getAmount() . ' '
        . $refund->getStatus() . PHP_EOL;

} catch (\Exception $e) {
    // Handle $e
}

