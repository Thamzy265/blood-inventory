# Blood Bank

Blood Bank is a web application for a blood donation service. The application
keeps a record of donors. It also keeps a record of the quantity of each blood
group in stock. Staff use the application to send SMS alerts to donors and to
make monthly PDF reports.

This document is written in Simplified Technical English.

---

## 1. Description

The application has two types of user:

| User type | Function |
|---|---|
| Donor | Registers an account. Sets a profile. Sends an emergency request. Reads the stock levels. |
| Administrator | Reads the dashboard. Changes the stock levels. Sends SMS alerts. Makes reports. Deletes donors. |

### 1.1 Functions

- **Donor registration.** A donor gives a name, an e-mail address, a telephone
  number, a gender, a region and a blood group.
- **Account verification.** The application makes a five-digit code. It sends
  the code by SMS and by e-mail. The donor enters the code to activate the
  account.
- **Blood stock.** The application holds a quantity for each of the eight blood
  groups. The administrator changes each quantity.
- **Emergency request.** A donor sends an emergency request. The application
  writes a record to the `emergency` table. It then sends an SMS to the donors
  who have the same blood group.
- **Collection alert.** The administrator sends an SMS to all donors in one
  region. The SMS gives the place of the blood collection.
- **Messages.** A visitor sends a message from the support page. The
  administrator reads the messages.
- **Monthly report.** The application makes a PDF report for the present month
  or for the last month. The report shows the emergencies and the stock levels.

### 1.2 Technology

| Item | Value |
|---|---|
| Language | PHP 7.1 to 7.4 |
| Database | MySQL or MariaDB |
| Database driver | `mysqli` |
| Front end | Bootstrap 4, jQuery, Chart.js |
| SMS | Twilio SDK (`twilio/sdk` ^5.37) |
| SMS (alternative) | MessageBird (`messagebird/php-rest-api` ^1.16) |
| PDF | mPDF (`mpdf/mpdf` ^8.0) |
| Dependency manager | Composer |

The application does not use a framework. It uses a hand-written
Model-View-Controller structure.

---

## 2. Structure

```
blood-inventory/
├── index.php           Home page for visitors
├── login.php           Donor log-in page
├── admin_login.php     Administrator log-in page
├── register.php        Donor registration page
├── verify.php          Account verification page
├── support.php         Contact page
├── route/
│   └── route.php       Front controller. All forms send data to this file.
├── model/
│   ├── db.php          Database connection. All other models extend this class.
│   ├── register.php    Donor registration
│   ├── login.php       Donor log-in and verification
│   ├── adminLogin.php  Administrator log-in
│   ├── user.php        Password change and account deactivation
│   ├── profile.php     Donor profile
│   ├── Blood.php       Blood stock
│   ├── group.php       Donor queries by blood group and by region
│   ├── emergency.php   Emergency records
│   ├── messages.php    Support messages
│   └── adminUsers.php  Donor administration
├── .env                Your credentials. Not in the repository.
├── .env.example        The list of the keys. Copy it to `.env`.
├── functions/
│   ├── env.php            Reads the file `.env`
│   ├── sessionHelper.php  Session control and access control
│   ├── messages.php       SMS and e-mail transmission
│   └── report.php         PDF report generation
├── views/
│   ├── index.php       View router. The `page` parameter selects the page.
│   ├── components/     Header, footer, navigation bar and side bar
│   └── pages/          Donor pages and administrator pages
├── css/  js/  images/  Static files
├── bloodbank.sql       Database dump
└── composer.json       Dependency list
```

### 2.1 How a request moves through the application

1. The user sends a form to `route/route.php`.
2. `route.php` reads the `$_POST` and `$_GET` keys. It selects one action.
3. `route.php` calls a method of a model class.
4. The model class reads or writes the database.
5. The model class sends the user to a new page with an HTTP redirect.
6. `views/index.php` reads the `page` parameter. It includes the correct page
   file.

`functions/sessionHelper.php` controls the access. The session key `BBlog`
shows that the user has logged in. The session key `admin` shows that the user
is an administrator.

