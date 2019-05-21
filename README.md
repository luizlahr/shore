# Shore - Responsive Website

## Requirements

1. PHP 7.1.9
2. Composer
3. Git

## Technologies

1. Laravel 5.8
2. Bulma 0.7.4
3. Jquery 3.4.1

## Installation

Clone de system from repository on Github

```bash
git clone https://github.com/luizlahr/shore.git
```

Install dependencies

```bash
composer install
```

## Configuration

Rename the file .env.example, in root folder to **_".env"_** in order to set up the system.

Define the System crypt keyasd

```bash
php artisan key:generate
```

In order to the system can send e-mails, please setup email data on .env file.

```bash
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=476c9434db3b6a
MAIL_PASSWORD=4fb57ff7484666


MAIL_FROM_ADDRESS="noreply@luizlahr.com"
MAIL_FROM_NAME="Luiz Lahr"
EMAIL_TO_CONTACT="contato@luizlahr.com"
```

set App name on .env file.

```bash
APP_NAME="Douglas Beauty Booking"
APP_ENV=local
APP_KEY=base64:NwhdCc7/SBPB4VvHnm9J2WLLg1kz19cp4gRGNC1OnoY=
APP_DEBUG=true
APP_URL=http://localhost
```

## SERVER

To run the application execute the command bellow;

```bash
php artisan serve
```

```bash
## Developer
Luiz Lahr
Contact: +55 19 9 9998 8848
Email: boivl@hotmail.com
```
