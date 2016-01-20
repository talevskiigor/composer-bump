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

## Step 3: Run the new Artisan Command

	php artisan bump
	
