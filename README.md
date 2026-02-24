# 📦 Inventory Management System (Laravel)

A simple Inventory Management System built with Laravel.
It manages stock, sales, accounting journal entries, and financial reports.

---

# 🚀 Features

✅ Stock Management

* Add stock
* Track current quantity
* Purchase & selling price

✅ Sales Management

* Sell products from stock
* Auto price calculation
* Discount & VAT support
* Paid & Due amount tracking
* Prevent sale if stock is not available

✅ Accounting

* Automatic journal entries for each sale

✅ Financial Report

* Total Sales
* Total Expenses
* Profit
* Date-wise filter

---

# ⚙️ How to Run

1. Clone project

```
git clone <your-repo-link>
cd project-folder
```

2. Install dependencies

```
composer install
```

3. Setup environment

```
cp .env.example .env
php artisan key:generate
```

4. Configure database in `.env`

5. Run migration

```
php artisan migrate
```

6. Start server

```
php artisan serve
```

Open: http://127.0.0.1:8000

---

# 🧮 System Flow

1. Add Stock
2. Create Sale
3. Stock reduces automatically
4. Journal entry created
5. Financial report updates

---

# 🛠️ Technology

* Laravel
* PHP
* MySQL
* Bootstrap
* JavaScript

---
