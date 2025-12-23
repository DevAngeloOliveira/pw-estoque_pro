# Stage 1: Build frontend assets
FROM node:18-alpine AS node_builder

WORKDIR /app

# Copy package files
COPY package.json package-lock.json* ./

# Install Node dependencies
RUN npm install

# Copy frontend source files
COPY webpack.mix.js ./
COPY resources ./resources
COPY public ./public

# Build production assets
RUN npm run production

# Stage 2: Application
FROM php:8.3-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-configure gd \
    && docker-php-ext-install pdo_pgsql pdo_mysql mbstring zip exif pcntl gd opcache \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Habilitar módulos Apache
RUN a2enmod rewrite headers

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies (including dev for config cache)
RUN composer install --optimize-autoloader --no-scripts --no-interaction

# Copy application code
COPY . .

# Copy built assets from node_builder stage
COPY --from=node_builder /app/public ./public

# Copy custom PHP configuration
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini

# Configurar Apache DocumentRoot para /var/www/html/public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>' >> /etc/apache2/sites-available/000-default.conf

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Copy entrypoint script
COPY docker/render/start.sh /start.sh
RUN chmod +x /start.sh

# Expose port 80 for Apache
EXPOSE 80

# Start Apache
CMD ["/start.sh"]


# Start with entrypoint script
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
