.PHONY: install test
install:
	rm -rf vendor
	composer install

test:
	./vendor/bin/phpunit ./test --colors auto