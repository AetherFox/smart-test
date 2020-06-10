#LogParser

###Description
Test task for Smart Pension

###How to install
Clone this repo
```
$ git clone https://github.com/AetherFox/smart-test.git <project_directory>
```
Go to project directory and run
```
$ composer install
```

###Usage
```
$ php artisan parse:log [<logfile>]
```
See
```
$ php artisan parse:log --help
```
for more details

###Running tests
```
$ php artisan test
```

###Approach description
- Using OOP and SOLID
- Using Laravel framework and its capabilities
- Capability to add new log parser classes by adding services with corresponding tags
- Reads log file in chunks, don't loads all file in memory

###Possible Improvements
- Add sorting and filtering options for output
- Add additional data sources except for files (i.e. sockets)
- Add different output options and formats (i.e. json)
- Test command output, not only its code
