# Smart Wallet - Digital Money Transfer System

Smart Wallet is a secure and user-friendly digital wallet application built with Laravel that allows users to manage their money and make instant transfers to other users.


## Features

- 🔒 **Secure Authentication**
  - User registration and login
  - Email verification
  - Password reset functionality
  - Change password option

- 💰 **Wallet Management**
  - View current balance
  - Real-time balance updates
  - Transaction history
  - Transfer money to other users

- 📱 **User-Friendly Interface**
  - Clean and modern design
  - Mobile responsive
  - Easy navigation
  - Instant notifications

- 📊 **Transaction Features**
  - View recent transactions
  - Detailed transaction history
  - Transaction type indicators (Sent/Received)
  - Transaction summary statistics

## Technology Stack

- **Framework**: Laravel 12.16.0
- **PHP Version**: 8.4.5
- **Database**: MySQL
- **Frontend**: 
  - Bootstrap 5
  - jQuery
  - Font Awesome
- **Email**: PHPMailer
- **Authentication**: Laravel's built-in auth with email verification

## Installation

1. Clone the repository
```bash
git clone https://github.com/yourusername/smart-wallet.git
cd smart-wallet
```

2. Install dependencies
```bash
composer install
npm install
```

3. Create and configure .env file
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure your database in .env
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smart_wallet
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Configure email settings in .env
```env
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourapp.com
MAIL_FROM_NAME="${APP_NAME}"
```

6. Run migrations
```bash
php artisan migrate
```

7. Start the development server
```bash
php artisan serve
```

## Usage

1. Register a new account
2. Verify your email address
3. Log in to your account
4. Start making transfers to other users using their phone numbers
5. View your transaction history
6. Monitor your wallet balance

## Security Features

- CSRF protection
- SQL injection prevention
- XSS protection
- Secure password hashing
- Email verification
- Rate limiting on sensitive routes
- Database transaction handling

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Laravel Team for the amazing framework
- Bootstrap Team for the frontend framework
- PHPMailer for email handling
- All contributors who help to make this project better

## Support

For support, email your-email@example.com or create an issue in the repository.

## Roadmap

- [ ] Add multiple currency support
- [ ] Implement two-factor authentication
- [ ] Add QR code for easy transfers
- [ ] Integrate payment gateways
- [ ] Add transaction export feature
- [ ] Implement wallet top-up feature