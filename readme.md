[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/talevskiigor/composer-bump)
[![Total Downloads](https://poser.pugx.org/talevskiigor/composer-bump/d/total.svg)](https://packagist.org/packages/talevskiigor/composer-bump)
[![Latest Stable Version](https://poser.pugx.org/talevskiigor/composer-bump/v/stable.svg)](https://packagist.org/packages/talevskiigor/composer-bump)
[![Latest Unstable Version](https://poser.pugx.org/talevskiigor/composer-bump/v/unstable.svg)](https://packagist.org/packages/talevskiigor/composer-bump)
[![License](https://poser.pugx.org/talevskiigor/composer-bump/license.svg)](https://packagist.org/packages/talevskiigor/composer-bump)

# Description

Laravel Bump is a package that allows you to easy change your version of your application or package in composer.json file through an Artisan command.

Pretend you have an application or package that you would like to ensure has the right version information in composer.json, you can run `php artisan bump` to get automatically increase version information.

### Example output

    unknown@Dell-Studio-1747:~/Code/ComposerBump$ php artisan bump
    Bump from: 0.0.1 to 0.0.2
    unknown@Dell-Studio-1747:~/Code/ComposerBump$

Also has nice Facade to be used in about page or similar where you need to show your application or package version to the customer.

For more information about versioning please visit [http://semver.org/](http://semver.org/) 

Given a version number MAJOR.MINOR.PATCH, increment the:  

 * MAJOR version when you make incompatible API changes,  
 * MINOR version when you add functionality in a backwards-compatible manner, and  
 * PATCH version when you make backwards-compatible bug fixes.  


# Usage
### List of all commands:

  `php artisan bump:patch`          Increments PATCH version (major.minor.PATCH => verison 0.0.1)

Example output: `Bump from: 0.0.1 to 0.0.2`

  `php artisan bump:minor`          Bump MINOR version (major.MINOR.patch => verison 0.1.0)

Example output: `Bump from: 0.0.2 to 0.1.0`

  `php artisan bump:major`          Bump MAJOR version (MAJOR.minor.patch => verison 1.0.0)

Example output: `Bump from: 0.1.0 to 1.0.0`


### Using Facade support:
In your controller you can easy get and return version of your application or package
	return ComposerBump::getVersion();

## Install

### Step 1: Install through Composer

	composer require talevskiigor/composer-bump


### Step 2: Update `config/app.php` and insert the folowing line in Service Provider	

	Talevskiigor\ComposerBump\ComposerBumpServiceProvider::class,

### Step 3 (optional): Add  Facade support

	'ComposerBump'=>Talevskiigor\ComposerBump\Facades\ComposerBump::class,

If you want to use this package for only local development, you don't need to update `config/app.php`. Instead, you can update provider `app/Providers/AppServiceProvider.php`, for example:

	public function register()
	{
	    if ($this->app->environment() == 'local') {
	        $this->app->register('Talevskiigor\ComposerBump\ComposerBumpServiceProvider');
	    }
	}

### Step 4: Run the new Artisan Commands

	`php artisan bump` - this is alias of `bump:patch`


## Nice to know

Package will make backup copy of you composer.json file on each use, so you can easy do undo on changes, simple use undo command as:

    `php artisan bump:undo`

Example output:

    !!! WARNING !!!!!! WARNING !!!!!! WARNING !!!
        This will replace content of: composer.json file with content from file: composer.json-backup   !!!

     Are you suere? [y|N] (yes/no) [no]:
     > yes

    Restored file: composer.json-backup into file: composer.json
    unknown@Dell-Studio-1747:~/Code/ComposerBump$



## Contributing

Add unit tests for any new or changed functionality. Lint and test your code using [PHPUnit](https://phpunit.de/).

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request

## License
Copyright (c) MIT license.	
