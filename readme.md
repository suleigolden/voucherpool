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
	
	<ul>
		<li>1. click on Generate New Voucher yellow button for a pop up box to display.</li>
		<li>2. Type in the Name and the Email in the fields.</li>
		<li>3. Select Offer Type and set the Fixed Percentage Discount.</li>
		<li>4. Click on Generate Code blue button.</li>
		<li>5. NOTE: All fields are mandatory and after submitting them a new voucher code is created in the database.</li>
	</ul>
## Verify Voucher Code
	
	<ul>
		<li>1. click on Verify Voucher green button for a pop up box to display.</li>
		<li>2. Type in the Name and the Email in the fields.</li>
		<li>3. Click on Verify Code blue button.</li>
		<li>4. NOTE: All fields are mandatory</li>
	</ul>
## Search Voucher Code Using Email Address
	
	<ul>
		<li>1. Type in the Email in the search email field.</li>
		<li>2. Click on search voucher green button to view the result.</li>
	</ul>

## Testing
	
	<p>This application is tested using phpunit for testing, and in Postman.</p>

	