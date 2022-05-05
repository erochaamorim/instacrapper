all: composer_install test

composer_install:
	composer install

test: example_1 example_message

example_message:
	php examples/message.php

example_1:
	php examples/example_1.php
