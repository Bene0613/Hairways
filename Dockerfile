# Use the official PHP image
FROM php:8.1-apache

# Copy your project files into the container
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html/

# Expose port 80 for HTTP traffic
EXPOSE 80
