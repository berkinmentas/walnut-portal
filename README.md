# News Dashboard

A web-based dashboard built with Laravel 10 for managing and displaying news articles.

## Technologies Used
- **Laravel 10**: PHP web application framework
- **PHP 8.3**: Server-side scripting language
- **Vite**: Modern frontend build tool
- **Bootstrap**: CSS framework
- **jQuery**: JavaScript library
- **SweetAlert2**: Alert library

## Requirements
- PHP 8.3 or higher
- Node.js and npm
- Composer
- Docker and Docker Compose (for deployment)

## Local Development Setup

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install Node.js dependencies:
   ```bash
   npm install
   ```

4. Set up environment variables:
   ```bash
   cp .env.example .env
   ```
   Configure the `.env` file with your settings.

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Run migrations:
   ```bash
   php artisan migrate
   ```

7. Start the development server:
   ```bash
   php artisan serve --host=0.0.0.0 --port=8000
   ```

8. In a separate terminal, start Vite:
   ```bash
   npm run dev
   ```

## API Authentication

The API uses key-based authentication. Include the `X-API-KEY` header in your requests:

```http
X-API-KEY: your_api_key_here
```

Configure your API key in the `.env` file:
```env
API_KEY=your_api_key_here
```

## AWS EC2 Deployment

### Prerequisites
- AWS EC2 instance running Ubuntu 22.04 LTS
- Domain name (optional)

### Deployment Steps

1. Connect to your EC2 instance:
   ```bash
   ssh -i your-key.pem ubuntu@your-ec2-ip
   ```

2. Install required software:
   ```bash
   # Update system
   sudo apt update && sudo apt upgrade -y

   # Install Docker and Docker Compose
   sudo apt install docker.io docker-compose -y
   sudo systemctl enable docker
   sudo usermod -aG docker ubuntu
   ```

3. Clone the repository:
   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```

4. Create environment file:
   ```bash
   cp .env.example .env
   # Edit .env with production settings
   ```

5. Build and start the containers:
   ```bash
   docker-compose up -d --build
   ```

6. Set up Laravel application:
   ```bash
   docker-compose exec app php artisan key:generate
   docker-compose exec app php artisan migrate
   docker-compose exec app php artisan storage:link
   ```

7. Set proper permissions:
   ```bash
   sudo chown -R www-data:www-data storage bootstrap/cache
   ```

### SSL Configuration (Optional)

1. Install Certbot:
   ```bash
   sudo apt install certbot python3-certbot-nginx -y
   ```

2. Obtain SSL certificate:
   ```bash
   sudo certbot --nginx -d yourdomain.com
   ```

### Maintenance

- View logs:
  ```bash
  docker-compose logs -f
  ```

- Restart services:
  ```bash
  docker-compose restart
  ```

- Update application:
  ```bash
  git pull
  docker-compose up -d --build
  docker-compose exec app php artisan migrate
  ```
