sudo apt-get update

sudo apt-get install nginx

sudo apt-get update

sudo apt install certbot python3-certbot-nginx

config = "server{ listen 80;
server_name etibet.store;}"

echo "$config" > /etc/nginx/sites-available/yoursite.xyz

sudo ln -s /etc/nginx/sites-available/yoursite.xyz /etc/nginx/sites-enabled

sudo service nginx restart

sudo certbot --nginx -d yoursite.xyz


location / {proxy_set_header Host $http_host;
proxy_set_header X-Real-IP $remote_addr;
proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
proxy_set_header X-Forwarded-Proto $scheme;



proxy_pass https://127.0.0.1:8443;



} to /etc/nginx/sites-available/yoursite.xyz