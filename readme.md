#Description




# Install

## Step 1: Install through Composer

	composer require talevskiigor/composer-bump

or if you prefer develop version:

		composer require talevskiigor/composer-bump=dev-develop

## Step 2: Update `config/app.php` and insert the folowing line in Service Provider	

	Talevskiigor\ComposerBump\ComposerBumpServiceProvider::class,


If you want to use this package for only local development, you don't need to update `config/app.php`. Instead, you can update provider `app/Providers/AppServiceProvider.php`, for example:

	public function register()
	{
	    if ($this->app->environment() == 'local') {
	        $this->app->register('Talevskiigor\ComposerBump\ComposerBumpServiceProvider');
	    }
	}

## Step 3: Run the new Artisan Commands

	`php artisan bump` - this is alias of `bump:patch`



### List of all commands:


  `php artisan bump:major`          Bump MAJOR version (MAJOR.minor.patch => verison 1.0.0)
  `php artisan bump:minor`          Bump MINOR version (major.MINOR.patch => verison 0.1.0)
  `php artisan bump:patch`          Increments PATCH version (major.minor.PATCH => verison 0.0.1)

	
