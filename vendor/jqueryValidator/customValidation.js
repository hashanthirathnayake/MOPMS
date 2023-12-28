

 $.validator.addMethod("validateCity", function(value, element) {
    return this.optional(element) || value != 'default' ;
   }, " Please City Option");

//     is greater than or equal to(>=) i

range: [13, 23]
minlength: 3
maxlength: 4

password_again: {
   equalTo: "#password"
 }

 //strings only
 jQuery.validator.addMethod("stringsonly", function(value, element) {
   return this.optional(element) || /^[a-z-A-Z- -]+$/i.test(value);
   }, "Letters only"); 


//strings and .
jQuery.validator.addMethod("names", function(value, element) {  
   return this.optional(element) || /^[a-z-.]+$/i.test(value);
   }, "Letters and . only"); 

//numbers and .
jQuery.validator.addMethod("numbersDot", function(value, element) {  
   return this.optional(element) || /^[0-9-.]+$/i.test(value);
   }, "Letters and . only"); 

//strings only
jQuery.validator.addMethod("stringsonly", function(value, element) {
   return this.optional(element) || /^[a-z-A-Z- -]+$/i.test(value);
   }, "Letters only"); 

//strings and numbers
jQuery.validator.addMethod("stringsNumbers", function(value, element) {
   return this.optional(element) || /^[a-z-A-Z-0-9- -]+$/i.test(value);
   }, "Letters and numbers only"); 
