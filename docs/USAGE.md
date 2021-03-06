## Usage

### Client

```
// Initialise client
$govPayClient = new GovPayClient(
    new GuzzleClient(),
    'YOUR-GOV-PAY-API-KEY'
);
```

### Payment Requests

#### Find a specific payment

```
try {
    /** @var Payment $payment */
    $payment = $govPayClient
        ->getRepository(Payment::class) /** @var PaymentRepository */
        ->find('INSERT-PAYMENT-ID');

} catch (ApiErrorResponseException $ae) {
    // Handle
    // $ae->getApiResponse()
    // $ae->getErrorDescription()
    // $ae->getErrorCode()
    // $ae->getErrorField()
} catch (\Exception $e) {
    // Handle $e
    // ApiException
    // InvalidEntityClassException
}
```

#### Fetch a payments events

```
try {
    /** @var PaymentEvent[] $results */
    $results = $govPayClient
        ->getRepository(Payment::class) /** @var PaymentRepository */
        ->fetchPaymentEvents('INSERT-PAYMENT-ID');

} catch (ApiErrorResponseException $ae) {
    // Handle
    // $ae->getApiResponse()
    // $ae->getErrorDescription()
    // $ae->getErrorCode()
    // $ae->getErrorField()
} catch (\Exception $e) {
    // Handle $e
    // ApiException
    // InvalidEntityClassException
}
```

#### Fetch a payments refunds

```
try {
    /** @var Refund[] $results */
    $results = $govPayClient
        ->getRepository(Payment::class) /** @var PaymentRepository */
        ->fetchPaymentRefunds('INSERT-PAYMENT-ID');

} catch (ApiErrorResponseException $ae) {
    // Handle
    // $ae->getApiResponse()
    // $ae->getErrorDescription()
    // $ae->getErrorCode()
    // $ae->getErrorField()
} catch (\Exception $e) {
    // Handle $e
    // ApiException
    // InvalidEntityClassException
}
```

#### Search all payments with filtering

[PaymentRepository](../src/Repository/PaymentRepository.php) offers all filters supported by GOV.UK Pay as setters.

```
try {
    /** @var PaginatedResults $paginatedResults */
    $paginatedResults = $govPayClient
        ->getRepository(Payment::class) /** @var PaymentRepository */
        ->setFromDate('2021-10-01 00:00:00')
        ->setToDate('2021-10-31 23:59:59')
        ->setPerPage(20)
        ->fetchAll();

} catch (ApiErrorResponseException $ae) {
    // Handle
    // $ae->getApiResponse()
    // $ae->getErrorDescription()
    // $ae->getErrorCode()
    // $ae->getErrorField()
} catch (\Exception $e) {
    // Handle $e
    // ApiException
    // InvalidEntityClassException
    // ValidationException
}
```

### Refund Requests

#### Search all refunds with filtering

[RefundRepository](../src/Repository/RefundRepository.php) offers all filters supported by GOV.UK Pay as setters.

```
try {
    /** @var PaginatedResults $paginatedResults */
    $paginatedResults = $govPayClient
        ->getRepository(Refund::class) /** @var RefundRepository */
        ->setFromDate('2021-10-01 00:00:00')
        ->setToDate('2021-10-31 23:59:59')
        ->setPerPage(20)
        ->fetchAll();

} catch (ApiErrorResponseException $ae) {
    // Handle
    // $ae->getApiResponse()
    // $ae->getErrorDescription()
    // $ae->getErrorCode()
    // $ae->getErrorField()
} catch (\Exception $e) {
    // Handle $e
    // ApiException
    // InvalidEntityClassException
    // ValidationException
}
```

For examples, see [example.php](../example.php).