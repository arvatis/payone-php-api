# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## Unreleased

### Added
* WIP: add bank transfer payment method
* make tests more verbose

### Fixed 
* refund request can not be generated


## [2.2.2]
### Fixed 

* allow settleaccount to be passed for capture request

## [2.2.1]
### Fixed 

* debit amount has not been negative for refunds

## [2.2.0]
### Added

* add secure invoice payment method
* added option to pass cart in requests

## [2.1.0]
### Added

* add sofort payment method
* add secure invoice payment method

## [2.0.0]
### Added
* refactor request and response generation (basket now needs to be passed to all requests)

## [1.2.0]
### Added
* implemented request for paydirect payment method
* implemented request for PayPal payment method

### Fixed
* correctly pass txid in refund

## [1.0.0-rc1]
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
