FROM node:14.15.5-alpine3.13

RUN apk add curl bash git python3 make

COPY ../../.. /app/matecat
#RUN git clone --branch v2.20.40 --depth 1  https://github.com/matecat/MateCat.git /app/matecat

WORKDIR /app/matecat/nodejs
RUN yarn config set cafile /root/my-root-ca.crt -g && \
    yarn install

COPY ./config.ini /app/matecat/nodejs/    
CMD [ "node", "/app/matecat/nodejs/server.js" ]
