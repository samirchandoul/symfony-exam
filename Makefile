install:
	composer install
	php bin/console doc:data:create
	php bin/console doc:mig:mig
	php bin/console doc:fix:load 