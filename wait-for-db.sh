#!/bin/sh

set -e

echo "⏳ Waiting for database connection..."

until mysqladmin --silent ping -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" > /dev/null 2>&1; do
  >&2 echo "🔁 Database not ready, retrying..."
  sleep 2
done

echo "✅ Database is ready!"
exec "$@"
