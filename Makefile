.PHONY: it
it: cs stan test

.PHONY: coverage
coverage: vendor
	@mkdir \
		-p .build/phpunit/html

	@vendor/bin/phpunit \
		--configuration=tests/Unit \
		--dump-xdebug-filter=.build/phpunit/xdebug-filter.php

	@vendor/bin/phpunit \
		--configuration=tests/Unit \
		--coverage-html=.build/phpunit/html \
		--coverage-clover=.build/phpunit/clover.xml \
		--prepend=.build/phpunit/xdebug-filter.php

.PHONY: cs
cs: vendor
	@mkdir \
		-p .build/php-cs-fixer

	@vendor/bin/php-cs-fixer \
		fix \
			--diff \
			--verbose

.PHONY: stan
stan: vendor
	@mkdir \
		-p .build/phpstan

	@vendor/bin/phpstan \
		analyse \
			--configuration phpstan.neon

.PHONY: test
test: vendor
	@mkdir \
		-p .build/phpunit

	@vendor/bin/phpunit \
		-c tests/Unit

vendor: composer.json composer.lock
	composer validate
	composer install
