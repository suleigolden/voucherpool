<p align="center">Voucher Pool</p>


## Description

This is PHP development task for VanHack. It is developed using Laravel 5.6, Bootstrap and Javascript.


## Installation


   - Clone this repository
   - Create an empty database for this project in your database engine.
   - Name the database voucher Or change it to any name of your choice then open .env file and also chnage the database name to the new name you created.
    
   - In a command line window go to the Laravel project folder and update dependencies running composer update.
   - run php artisan migrate command to create the tables in the database OR import voucher.sql file to your database to create tables.

   - Go to your web browser and go to http://localhost/the name of your project folder to see it working.


## Generate New Voucher
	
	- 1. click on Generate New Voucher yellow button for a pop up box to display.
	- i>2. Type in the Name and the Email in the fields.
	- 3. Select Offer Type and set the Fixed Percentage Discount.
	- 4. Click on Generate Code blue button.
	- 5. NOTE: All fields are mandatory and after submitting them a new voucher code is created in the database.
	
## Verify Voucher Code
	
	- 1. click on Verify Voucher green button for a pop up box to display.
	- 2. Type in the Name and the Email in the fields.
	- 3. Click on Verify Code blue button.
	- 4. NOTE: All fields are mandatory.
	
## Search Voucher Code Using Email Address
	
	- 1. Type in the Email in the search email field.
	- 2. Click on search voucher green button to view the result.
	

## Testing
	
	This application is tested using phpunit for testing, and Postman.

	## Live Demo

	You can view the live demo via this link on my blog page
	https://thelastcodebender.com/voucher