<p align="center">
    <img src="./assets/icon.png" alt="Blasp Icon" width="150" height="150"/>
    <p align="center">
        <a href="https://packagist.org/packages/blaspsoft/socialiteplus"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/blaspsoft/socialiteplus"></a>
        <a href="https://packagist.org/packages/blaspsoft/socialiteplus"><img alt="Latest Version" src="https://img.shields.io/packagist/v/blaspsoft/socialiteplus"></a>
        <a href="https://packagist.org/packages/blaspsoft/socialiteplus"><img alt="License" src="https://img.shields.io/packagist/l/blaspsoft/socialiteplus"></a>
    </p>
</p>

# Socialite Plus - Laravel Socialite made even easier

**Socialite Plus** is a Laravel 12 React & Vue Starterkit package that streamlines social login for Google, Facebook, GitHub and LinkedIn.

---

## ✨ Features

- ✅ Predefined Social Login Pages – Ready-to-use authentication pages built with React & Vue.
- 🎯 Seamless OAuth Integration – Supports Google, Facebook, GitHub, and LinkedIn logins.
- ⚙️ Configurable Providers – Enable or disable social logins via a simple config file.
- 🎨 Customizable Button Text & Styles – Personalize login button labels and appearance.
- ⚡ Effortless Setup – Quick configuration using Laravel Socialite.
- 🔄 Full Social Auth Flow – Handles login, registration, and token management.
- 🔐 Secure & Scalable – Built with best practices for authentication and security.
- 🌍 Multi-Framework Support – Works with both React and Vue frontends.
- 📦 Out-of-the-Box Functionality – Reduce development time with pre-built components

---

## 🛠 Requirements

Before installing **Keysmith React**, ensure your environment meets the following requirements:

- PHP **8.0+**
- Laravel **12.x**
- React **19.x** or Vue **3.x**
- Laravel Socialite **5.0**

---

## 🚀 Installation Guide

Follow these simple steps to install and configure Socialite Plus in your Laravel 12 Vue or React starterkit project.

---

1️⃣ Install the Package

Run the following command in your terminal to install the package via Composer:

```bash
composer require blaspsoft/socialiteplus
```

---

2️⃣ Choose Your Frontend Framework

After installation, you need to specify whether you want to use Vue or React. Run one of the following commands:

#### **Vue**

```bash
php artisan socialiteplus:install vue
```

#### **React**

```bash
php artisan socialiteplus:install react
```

This command will generate pre-built authentication components for your chosen frontend.

---

3️⃣ Publish the Configuration File

Run the following command to publish the `config/socialiteplus.php` file:

```bash
php artisan vendor:publish --tag=socialiteplus-config
```

This will allow you to customize social login settings. For changes to take effect you may need to clear the config cache:

```bash
php artisan config:cache
```

---

4️⃣ Add the Middleware to Routes

```php

```

5️⃣ Create OAuth Apps in Social Providers

To enable authentication, you need to register your application with each provider and obtain Client ID and Secret and set the redirect URI:

```
https://your-app.com/auth/social/{provider}/callback
```

---

6️⃣ Set Environment Variables

Update your .env file with the credentials obtained from each provider:

```env
GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT=https://yourapp.com/auth/social/google/callback

FACEBOOK_CLIENT_ID=your-facebook-client-id
FACEBOOK_CLIENT_SECRET=your-facebook-client-secret
FACEBOOK_REDIRECT=https://yourapp.com/auth/social/facebook/callback

GITHUB_CLIENT_ID=your-github-client-id
GITHUB_CLIENT_SECRET=your-github-client-secret
GITHUB_REDIRECT=https://yourapp.com/auth/social/github/callback

LINKEDIN_CLIENT_ID=your-linkedin-client-id
LINKEDIN_CLIENT_SECRET=your-linkedin-client-secret
LINKEDIN_REDIRECT=https://yourapp.com/auth/social/linkedin/callback
```

---

7️⃣ Configure Socialite Plus

Modify the config/socialiteplus.php file to customize settings:

```php
return [
    'button_text' => '{provider}',

    'providers' => [
        'google' => [
            'active' => true,
            'style' => 'bg-red-500 text-white',
            'name' => 'Google',
            'icon' => 'GoogleIcon',
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect' => env('GOOGLE_REDIRECT'),
        ],
        'facebook' => [
            'active' => true,
            'style' => 'bg-blue-500 text-white',
            'name' => 'Facebook',
            'icon' => 'FacebookIcon',
            'client_id' => env('FACEBOOK_CLIENT_ID'),
            'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
            'redirect' => env('FACEBOOK_REDIRECT'),
        ],
        'github' => [
            'active' => true,
            'style' => '',
            'name' => 'GitHub',
            'icon' => 'GithubIcon',
            'client_id' => env('GITHUB_CLIENT_ID'),
            'client_secret' => env('GITHUB_CLIENT_SECRET'),
            'redirect' => env('GITHUB_REDIRECT'),
        ],
        'linkedin' => [
            'active' => true,
            'style' => 'bg-sky-500 text-white',
            'name' => 'LinkedIn',
            'icon' => 'LinkedInIcon',
            'client_id' => env('LINKEDIN_CLIENT_ID'),
            'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
            'redirect' => env('LINKEDIN_REDIRECT'),
        ],
    ],
];

```

---

8️⃣ Update the register and login pages

new pages have been placed in your app, you need to update the controllers to use the new pages.

---

## 🧪 Testing

Keysmith React includes tests in `tests/Feature/ApiToken/`:

Run the tests with:

```bash
php artisan test
```

---

## 🔒 Security

If you discover any **security-related** issues, please email **mike.deeming@blaspsoft.com** instead of using the issue tracker.

---

## 📜 Credits

- [Michael Deeming](https://github.com/deemonic)

---

## 📄 License

This package is licensed under **MIT**. See [LICENSE.md](LICENSE.md) for details.
