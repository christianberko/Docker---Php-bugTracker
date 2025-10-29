
FROM php:8.2-cli AS builder
WORKDIR /build


COPY src/ ./


FROM php:8.2-cli
WORKDIR /app


COPY --from=builder /build/ ./



CMD ["php", "-S", "0.0.0.0:8080", "-t", "."]