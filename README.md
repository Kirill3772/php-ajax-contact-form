# php-ajax-contact-form
Dynamic Contact Form using AJAX and PHP, including: Cross Browser Support (even old IE browsers), Server Side Input Validation, Error Messages, Email Spam Filter Bypass (tested with gmail and hotmail), Connection Monitoring and Basic HTML Email Styling.
Created By: Kirill Sukharev --- http://articulateseo.com --- contact at codebargain@gmail.com

GETTING STARTED

SOME COMMON PROBLEMS people have with custom mail scripts are: not being able to send mail out directly with SMPT, having their mail rejected by the receiving email provider, or having their email always end up in the spam folder. This guide will explain how to fix ALl of these issues. Before you get started with the AJAX / PHP form, make sure that you have done the following:

CREATE AN SPF RECORD FOR YOUR DOMAIN: this can ususally be done by going to your domains DNS management and adding a TXT record with value "v=spf1 mx -all" that worked fine for me.

MAKE SURE THAT YOUR HEADERS ARE SET CORRECTLY. Many people will tell you that the contects of the message are the most important in getting your mail through spam. FALSE, after hours of testing and modifying headers, the setup I have will allow your mailscript to bypass spam and go directly to the inbox, even if you use a fake email address and a random message with a bunch of urls. (TESTED WITH GMAIL AND HOTMAIL). The most important part of a mail script are you "headers" and "mail" settings. To prevent spam from reaching your inbox (such as messages with a bunch of urls), you need to user PHP filters, which will prevent the message from being sent at all, or by setting your server to deny access to websites or ip addresses you do not trust.

/////FOR THOSE USING DEDICATED OR CLOUD SERVERS/////////////

USE A RELAY SERVER: This ususally applies to dedicated or cloud servers which have to be setup by the user. If you are using shared hosting, this is generally already done by the hosting provider. However, if you started from a blank Linux box and had to go through setting up a LAMP stack, you will have to do the following: install an MTA such as postfix (only a basic install is needed, not the full mail server installation) and then configure the main config file to use "relayhost=[somerelay.secureserver.net]". If you are using GoDaddy, a safe relay to use is [dedrelay.secureserver.net]. MOST HOSTING PROVIDERS DISABLE DIRECT SMPT BY DEFAULT, if you do not want to use a relay server, you have to contact tech support to enable direct SMPT.

MAKE SURE YOU DONT HAVE TWO MTA's CONFLICTING. A good conflict example would be with Ubuntu 16.04 setup. After going thought your LAMP installation, if you install postfix without doing anything else it will not work. This is because there is already a default MTA setup on the server called sendmail. Postfix needs port 25 to be open, you can check this by running command "netstat -ntlp". To kill the sendmail MTA correclty and allow postfix to work, you need to run this command "killall sendmail-mta" and after "service postfix restart"
