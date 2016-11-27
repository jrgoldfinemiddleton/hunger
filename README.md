Food Bank Wish List
===================

This is a project for Oregon State University's CS 361: Software Engineering I.  The contributors are Emiliano Colon, Andrew Elmas, Jason Goldfine-Middleton, Allister Laurel, and Kyle Schlatter.

This web application uses the [Symfony](https://symfony.com) framework.

You can build this project locally by meeting a few preconditions.  You must have the following software installed:
* PHP 5.5 (with certain extensions)
* VirtualBox 5
* Vagrant
* Composer

*Note:* Symfony will be installed and handled by Composer.  You will need to properly set the values of parameters used by Symfony as `parameters.yml` is not included in the repository.


Installation Instructions for macOS/Mac OS X
--------------------------------------------

There are many ways to install PHP 5.5 on your system, but perhaps the most convenient is to use Homebrew.  To use Homebrew, you will want to have Xcode/Command Line Tools.

Run the following command in the terminal:
```
xcode-select --install
```

Follow the instructions [here](http://brew.sh) to install Homebrew, then at the terminal run the following:

```bash
brew update
brew tap homebrew/homebrew-php
brew install php55
brew install composer
```

Use Homebrew to install any PHP extensions you may need.  Run

```bash
brew search php55
```

to see which extensions are available.

In the terminal, run:
```bash
php --ini
```

This will show you the location of your `php.ini` file.  
Set your timezone in the `php.ini` configuration file.

```
date.timezone = "America/Los_Angeles"
```

Use the correct [valid timezone](https://secure.php.net/manual/en/timezones.php) for you of course.


Lastly, you will want to install [VirtualBox](https://www.virtualbox.org/wiki/Downloads) and [Vagrant](https://www.vagrantup.com/downloads.html).


Installation Instructions for Windows
-------------------------------------

*Warning: I'm more familiar with macOS and Linux, so you might find a better way to obtain these prerequisites.*

I highly recommend installing [GitHub Desktop](https://desktop.github.com).  This will give you the Git Shell, which makes doing Git work a lot easier in Windows.

Next, clone the repository as normal, and then move on to installing PHP 5.5.

You can download it [here](http://windows.php.net/downloads/releases/archives/php-5.5.37-Win32-VC11-x64.zip).
In order for it to work, you should also install [Visual C++ Redistributable for Visual Studio 2012](http://www.microsoft.com/en-us/download/details.aspx?id=30679).

Unzip the PHP archive into `C:\php` or some directory of your choosing.  Once you've done this, navigate to that folder and make a copy of the file `php.ini-development` called `php.ini` and store it there as well.  You're going to want to open it up and set these lines:

```
extension_dir:"C:\YOUR\DIRECTORY\HERE\ext"
date.timezone = "America/Los_Angeles"
```

Use the correct [valid timezone](https://secure.php.net/manual/en/timezones.php) for you of course.


Also uncomment the lines for any extensions that might be relevant.  We'll figure these out as well go, so this step isn't as important.  The purpose of this file is to set PHP's configuration and as you can see, it's very flexible and modular.

The last thing you'll need to do is add this PHP directory to your `Path` environment variable.  Please look online for how to add a new directory to your `Path` for your particular version of Windows.

Do not worry about installing Apache.  We're going to let the VM host the local web server instead of Windows.  We simply want to install PHP so we can develop in Windows IDEs.

Next, install [VirtualBox](https://www.virtualbox.org/wiki/Downloads) and [Vagrant](https://www.vagrantup.com/downloads.html).

Install [Composer](https://getcomposer.org/doc/00-intro.md).  As with your PHP directory, you may need to add another folder to your `Path` environment variable so that you can run `composer` inside the Git Shell.

Restart Windows to ensure that all your changes are loaded.


Setup for the Development Environment
-------------------------------------

Great, now you have installed the prerequisites!  Let's get started.

Before you run the next command, contact Jason for the `parameters.yml` file.  This will give you the correct parameter values to enter when prompted.

In the root directory of the cloned repository, run the following command.

```bash
composer install
```

This will install the Symfony and other component files not under version control.  It uses the `composer.json` file to figure out which components and versions to install.  Technically, `composer install` looks at the `composer.lock` file as well to figure out exactly which versions to install, but if you get errors stating that there is a mismatch between the two files, you can run

```bash
composer update
```

to update your `composer.lock` file or even just delete it and re-run `composer install`.  I won't get into the details, but you can find out more [here](https://getcomposer.org/doc/01-basic-usage.md).  Now Symfony is completely installed.

*Note:* There is currently a [bug](https://github.com/Varying-Vagrant-Vagrants/VVV/issues/354) in Vagrant for macOS/Mac OS X that prevents `vagrant up` from working correctly.  Please run `sudo rm /opt/vagrant/embedded/bin/curl` if you are running into an error on the next command.

You'll want to `cd bin && vagrant up`.  This will build you an Ubuntu Server 14.04 VM and configure the server.

The very last step will be to add an entry to your `hosts` file:

**macOS/Mac OS X:**
```bash
sudo vi /private/etc/hosts
```

Add the following entry:
```
192.168.10.10 hunger.vagrant
```

**Windows:**

Run Notepad as an administrator and open the file `C:\Windows\System32\Drivers\etc\hosts` and add the following line:
```
192.168.10.10 hunger.vagrant
```

[Clear your local DNS cache.](https://coolestguidesontheplanet.com/clear-the-local-dns-cache-in-osx)

Wanna see something cool?  In your browser, navigate to <http://hunger.vagrant>.

**TODO:** Set up SSL/HTTPS.

Awesome, you're good to go!  Might want to install [PhpStorm](https://www.jetbrains.com/phpstorm) or some other IDE to do your development, but you are also welcome to use a CLI editor.

Symfony Configuration
---------------------

The dev environment does not allow remote access to the web server by default.  What this means in practice is that you will not be able to access your routes from your host OS using the VM's web server unless you make a change to the `web/app_dev.php` file.  A workaround (probably not the best) we have used is to comment out the following lines in that file:

```php
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !(in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) || php_sapi_name() === 'cli-server')
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}
```

Now you should be able to access your routes like so: `http://hunger.vagrant/app_dev.php/list`
where `list` is a route.

If you want to access your routes without `app_dev.php` in the URL, you should first understand that you'll be viewing production pages.  Run `php bin/console cache:clear --env=prod --no-debug` in the terminal to clear your production cache.  Now you should be able to access `http://hunger.vagrant/list` in your browser.

You can also get around all of this by simply starting your local PHP built-in web server and navigating to `http://localhost:8000/list` instead.

To start the PHP web server: `php bin/console server:start`
To stop the PHP web server: `php bin/console server:stop`

Don't forget to reload any code changes with `php bin/console cache:clear`.

MySQL Server Configuration
--------------------------

Execute the following commands: `cd bin && vagrant ssh`

Now you're inside the VM.  We need to tell MySQL server to allow access from outside the VM.
In the `/etc/mysql/my.cnf` file we need to update a few lines.  You'll need to use `sudo` to edit this file.

Find the line with `bind-address` in it.  This should be under the `[mysqld]` section.  Uncomment it and update it to:
```
bind-address = 0.0.0.0
```

Add the following two lines to the same `[mysqld]` section:
```
collation-server     = utf8mb4_general_ci # Replaces utf8_general_ci
character-set-server = utf8mb4            # Replaces utf8
```

Then from the command line, restart the MySQL server.
```bash
sudo service mysql restart
```

You can now log out of the VM the same way you'd log out of a remote Linux server.