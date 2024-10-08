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
    git clone https://github.com/umayucar/library_management_crud_api.git
    ```

2. **Proje dizinine geçin**:
    ```bash
    cd library_management_crud_api
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

6. **Seeder'ları çalıştırın**:
    Projenin örnek verilerle başlatılması için seed dosyalarını çalıştırın:
    ```bash
    php artisan db:seed
    ```
    Bu komut, `database/seeders` klasöründe tanımlı olan tüm seeder'ları çalıştırarak veritabanınıza başlangıç verilerini ekleyecektir.

7. **Geliştirme sunucusunu başlatın**:
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


## Postman ile API Testi

Projeyi Postman kullanarak test edebilmek için aşağıdaki adımları izleyin:

### 1. Postman'i İndirin ve Kurun

- [Postman](https://www.postman.com/downloads/) uygulamasını indirin ve kurun.

### 2. API URL'leri ve Test Senaryoları

Projenizde bulunan API endpointlerini Postman'de test etmek için aşağıdaki adımları izleyin:

- **Base URL**: Geliştirme sunucusu başlatıldıktan sonra projeye erişmek için `http://127.0.0.1:8000` adresini kullanabilirsiniz.
  
  ### Örnek API İstekleri
  
  - **Yazar Ekleme (POST)**:
    ```http
    POST http://127.0.0.1:8000/api/authors
    ```
    **Form-Data:**

    | Key            | Value                | Açıklama                |
    |----------------|----------------------|-------------------------|
    | `name`         | Örnek Ad             | Yazarın adı             |
    | `biography`    | Biyografi            | Yazarın Bilgileri       |
    | `media`        | (Dosya Seç)          | Profil fotoğrafı (image)|

    Yeni bir yazar eklemek için kullanılır.

  - **Yazar Listeleme (GET)**:
    ```http
    GET http://127.0.0.1:8000/api/authors
    ```
    Mevcut yazarları listeler.

  - **Yazar Güncelleme (PUT)**:
    ```http
    PUT http://127.0.0.1:8000/api/authors/1
    ```
     **x-www-form-urlencoded**

    | Key            | Value                | Açıklama                |
    |----------------|----------------------|-------------------------|
    | `name`         | Örnek Yeni Ad        | Yazarın adı             |
    
    Yazar bilgilerini günceller.

   - **Yazar Profil Fotoğrafı Güncelleme (POST)**:
     ```http
     POST http://127.0.0.1:8000/api/authors/1/media
     ```
      **x-www-form-urlencoded**

     | Key            | Value                | Açıklama                |
     |----------------|----------------------|-------------------------|
     | `image`        | (Dosya Seç)          | Yazarın Yeni Fotoğrafı  |
    
     Bu istek, belirli bir yazarın profil fotoğrafını günceller.

  - **Yazar Silme (DELETE)**:
    ```http
    DELETE http://127.0.0.1:8000/api/authors/1
    ```
    Belirli bir yazarı soft delete methodu ile siler.

  - **Yazar Güncelleme için Versiyon Listesi (GET)**:
    ```http
    GET http://127.0.0.1:8000/api/authors/1/versions
    ```
    Bu istek, belirli bir yazar kaydı için yapılan güncellemeler sonucunda oluşan versiyonları listeler.
    İstek URL'sinde belirtilen 1 yazar ID'sidir ve bu yazar kaydı ile ilgili tüm versiyon bilgilerini döner.
    
  - **Kitap Ekleme (POST)**:
    ```http
    POST http://127.0.0.1:8000/api/books
    ```
    **Form-Data:**

    | Key            | Value                | Açıklama                |
    |----------------|----------------------|-------------------------|
    | `title`        | Örnek Başlık          | Kitabın başlığı        |
    | `author_id`    | 1                     | Yazarın ID'si          |
    | `description`  | Örnek Açıklama        | Kitap açıklaması       |
    | `library_id`   | 1                     | Bulunduğu kütüphane    |
    | `image`        | (Dosya Seç)           | Kitap kapağı (image)   |

    Bu istek, yeni bir kitap eklemenizi sağlar.

  - **Kitap Listeleme (GET)**:
    ```http
    GET http://127.0.0.1:8000/api/books
    ```
    Bu istek, mevcut kitapların listesini döner.

  - **Kitap Detay Görüntüleme (GET)**:
    ```http
    GET http://127.0.0.1:8000/api/books/1
    ```
    Bu istek, belirli bir kitabın detayını döner (kitap ID'si ile).

  - **Kitap Güncelleme (PUT)**:
    ```http
    PUT http://127.0.0.1:8000/api/books/1
    ```
    **x-www-form-urlencoded**

    | Key            | Value                | Açıklama                |
    |----------------|----------------------|-------------------------|
    | `title`        | Örnek Yeni Başlık    | Kitabın Yeni Başlığı    |
    
    Bu istek, belirli bir kitabın bilgilerini günceller.

  - **Kitap Silme (DELETE)**:
    ```http
    DELETE http://127.0.0.1:8000/api/books/1
    ```
    Bu istek, belirli bir kitabı soft delete methodu ile siler.

  - **Kitap Kapak Fotoğrafı Güncelleme (POST)**:
    ```http
    POST http://127.0.0.1:8000/api/books/1/media
    ```
    **x-www-form-urlencoded**

    | Key            | Value                | Açıklama                |
    |----------------|----------------------|-------------------------|
    | `image`        | (Dosya Seç)          | Yeni Kapak Fotoğrafı    |
    
    Bu istek, belirli bir kitabın kapak fotoğrafını günceller.

  - **Kitap Güncelleme için Versiyon Listesi (GET)**:
    ```http
    GET http://127.0.0.1:8000/api/books/1/versions
    ```
    Bu istek, belirli bir kitabın yapılan güncellemeleri sonucunda oluşan versiyonlarını listeler.
    İstek URL'sinde belirtilen 1 kitap ID'sidir ve bu kitap ile ilgili tüm versiyon bilgilerini döner.

### 3. Authorization (Yetkilendirme)

API endpointlerine erişim için yetkilendirme gereklidir, bu yüzden Postman'de yetkilendirme bilgileri eklenmelidir. Bu projede Laravel Sanctum kullanıldığı için, **Bearer Token** kullanarak yetkilendirme yapılacaktır:

1. **Postman'de yeni bir istek oluşturun**.
2. Üst menüde **Authorization** sekmesine gidin.
3. **Type** olarak `Bearer Token` seçin.
4. Token alanına API'den aldığınız `access_token` bilgisini girin.

## Lisans

Bu proje MIT lisansı altında lisanslanmıştır. Daha fazla bilgi için `LICENSE` dosyasına bakın.

