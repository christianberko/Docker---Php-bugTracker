FROM php:8.2-cli AS builder
WORKDIR /build
# Copy source into the builder stage. This stage can be extended to run composer
# or other build steps if your project needs them (e.g. composer install).
COPY src/ ./

FROM php:8.2-cli
WORKDIR /app
# Copy the built application from the builder stage
COPY --from=builder /build/ ./

# Expose the port the PHP built-in server will use
EXPOSE 8080

# Start a simple PHP built-in server to serve the `src/` content. For
# production you might want to switch to php-fpm + nginx or apache.
CMD ["php", "-S", "0.0.0.0:8080", "-t", "."]