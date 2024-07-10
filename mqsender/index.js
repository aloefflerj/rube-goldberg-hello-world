#!/usr/bin/env node

const Websocket = require("ws");
const amqp = require("amqplib/callback_api");

class MQSender {
  constructor(queue, websocketServer) {
    this.queue = queue;
    this.connectedWebSockets = [];
    this.channel = null;
    this.wsServer = websocketServer;
  }

  init() {
    this.initWebsocketConnection();
    this.initMqConnection();
  }

  initWebsocketConnection() {
    this.wsServer.on("connection", (ws, request) => {
      console.log(" ~ connected to ws");

      ws.on("message", (message) => {
        const data = JSON.parse(message);
        console.log(data);
      });

      this.connectedWebSockets[request.url] = ws;

      ws.on("close", (code, reason) => {
        console.log(`Connection closed: ${code} ${reason}!`);
      });
    });
  }

  initMqConnection() {
    setTimeout(() => {
      amqp.connect("amqp://rabbitmq", (connectionError, connection) => {
        if (connectionError) {
          throw connectionError;
        }
        connection.createChannel((channelError, channel) => {
          if (channelError) {
            throw channelError;
          }

          this.channel = channel;
          this.mqChannelAssert();
          this.mqChannelWaitingMessage();
          this.mqChannelConsume();
        });
      });
    }, 5000);
  }

  mqChannelAssert() {
    this.channel.assertQueue(this.queue, {
      durable: false,
    });
  }

  mqChannelWaitingMessage() {
    console.log(
      "[*] Waiting for messages in %s. To exit press CTRL+C",
      this.queue
    );
  }

  mqChannelConsume() {
    this.channel.consume(
      this.queue,
      (queueMsg) => {
        if (queueMsg !== undefined && queueMsg !== null) {
          console.log(JSON.parse(queueMsg.content.toString()));
          if (this.connectedWebSockets['/' + this.queue] !== null || this.connectedWebSockets['/' + this.queue] !== undefined) {
            this.connectedWebSockets['/' + this.queue].send(queueMsg.content.toString());
          }
        }
      },
      {
        noAck: true,
      }
    );
  }
}

const webSocketServer = new Websocket.Server({
    port: 3000
  }, () => {
    console.log("[*] Server started on port 3000");
  }
);

const mqCleanArchSender = new MQSender('cleanArch', webSocketServer);
mqCleanArchSender.init();

const mqDataBaseUpdateSender = new MQSender('dataBaseUpdate', webSocketServer);
mqDataBaseUpdateSender.init();
