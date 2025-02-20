# Proje Hakkında

Bu proje, Laravel 10 tabanlı bir web uygulamasıdır.

## Kullanılan Teknolojiler

- **Laravel**: PHP tabanlı bir web uygulama çatısı.
- **Vite**: Hızlı ve modern bir geliştirme sunucusu.
- **Bootstrap**: CSS tabanlı bir stil kütüphanesi.
- **jQuery**: JavaScript kütüphanesi.
- **SweetAlert2**: Uyarı mesajları oluşturmak için kullanılan bir kütüphane.

## Gereksinimler

- **PHP**: 8.1 veya üstü
- **Node.js** ve **npm**
- **Composer**

## Kurulum Adımları

1. Projeyi GitHub'dan klonlayın:
   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```

2. PHP bağımlılıklarını yükleyin:
   ```bash
   composer install
   ```

3. Node.js bağımlılıklarını yükleyin:
   ```bash
   npm install
   ```

4. Çevresel değişken dosyasını ayarlayın:
   ```bash
   cp .env.example .env
   ```
   `.env` dosyasını açın ve gerekli yapılandırmaları yapın.

5. Laravel uygulamasını başlatın:
   ```bash
   php artisan serve --host=0.0.0.0 --port=8000
   ```

## Geliştirme Sunucusunu Başlatma

Vite geliştirme sunucusunu başlatmak için:
```bash
npm run dev
```

## API İstekleri

API istekleri için Laravel'in sağladığı `php artisan serve` komutunu kullanarak sunucuyu çalıştırın.

## API Anahtarı Kontrolü

API istekleri için `X-API-KEY` başlığı kullanılmaktadır. Bu anahtar, isteklerin doğrulanması için gereklidir ve middleware tarafından kontrol edilir. Aşağıdaki adımları izleyerek API anahtarınızı ayarlayabilirsiniz:

1. `.env` dosyanızda `API_KEY` değişkenini tanımlayın ve değerini ayarlayın:
   ```env
   API_KEY=your_api_key_here
   ```

2. API isteklerinizi yaparken `X-API-KEY` başlığını ekleyin:
   ```http
   X-API-KEY: your_api_key_here
   ```

Middleware, gelen isteklerdeki `X-API-KEY` başlığını kontrol eder ve `.env` dosyasındaki `API_KEY` ile eşleşip eşleşmediğini doğrular. Eşleşme sağlanmazsa, istek reddedilir.

