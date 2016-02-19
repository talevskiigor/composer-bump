[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/talevskiigor/composer-bump)
[![Total Downloads](https://poser.pugx.org/talevskiigor/composer-bump/d/total.svg)](https://packagist.org/packages/talevskiigor/composer-bump)
[![Latest Stable Version](https://poser.pugx.org/talevskiigor/composer-bump/v/stable.svg)](https://packagist.org/packages/talevskiigor/composer-bump)
[![Latest Unstable Version](https://poser.pugx.org/talevskiigor/composer-bump/v/unstable.svg)](https://packagist.org/packages/talevskiigor/composer-bump)
[![License](https://poser.pugx.org/talevskiigor/composer-bump/license.svg)](https://packagist.org/packages/talevskiigor/composer-bump)

# Description

Laravel Artisan command to automatically and easy bump composer.json version information.

Also has nice Facade to be used in about page or similar where you need to show version of your application.

For more information about versioning please visit [http://semver.org/](http://semver.org/) 

Given a version number MAJOR.MINOR.PATCH, increment the:  

 * MAJOR version when you make incompatible API changes,  
 * MINOR version when you add functionality in a backwards-compatible manner, and  
 * PATCH version when you make backwards-compatible bug fixes.  

## Install

### Step 1: Install through Composer

	composer require talevskiigor/composer-bump

or if you prefer develop version:

		composer require talevskiigor/composer-bump=dev-develop

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



# Usage 
### List of all commands:


  `php artisan bump:major`          Bump MAJOR version (MAJOR.minor.patch => verison 1.0.0) 

  `php artisan bump:minor`          Bump MINOR version (major.MINOR.patch => verison 0.1.0) 

  `php artisan bump:patch`          Increments PATCH version (major.minor.PATCH => verison 0.0.1) 


### Using Facade support:

	return ComposerBump::getVersion();

## Contributing

Add unit tests for any new or changed functionality. Lint and test your code using [PHPUnit](https://phpunit.de/).

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request

## License
Copyright (c) MIT license.	
