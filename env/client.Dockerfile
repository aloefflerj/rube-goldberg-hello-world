FROM node:lts-alpine as runtime

ENV NPM_CONFIG_PREFIX=/home/node/.npm-global

WORKDIR /app

ENV PATH /app/node_modules/.bin:$PATH

COPY ./client/package*.json /app

RUN npm install
COPY ./client /app

CMD ["npm", "run", "dev"]
