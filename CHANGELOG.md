##### Version 1.5.0 (2019-07-17)

	Add payment data tokenization methods

##### Version 1.4.1 (2019-05-10)

	Add information about inside form in basic usage

##### Version 1.4.0 (2019-05-09)

	Add card verification request.

##### Version 1.3.3 (2019-03-21)

	Add support of custom 3D Secure return url

##### Version 1.3.2 (2019-03-04)

	Add merchant-referring-name fields to an order.

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
