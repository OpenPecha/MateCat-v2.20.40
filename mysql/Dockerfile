FROM alpine:3.18 AS buildenv

RUN apk add git
RUN git clone --branch v2.20.40 --depth 1  https://github.com/matecat/MateCat.git /app/matecat

FROM mysql:5.7.43
# Our initial DB
COPY mysqld.cnf /etc/mysql/mysql.conf.d/mysqld.cnf
COPY --from=buildenv /app/matecat/INSTALL/matecat.sql /docker-entrypoint-initdb.d/
