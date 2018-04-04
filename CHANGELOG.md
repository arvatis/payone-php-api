# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## Unreleased

### Added

* add secure invoice payment method
* refactor request and response generation
* implemented request for paydirect payment method
* implemented request for PayPal payment method

### Fixed
* correctly pass txid in refund

##[1.0.0-rc1]
### Fixed

* Use correct authorization type for debit payment preauthorization

## [1.0.1-beta]
### Fixed

* Use correct parameter for redirect urls back to shop

## [1.0.0-beta]
### Added

Implemented the required API calls for following payment methods:

* invoice
* prepayment
* pay on delivery
* debit payment
* credit card
* credit card 3DS
