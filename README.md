## NEWS SYSTEM 

This code in simple News system with register/login method written in plain PHP
without using any kind of framework. 

Only users that have account and are logged in can add new, edit or delete newses. 

Fields for registration are handled by MySQL engine to fill fields of 
`created_at`, `updated_at`. Until News will be edited for the first time field will contain 
*0000-00-00 00:00:00*

On creating a new News MySQL engine is filling fields `created_at`, `updated_at`. 
And when News is edited field `updated_at` is changed from MySQL engine


To test it on please use login:
`test@test.test` and password `test`