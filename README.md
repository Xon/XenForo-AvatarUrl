# Xenforo-AvatarUrl

Rewrites Avatar URLS to be more cache friendly by moving the timestamp from a query string parameter to part of the URL. 

WARNING, requires URL rewrite support from host!

Nginx config:

    location /data/avatar/ {
        location ~ .* {
            rewrite ^/data/avatar/([0-9]*)/(.*)$ /data/avatars/$2 last;
            return 403;
        }
        return 403;
    }

