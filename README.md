MODX-ICC
========

MODX - Inbound Customer Capture is a detailed Custom Resource Class that was built to quickly launch landing page code. The built-in variables that it captures are: IP, HTTP Referal, User Agent, UTM Campaign, UTM Source, UTM Medium, Name, Email, and Phone. It saves this data to the MODX Database and can email you.


FUTURE RELEASES:
  -  Include MixPanel functions
  -  Include Instructions to add AdWords Conversion Script
  -  Create Dashboard Widget
  -  Create Template Variable for Success Page
  -  Create Template Variable for Email to
  -  Add Comments
  

STEP 1: UPLOAD THE CORE FOLDER 
  -  The Files in this GitHub are basic Class Resource Files with a custom intake script.
  -  Learn the basics here: http://rtfm.modx.com/display/revolution20/Creating+a+Resource+Class


STEP 2: CREATE A NAMESPACE IN THE MANAGER
  -  rtfm.modx.com/display/revolution20/Creating+a+Resource+Class#CreatingaResourceClass-CreateaNamespace
  -  iccresource instead of copyrightresource


STEP 3: Adding the Class to Extension Packages
  -  http://rtfm.modx.com/display/revolution20/Creating+a+Resource+Class#CreatingaResourceClass-AddingtheClasstoExtensionPackages
  -  Load, Run the script MODX has after you change the "package_name"


STEP 4: SETUP YOUR EMAIL VARIABLES
  -  Open iccresource/processor.php
  -  Line 48: Enter your Email Address
  -  Line 58: From your Clients domain so you can distinguish them all
  -  This would also be where you add more variables if you know what your doing.


STEP 5: SETUP YOUR TEMPLATE VARIABLES
  -  Open iccresource/model/iccresource/iccresource.class.php
  -  Line 42: I have included jQuery so this works right out of the box. 
  -  If you have jQuery in your templates you can remove this line.
  -  BY DEFAULT: The form validation checks the email for "@" and the name & phone against special characters.
  -  You can adjust that in this section. 


STEP 6: SETUP TABLE IN YOUR MODX DATABASE
CREATE TABLE IF NOT EXISTS `modx_icc` (
  `icc_id` int(50) NOT NULL AUTO_INCREMENT,
  `refer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `medium` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `campaign` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `useragent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`icc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;


STEP 7: CREATE YOUR PAGE
  - Create your new Resource. Right click web -> Create ICC Page 
  - New Resource -> Settings -> Resource Type
  - Whichever you prefer

STEP 8: CREATE CHUNK OR PASTE IN CONTENT
<div id="icc_form">
<input type="text" id="icc_name" value="" placeholder="Full Name"><br>
<input type="text" id="icc_email" value="" placeholder="Email Address"><br>
<input type="text" id="icc_phone" value="" placeholder="Phone # (Digits Only)"><br>
<button id="iccSubmit">click me</button>
</div>
<div id="icc_success">Thank You for submitting</div>

This is the basic form to run ICC. 
NOTICE: its not in <form> because we don't need MODX to reload the page. We are using AJAX to send and receive. 
NOTICE: we are using placeholder so we can check the value easier in jQuery. Must use HTML5 doctype but you already should be.


STEP 9: BASE CSS
.errorField{
  background: #f87a7a;
}
.validField{
	background: #c7f87a;
}

This turns the input red if error and green if valid.


STEP 10: TEST
  - CLEAR YOUR CACHE
  - View the Resource and test the form.
  - If you have any problems please email me, wayne@revitalagency.com






