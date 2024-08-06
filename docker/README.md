# MateCat Docker

A dockerized version of MateCat (https://www.matecat.com/) - The CAT tool designed to meet your needs.

The documentation might raise doubts about whether it is feasible to run MateCat in containers, but in reality, it is indeed possible.

## How to use

```bash
docker compose up -d
```

To upload a file for translation, first sign up locally. After selecting 'Sign Up' from the top-right user icon, access the Apache Docker container by entering:

```
docker-compose exec apache /bin/bash
```
and display the mail queue log file:

```
cat storage/log_archive/mail_queue.log
```

This will include the email body with the confirmation link.
# matecat_final
# matecat_v2.20.40
