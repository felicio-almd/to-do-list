FROM wyveo/nginx-php-fpm:latest

# Set the working directory
WORKDIR /usr/share/nginx/public

# Corrected directory path (fixed the typo)
RUN rm -rf /usr/share/nginx/html

# Copy the current directory's contents into the container
COPY . /usr/share/nginx/public

# Set the appropriate permissions for the storage directory
RUN chmod -R 775 /usr/share/nginx/public/storage/*

# Create a symbolic link for 'html' pointing to 'public'
RUN ln -s public html
