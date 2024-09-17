# MateCat Docker

A dockerized version of MateCat (https://www.matecat.com/) - The CAT tool designed to meet your needs.

The documentation might raise doubts about whether it is feasible to run MateCat in containers, but in reality, it is indeed possible.

## How to use


To Deploy

```bash
docker-compose up -d
```
To Dev

```
docker-compose watch
```
Volume Mounted at

```
/apache/app
```
and display the mail queue log file:

```
cat storage/log_archive/mail_queue.log
```