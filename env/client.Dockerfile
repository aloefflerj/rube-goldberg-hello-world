FROM node:20.5-alpine

WORKDIR /app

RUN mkdir -p /opt/node_modules

COPY ./client /app
COPY ./client/package*.json /app/

ARG UID=1000
ARG GID=1000

RUN chown -Rh ${UID}:${GID} /app
USER ${UID}:${GID}

RUN npm install --include=dev

EXPOSE 12000