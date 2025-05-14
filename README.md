# 📦 Multi-Warehouse Inventory Management API

A backend API built with **Laravel 12** for managing inventory across multiple warehouses in multiple countries.  
Supports products, suppliers, stock transactions, transfers, low stock alerts, scheduled reports, JWT authentication, and Swagger documentation.

---

## 🚀 Features

-   ✅ Country, Warehouse, Product, Supplier management (CRUD)
-   ✅ Inventory & Stock transactions (IN/OUT)
-   ✅ Product transfers between warehouses
-   ✅ Global inventory view (per product)
-   ✅ Low stock detection with scheduled daily email reports
-   ✅ JWT Authentication
-   ✅ Swagger API Documentation
-   ✅ Event-driven low stock notifications
-   ✅ Redis-based product caching (optional)

---

## 📁 Technologies

-   Laravel 12
-   MySQL or PostgreSQL
-   JWT Auth (`tymon/jwt-auth`)
-   Laravel Scheduler
-   Mail Notifications

---

## ⚙️ Setup Instructions

1. **Clone the Repository**

```bash
git clone https://github.com/aahn87piq/inventorysystem.git
cd inventory-api
```
