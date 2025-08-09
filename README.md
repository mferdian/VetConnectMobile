# VetConnectMobile

[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?logo=laravel)](https://laravel.com)
[![Flutter](https://img.shields.io/badge/Flutter-3.x-02569B?logo=flutter)](https://flutter.dev)

**VetConnectMobile** is a comprehensive veterinary management platform that combines a robust backend API with an intuitive mobile application. Built as a monorepo architecture, it enables seamless development, testing, and deployment of both components in a unified environment.

## Architecture

This project follows a monorepo structure that houses both the backend API and mobile application:

```
VetConnectMobile/
├── VetConnectBackend/     # Laravel-based REST API
│   ├── app/
│   ├── database/
│   ├── routes/
│   └── ...
└── VetConnectFlutter/     # Flutter mobile application
    ├── lib/
    ├── android/
    ├── ios/
    └── ...
```

## 🛠️ Tech Stack

| Component | Technology | Version |
|-----------|------------|---------|
| **Backend API** | [Laravel](https://laravel.com/) | 10.x |
| **Database** | [MySQL](https://www.mysql.com/) | 8.0+ |
| **Mobile App** | [Flutter](https://flutter.dev/) | 3.x |
| **Language** | PHP, Dart | 11.x &  3.29.2 |

## 🚀 Quick Start

### Prerequisites

Before you begin, ensure you have the following installed:

- **PHP** 8.1 or higher
- **Composer** 2.x
- **MySQL** 8.0+
- **Flutter SDK** 3.x
- **Git**

### Installation

1. **Clone the repository**
   ```bash
   # Using HTTPS
   git clone https://github.com/username/VetConnectMobile.git
   
   # Or using SSH
   git clone git@github.com:username/VetConnectMobile.git
   
   cd VetConnectMobile
   ```

## ⚙️ Setup Guide

### 🔧 Backend Setup (Laravel)

Navigate to the backend directory and set up the Laravel application:

```bash
cd VetConnectBackend

# Install PHP dependencies
composer install

# Create environment configuration
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure your database in .env file
# Example:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=vetconnect
# DB_USERNAME=root
# DB_PASSWORD=your_password

# Run database migrations and seed data
php artisan migrate --seed

# Start the development server
php artisan serve
```

The API will be available at `http://localhost:8000`

### 📱 Mobile App Setup (Flutter)

Navigate to the Flutter directory and set up the mobile application:

```bash
cd ../VetConnectFlutter

# Install Flutter dependencies
flutter pub get

# Verify Flutter installation
flutter doctor

# Run the application
flutter run
```

Choose your target device (iOS Simulator, Android Emulator, or physical device) when prompted.

## 🧪 Testing

### Backend Testing
```bash
cd VetConnectBackend

# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage
```

### Mobile App Testing
```bash
cd VetConnectFlutter

# Run unit tests
flutter test

# Run integration tests
flutter test integration_test/
```

## 🚢 Deployment

### Backend Deployment
```bash
# Production optimizations
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Mobile App Deployment
```bash
# Build for Android
flutter build apk --release

# Build for iOS
flutter build ios --release
```

## 🤝 Contributing

We welcome contributions from the community! Please follow these guidelines:

### Development Workflow

1. **Fork** this repository
2. **Create** a feature branch from `develop`
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. **Commit** your changes using [Conventional Commits](https://www.conventionalcommits.org/)
   ```bash
   git commit -m "feat: add user authentication endpoint"
   ```
4. **Push** your branch and create a **Pull Request**

### Code Style

- **PHP**: Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards
- **Dart**: Follow [Dart Style Guide](https://dart.dev/guides/language/effective-dart/style)

### Commit Convention

We use [Conventional Commits](https://www.conventionalcommits.org/) for clear and consistent commit messages:

- `feat:` New features
- `fix:` Bug fixes
- `docs:` Documentation updates
- `style:` Code style changes
- `refactor:` Code refactoring
- `test:` Test additions or updates

## Issue Reporting

Found a bug or have a suggestion? Please [create an issue](https://github.com/username/VetConnectMobile/issues) with:

- Clear description of the problem
- Steps to reproduce
- Expected vs actual behavior
- Screenshots (if applicable)

## 📄 License

This project is licensed under the [MIT License](LICENSE) - see the LICENSE file for details.

## 🙏 Acknowledgments

- Laravel community for the robust backend framework
- Flutter team for the excellent mobile development toolkit
- All contributors who help improve this project

---

<div align="center">
  <p> Made By</p>
  <p> Maulana, Gunawan, Dimas </p>
  <p>
    <a href="https://github.com/username/VetConnectMobile/stargazers">⭐ Star this repo</a>
    •
    <a href="https://github.com/username/VetConnectMobile/issues">Report Bug</a>
    •
    <a href="https://github.com/username/VetConnectMobile/issues">Request Feature</a>
  </p>
</div>