---

## 3. Before you start

Get these items:

- PHP 7.1 to 7.4, with the `mysqli` extension and the `mbstring` extension
- MySQL 5.7 or MariaDB 10.x
- Composer
- Apache with `mod_php`, or PHP-FPM with Nginx
- A Twilio account, if you want to send SMS messages

**Note:** XAMPP, MAMP or Laragon give you Apache, PHP and MySQL in one
installation. This is the easiest method.

---

## 4. Installation

> **CAUTION:** The application contains fixed links that start with `/blood`.
> You must install the application at the URL path `/blood`. If you use a
> different path, the redirects fail.

### 4.1 Put the files in the web root

Copy the project folder into the web root of the server. Give the folder the
name `blood`.

| Server | Web root |
|---|---|
| XAMPP (Windows) | `C:\xampp\htdocs\blood` |
| XAMPP (macOS) | `/Applications/XAMPP/htdocs/blood` |
| MAMP | `/Applications/MAMP/htdocs/blood` |
| Linux, Apache | `/var/www/html/blood` |

### 4.2 Install the dependencies

The `vendor/` folder is not in the repository. Make the folder with Composer.

```bash
cd blood
composer install
```

### 4.3 Make the database

1. Start MySQL.
2. Make a database with the name `bloodbank`.

   ```sql
   CREATE DATABASE bloodbank CHARACTER SET utf8mb4;
   ```

3. Import the dump file.

   ```bash
   mysql -u root -p bloodbank < bloodbank.sql
   ```

> **CAUTION:** The dump file is not complete. The `users` table in the dump has
> only four columns. The PHP code needs more columns. Do the steps in section
> 4.4 before you use the application.

### 4.4 Correct the `users` table

Run this SQL statement to add the columns that the code needs:

```sql
ALTER TABLE `users`
  ADD COLUMN `email`    VARCHAR(128) NOT NULL,
  ADD COLUMN `f_name`   VARCHAR(250) NOT NULL,
  ADD COLUMN `l_name`   VARCHAR(250) NOT NULL,
  ADD COLUMN `gender`   VARCHAR(9)   NOT NULL,
  ADD COLUMN `adress`   INT(11)      NOT NULL,
  ADD COLUMN `blood_id` INT(11)      NOT NULL,
  ADD COLUMN `code`     VARCHAR(10)  NOT NULL,
  ADD COLUMN `status`   VARCHAR(10)  NOT NULL DEFAULT 'false';
```

**Note:** The column name `adress` has one `d`. This spelling is in the PHP
code. Do not correct the spelling.

### 4.5 Add the regions

The `region` table is empty in the dump. Add the three regions:

```sql
INSERT INTO `region` (`id`, `region`) VALUES
  (1, 'Northern Region'),
  (2, 'Central Region'),
  (3, 'Southern Region');
```

### 4.6 Set the credentials

The application reads all credentials from a file with the name `.env`. This
file is in the root folder of the project. The file is not in the repository.

1. Copy the example file:

   ```bash
   cp .env.example .env
   ```

2. Open the file `.env`. Write your own values.

```ini
# --- Database ---
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=bloodbank
DB_USERNAME=root
DB_PASSWORD=

# --- Twilio (SMS) ---
TWILIO_ACCOUNT_SID=
TWILIO_AUTH_TOKEN=
TWILIO_FROM_NUMBER=
```

> **CAUTION:** Do not add the file `.env` to the repository. The file
> `.gitignore` contains the name `.env`. Keep this line.

**Note:** The file `functions/env.php` reads the file `.env`. If a key is
absent or empty, the application uses a default value. The defaults are in
`model/db.php`.

### 4.7 Make an administrator account

The dump contains one administrator record. You do not know its password.
Set a new password with this statement:

```sql
UPDATE `admin` SET `password` = MD5('your-new-password') WHERE `username` = 'will';
```

**Note:** The application uses MD5 for all passwords. MD5 is not safe. Read
section 7.

### 4.8 Set the SMS credentials

Write the values of your Twilio account into the file `.env`:

