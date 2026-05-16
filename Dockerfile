FROM php:8.3-fpm

# Arguments pour l'utilisateur
ARG user=laravel
ARG uid=1000

# Dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libzip-dev \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev

# Nettoyage cache apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Extensions PHP
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    zip \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd

# Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

# Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Création de l'utilisateur système
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www

USER $user