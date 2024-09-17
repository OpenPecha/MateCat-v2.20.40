# MateCat Docker

A dockerized version of MateCat (https://www.matecat.com/) - The CAT tool designed to meet your needs.


## Prerequisites
Ensure you have the following installed:
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)


## How to use


Deploying Matecat

```bash
docker-compose up -d
```
Developement Mode

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