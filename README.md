# php-ajax-contact-form
Dynamic Contact Form using AJAX and PHP, including: Cross Browser Support (even old IE browsers), Server Side Input Validation, Error Messages, Email Spam-Filter Bypass (tested with gmail and hotmail), Connection Monitoring and Basic HTML Email Styling.
Created By: Kirill Sukharev --- example form at --- http://articulateseo.com/test/test-form.php --- send me a message through that.

<h2>Getting Started</h2>

<h3>Some Common Problems</h3>Typical issues people have with custom mail scripts are: not being able to send mail out directly with SMPT, having their mail rejected by the receiving email provider, or having their email always end up in the spam folder. This guide will explain how to fix ALL of these issues. Before you get started with the AJAX / PHP form, make sure that you have done the following:

<h3>Create an SPF Record For Your Domain</h3>This can ususally be done by going to your domains DNS management and adding a TXT record with value "v=spf1 mx -all" that worked fine for me.

<h3>Make Sure That Your Headers Are Set Correctly</h3>Headers, mail() section and the contents of your email are crucial to bypassing email spam filters. This is especially true with MS accounts such as hotmail. This mail form setup will bypass gmail spam filters with ease, however MS accounts are much stricter. Even with a trusted relay server and correct headers/content, you will still have to whitelist the sender from inside your MS accounts.

<h2>For Those Using Dedicated or Cloud Servers</h2>

<h3>Use A Relay Server</h3>This ususally applies to dedicated or cloud servers which have to be setup by the user. If you are using shared hosting, this is generally already done by the hosting provider. However, if you started from a blank Linux box and had to go through setting up a LAMP stack, you will have to do the following: install an MTA such as postfix (only a basic install is needed, not the full mail server installation) and then configure the main config file to use "relayhost=[somerelay.secureserver.net]". If you are using GoDaddy, a safe relay to use is [dedrelay.secureserver.net]. <strong>Most hosting providers disable SMTP by default</strong>, if you do not want to use a relay server, you have to contact tech support to enable direct SMPT.

<h3>Make Sure You Don't Have Two MTA's Conflicting</h3>A good conflict example would be with a Ubuntu 16.04 setup on certain hosting environments. After going thought your LAMP installation, if you install postfix without doing anything else it may not work. This is because there is already a default MTA setup on the server called <strong>sendmail</strong>. Postfix needs port 25 to be open, you can check this by running command "netstat -ntlp". To kill the sendmail MTA correclty and allow postfix to work, you need to run this command "killall sendmail-mta" and after "service postfix restart"
