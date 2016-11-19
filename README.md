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
brew install php55 composer
```

Use Homebrew to install any PHP extensions you may need.  Run

```bash
brew search php55
```

to see which extensions are available.

Lastly, you will want to install [VirtualBox](https://www.virtualbox.org/wiki/Downloads) and [Vagrant](https://www.vagrantup.com/downloads.html).


Installation Instructions for Windows
-------------------------------------

*Warning: I'm more familiar with macOS and Linux, so you might find a better way to obtain these prerequisites.*

I highly recommend installing [GitHub Desktop](https://desktop.github.com).  This will give you the Git Shell, which makes doing Git work a lot easier in Windows.

Next, clone the repository as normal, and then move on to installing PHP 5.5.

You can download it [here](http://windows.php.net/downloads/releases/archives/php-5.5.37-Win32-VC11-x64.zip).
In order for it to work, you should also install [Visual C++ Redistributable for Visual Studio 2012](http://www.microsoft.com/en-us/download/details.aspx?id=30679).

Unzip the PHP archive into `C:\php` or some directory of your choosing.  Once you've done this, navigate to that folder and make a copy of the file `php.ini-development` called `php.ini` and store it there as well.  You're going to want to open it up and set this line:

```
extension_dir:"C:\YOUR\DIRECTORY\HERE\ext"
```

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

to update your `composer.lock` file or even just delete it and re-run `composer install`.  I won't get into the details, but you can find out more [here](https://getcomposer.org/doc/01-basic-usage.md).

Now that Symfony is completely installed, you'll want to `cd bin && vagrant up`.  This will build you an Ubuntu Server 14.04 VM and configure the server.

The very last step will be to add an entry to your `hosts` file:

**macOS/Mac OS X:**
```bash
sudo echo "192.168.10.10 hunger.vagrant" >> /etc/hosts
```

**Windows:**

Run Notepad as an administrator and open the file `C:\Windows\System32\Drivers\etc\hosts` and add the following line:
```
192.168.10.10 hunger.vagrant
```

Wanna see something cool?  In your browser, navigate to <http://hunger.vagrant>.

**TODO:** Set up SSL/HTTPS.

Awesome, you're good to go!  Might want to install [PhpStorm](https://www.jetbrains.com/phpstorm) or some other IDE to do your development, but you are also welcome to use a CLI editor.
