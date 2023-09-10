FROM node:20-alpine

ENV NPM_CONFIG_PREFIX=/home/node/.npm-global

WORKDIR /usr/src/app

COPY ./mqsender/package.json /usr/src/app/
COPY ./mqsender/package-lock.json /usr/src/app/

ARG UID=1000
ARG GID=1000

RUN chown -Rh ${UID}:${GID} .
USER ${UID}:${GID}

COPY --chown=node:node ./mqsender .

RUN npm i
RUN npm install -g nodemon

EXPOSE 16000