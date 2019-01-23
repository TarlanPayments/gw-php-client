##### Version 1.3.1 (2019-01-23)

	Added possibility to send mercahnt transaction ID for some methods to meet
	GW requirements
	
	Affected methods:
	 - DMS Hold cancel
	 - DMS Hold Charge
	 - Refund
	 - Reversal

##### Version 1.3.0 (2018-12-13)

	Fix authorizarion: correct way is to use $gateway->auth()->setAccountGUID()

##### Version 1.2.0 (2018-08-21)

	Added order information for subsequent requrring payments to pass field merchant-transaction-id
	Added new method B2P (Business To Person)
	Added new method for card 3-D Secure enrollment verification

##### Version 1.1.1 (2018-02-27)

	First release
