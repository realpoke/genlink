# Project Template Guide

Welcome to the Tallest template repository! This template is designed to help you kick-start your own projects based on my setup.

TALL based template to make a website, including FilamentPHP as an admin panel.

**TailwindCSS, AlpineJS, Laravel, Livewire, FilamentPHP**

## Getting Started

To use this template and create your own project, follow these steps:

1. Click the "Use this template" button at the top of the repository. You'll be prompted to create a new repository based on this template.

2. Choose a name for your new repository and customize the repository details as needed.

3. Clone your newly created repository to your local machine using Git:

   ```sh
   git clone https://github.com/your-username/your-repository.git
   ```
4. Navigate to the project directory:
    ```sh
    cd your-repository
    ```
5. Customize the project files, configuration, and content according to your needs. You can modify or add new files, update the README, and configure any settings.

6. Commit your changes:
    ```sh
    git add .
    git commit -m "Initial customization"
    git push origin main
    ```

7. Start developing your project! You're now ready to build upon the template and create your unique application.

## Programming
This is a quick start guide!

### Software
* PHP
* Composer
* Yarn / NPM
* A database
* GIT

### Databases
MariaDB 10.3+, MySQL 5.7+, PostgreSQL 10.0+, SQLite 3.8.8+, SQL Server 2017+

### Setup
After doing the following steps, you should be setup and ready to develop locally.
1. Download the repo locally.
2. Copy the `.env.example` into `.env`
3. Fill in the `.env` file so that it fits your local development environment.
4. Make sure to link the storage to public using `php artisan storage:link`.
5. Get node packages with either `yarn` or the NPM equivalent.
6. Run composer with `composer install` to set up all PHP packages
7. Make sure your database is running.
8. Run database migrations with `php artisan migrate`.
9. Start your website `php artisan serve`, and go to the URL shown.

## Tallest documentation

Here you find the documentation resources for the Tallest stack.

**TailwindCSS, AlpineJS, Laravel, Livewire, FilamentPHP**

1. **Tailwind CSS:** _v3_
   - [Official Documentation](https://tailwindcss.com/docs)
   - [Tailwind CSS GitHub Repository](https://github.com/tailwindcss/tailwindcss)

2. **Alpine.js:** _v3_
   - [Official Documentation](https://alpinejs.dev/start-here)
   - [Alpine.js GitHub Repository](https://github.com/alpinejs/alpine)

3. **Laravel:** _v10_
   - [Official Documentation](https://laravel.com/docs)
   - [Laravel GitHub Repository](https://github.com/laravel/laravel)

4. **Livewire:** _v3_
   - [Official Documentation](https://livewire.laravel.com/docs/)
   - [Livewire GitHub Repository](https://github.com/livewire/livewire)

5. **FilamentPHP:** _v3_
   - [Official Documentation](https://filamentphp.com/docs)
   - [FilamentPHP GitHub Repository](https://github.com/filamentphp/filament)

These resources provide comprehensive guides, tutorials, and references for each technology in the Tallest stack. Feel free to explore and leverage these tools to build powerful and dynamic web applications.

## Feedback and Support

If you encounter any issues or have questions, feel free to open an [issue](https://github.com/realpoke/tallest/issues) on this repository.

I hope this template helps you get started on your project. Happy coding!

## License

This project is licensed under the [MIT license](https://opensource.org/licenses/MIT) - see the LICENSE file for details.
