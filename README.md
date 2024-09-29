<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Kütüphane Yönetim Sistemi

Bu proje, Laravel ve MySQL kullanarak bir kütüphane yönetim sistemi geliştirmeyi amaçlamaktadır. Sistem, kitaplar, yazarlar ve kütüphaneler arasındaki ilişkileri yönetmekte ve kullanıcıların kitap ve yazar bilgilerini eklemesine, düzenlemesine ve silmesine olanak tanımaktadır. Ayrıca, yapılan değişikliklerin geriye dönük olarak kayıt altına alınması ve medya dosyalarının yüklenmesi gibi özellikler de bu sistemin bir parçasıdır.

## Proje Amacı

Kütüphane Yönetim Sistemi, nesne yönelimli programlama (OOP) prensiplerine uygun olarak geliştirilmiştir ve aşağıdaki işlevleri yerine getirmektedir:

- Kitaplar, yazarlar ve kütüphaneler arasında ilişkileri yönetmek.
- Kitap ve yazarlar üzerinde CRUD (Create, Read, Update, Delete) işlemleri yapabilmek.
- Yapılan değişikliklerin geriye dönük olarak kayıt altına alınması (Revizyon Takibi).
- Kitaplar ve yazarlar için medya dosyaları (kapak fotoğrafları vb.) yüklenebilmesi.

## Gereksinimler

### Genel Gereksinimler

- **Varlıklar**: Kitaplar, yazarlar ve kütüphaneler olmak üzere üç temel varlık oluşturulacaktır.
- **CRUD İşlemleri**: Kitaplar ve yazarlar üzerinde ekleme, düzenleme ve silme işlemleri yapılabilecektir.
- **Revizyon Takibi**: Yapılan değişikliklerin (örneğin isim değişiklikleri, güncelleme zamanları) geriye dönük kayıtları tutulacaktır.
- **Medya Yükleme**: Kitaplar ve yazarlar için medya dosyaları (örneğin kapak fotoğrafları, biyografi görselleri) yüklenebilecektir.

### Teknik Gereksinimler

- **Geliştirme Dili**: PHP (Laravel Framework).
- **Veritabanı**: MySQL.
- **Kod Yapısı**: Object-Oriented Programming (OOP) prensiplerine uygun olarak yapılandırılmıştır.
- **Ek Paketler**:
  - [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary) paketi, kitaplar ve yazarlar için medya yönetimini sağlamak için kullanılacaktır.
  - [Versionable](https://github.com/mpociot/versionable) paketi, model revizyonlarının takibini yapmak için entegre edilecektir.

## Kurulum

Projeyi yerel ortamınıza kurmak için aşağıdaki adımları izleyin:

### Gereksinimler

Bu projenin çalışabilmesi için aşağıdaki gereksinimlerin karşılandığından emin olun:

- PHP >= 8.0
- Composer
- MySQL

### Adımlar

1. **Depoyu klonlayın**:
    ```bash
    git clone https://github.com/kullanici-adi/proje-adi.git
    ```

2. **Proje dizinine geçin**:
    ```bash
    cd proje-adi
    ```

3. **Gerekli bağımlılıkları yükleyin**:
    ```bash
    composer install
    ```

4. **.env dosyasını yapılandırın**:
    - `.env.example` dosyasını kopyalayarak bir `.env` dosyası oluşturun:
      ```bash
      cp .env.example .env
      ```
    - `.env` dosyasında veritabanı ve diğer yapılandırmaları güncelleyin.

5. **Veritabanını oluşturun**:
    ```bash
    php artisan migrate
    ```

6. **Geliştirme sunucusunu başlatın**:
    ```bash
    php artisan serve
    ```

## Kullanılan Paketler

- **Spatie Media Library**: Kitaplar ve yazarlar için medya yönetimi (kapak fotoğrafı vb.) işlevini sağlar.
- **Versionable**: Kitap ve yazarlar üzerindeki değişiklikleri geriye dönük olarak kayıt altına alır.

## Özellikler

- **Kitap ve Yazar Yönetimi**: CRUD işlemleri yapılabilmektedir.
- **Revizyon Takibi**: Yapılan değişiklikler Versionable paketi ile kaydedilmektedir.
- **Medya Yönetimi**: Kitaplara ve yazarlara medya dosyaları yüklenebilir.

## Geliştirici Notları

- Bu proje OOP prensiplerine uygun olarak geliştirilmiştir.
- Laravel'in güçlü ORM yapısı ve paket entegrasyonları kullanılmıştır.

## Lisans

Bu proje MIT lisansı altında lisanslanmıştır. Daha fazla bilgi için `LICENSE` dosyasına bakın.

