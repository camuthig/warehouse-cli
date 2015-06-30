#Warehouse CLI
## Running the Tests
To run the tests first install dependencies:

```
composer install
```
Then run phpunit

```
php vendor/bin/phpunit
```

## Using the application
The application is already built into an executable phar and pointed to the Heroku web service. To use this simply type

```
./waho.phar 
```

### Working with Objects
Each of the four objects has two commands:

* product
* warehouse
* order
* stock

For example:


```
./waho.phar product create <name> <dimensions> <weight>
./waho.phar product list
```

Each command has help text if run without arguments. 

## Working Locally
To test local changes, you can run ./bin/waho instead of using the phar.