```ini
TWILIO_ACCOUNT_SID=ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
TWILIO_AUTH_TOKEN=your-auth-token
TWILIO_FROM_NUMBER=+15550000000
```

Get the SID and the token from the console at `www.twilio.com/console`. The
from number must be a telephone number of your Twilio account.

**Note:** If you leave these three keys empty, the application does not send an
SMS message. It writes a line to the error log instead. The other functions
continue to operate.

### 4.9 Start the application

Open a web browser. Go to one of these addresses:

| Page | Address |
|---|---|
| Home | `http://localhost/blood/index.php` |
| Donor log-in | `http://localhost/blood/login.php` |
| Donor registration | `http://localhost/blood/register.php` |
| Administrator log-in | `http://localhost/blood/admin_login.php` |

---

## 5. Database

The database has the name `bloodbank`. It contains these tables:

| Table | Content |
|---|---|
| `users` | Donor accounts and log-in data |
| `admin` | Administrator accounts |
| `profiles` | Extra donor data |
| `blood_group` | The eight blood groups and the quantity of each group |
| `region` | The regions of the country |
| `emergency` | A record of each emergency request |
| `messages` | Messages from the support page |
| `report` | A record of each report |

The tables `migrations` and `password_resets` are not used. They are left over
from a Laravel application.

---

## 6. Known problems

These problems are in the code. Read this list before you change the code.

1. **Fixed URL path.** The redirects use the path `/blood`. The application
   works at this path only.
2. **The database dump is not complete.** Section 4.4 and section 4.5 give the
   correction.
3. **The SMS transmission is disabled.** In `functions/messages.php`, the loops
   that call `twiSms()` are in comments. Remove the comment marks to send SMS
   messages. You must also set the three `TWILIO_` keys in the file `.env`.
4. **The MessageBird library is not used.** The `composer.json` file lists the
   library, but no code calls it.
5. **The region test in the report is incorrect.** In `functions/report.php`,
   the second test reads `$user['blood']` but it must read `$user['region']`.
6. **Two dump files.** The file `bloodbank (1).sql` is an earlier and smaller
   copy of `bloodbank.sql`. Use `bloodbank.sql`.

### 6.1 Corrected defects

These defects were in the code. They are now corrected.

- **The log-in query had an operator error.** The query in `model/login.php`
  read `username = ? OR phone_number = ? AND password = ?`. `AND` has a higher
  priority than `OR`. A user could log in with a correct user name and an
  incorrect password. The query now has brackets around the `OR` condition.
- **The account status test was incorrect.** The method `logTbl()` read
  `if ($result['status'])`. The column holds the string `'false'` before the
  verification. PHP reads the string `'false'` as true. A user could therefore
  log in without a verification. The test now compares the value with `'1'`.
- **The Twilio credentials were in the code.** They are now in the file `.env`.
- **The SMS receiver was a fixed number.** The method `twiSms()` sent each
  message to one fixed telephone number. It ignored its own `$numbers`
  parameter. The method now sends the message to `$numbers`.

---

## 7. Security

> **WARNING:** Do not put this application on a public server. The application
> has serious security defects.

| Defect | Description |
|---|---|
| SQL injection | All queries put variables directly into the SQL text. The code does not use prepared statements. |
| Weak password hash | The code uses MD5 with no salt. |
| ~~Credentials in the code~~ | Corrected. All credentials are now in the file `.env`. |
| No CSRF protection | The forms have no token. |
| Open verification code | The verification code is a five-digit number with no time limit and no attempt limit. |

To make the application safe, do these tasks:

1. Change all queries to prepared statements.
2. Change MD5 to `password_hash()` and `password_verify()`.
3. ~~Move all credentials to environment variables.~~ Done. See section 4.6.
4. Add a CSRF token to each form.
5. Cancel the Twilio credentials of the earlier commits. Git keeps the history.
   The old SID and the old token are still in the commit `9b5f917`.

---

## 8. Status

This project is complete but it is not maintained. The repository has one
commit: "Initializing blood bank project". The project is an academic work.
