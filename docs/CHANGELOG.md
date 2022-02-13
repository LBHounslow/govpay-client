## Hounslow GOV.UK Pay Client

## Changelog

### Release v1.3.0 `13/02/2022`

Fixes:
- Added fix for `PaymentRepository->setReference()` method.

Updates:
- Additional unit test coverage added for setters and getters in all entities.

### Release v1.2.0 `09/12/2021`

Updates:
- Added [ApiErrorResponseException](../src/Exception/ApiErrorResponseException.php) which takes `ApiResponse` as an argument and stores (and provides) error response information from the GOV.UK api.
- Updated `PaymentRepository` and `RefundRepository` to throw this exception for an unsuccessful api response (`!ApiResponse.isSuccessful()`).
- Updated unit tests and documentation to cover this new exception.
- Removed incorrect @throws tags from `post` and `get` methods in [Client](../src/Client/Client.php).

Fixes:
- Added default empty string value for `paymentId` attribute in [Refund](../src/Entity/Refund.php) entity.
- Added unit test coverage in [RefundTest](../tests/unit/Entity/RefundTest.php) for both empty and populated `paymentId` attribute.

### Release v1.1.0 `10/11/2021`

- Added [PaginatedResults](../src/Entity/PaginatedResults.php) to better structure the repository results for `fetchAll()` requests.
- Updated unit tests to cover this new functionality.

### Release v1.0.0 `09/11/2021`

Initial application layout.
