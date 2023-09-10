#!/usr/bin/env node

const Websocket = require("ws");
const amqp = require("amqplib/callback_api");

class MQSender {
  constructor() {
    this.queue = "cleanArch";
    this.connectedWs = null;
    this.channel = null;
    this.server = this.configWebsocketServer();
  }

  init() {
    this.initWebsocketConnection();
    this.initMqConnection();
  }

  configWebsocketServer() {
    return new Websocket.Server(
      {
        port: 3000,
      },
      () => {
        console.log("[*] Server started on port 3000");
      }
    );
  }

  initWebsocketConnection() {
    this.server.on("connection", (ws) => {
      console.log(" ~ connected to ws");
      ws.on("message", (message) => {
        const data = JSON.parse(message);
        console.log(data);
      });

      this.connectedWs = ws;

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
    }, 1000);
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
          if (this.connectedWs !== null)
            this.connectedWs.send(queueMsg.content.toString());
        }
      },
      {
        noAck: true,
      }
    );
  }
}

const mqSender = new MQSender();
mqSender.init();
