## Hounslow GovPay Client

This is a client for the [GOV.UK Payments API](https://www.payments.service.gov.uk) used by [London Borough of Hounslow](https://www.hounslow.gov.uk).

### Releases

- These are covered in [the Changelog](docs/CHANGELOG.md)

### Requirements

- [PHP 7.4.2+](https://www.php.net/downloads.php)
- [Git](https://git-scm.com/downloads)
- [Composer](https://getcomposer.org)

### Setup

- Run `composer require lb-hounslow/govpay-client`.
- See [example.php](example.php) for usage.
- Requires the `API url`, `Client ID`, `Client Secret` and an active `user account` with the correct roles.

### Usage

See [usage documentation](docs/USAGE.md)

### Tests

Run `./vendor/bin/phpunit tests`

### Contributing

This repository is currently closed for contribution. Please [report an an issue](https://github.com/LBHounslow/govpay-client/issues) if you come across one.
