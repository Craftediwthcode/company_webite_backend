<FilesMatch "\.(css|js)$">
    Header always set Cache-Control "max-age=172800,
    public, must-revalidate"
    Header set Access-Control-Allow-Origin "*"
</FilesMatch>
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
</IfModule>
<IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteCond %{HTTP_HOST} !^www\. [NC]
    RewriteRule ^(.*)$ http://www.%{HTTP_HOST}/$1 [L,R=301]
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>