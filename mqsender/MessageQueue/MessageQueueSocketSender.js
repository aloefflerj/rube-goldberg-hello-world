class MessageQueueSocketSender {
    #messageQueue;
    #webSocketServerHandler;

    constructor(messageQueue, webSocketServerHandler) {
        this.#messageQueue = messageQueue;
        this.#webSocketServerHandler = webSocketServerHandler;
    }

    consumeAndSend() {
        const channel = this.#messageQueue.getChannel();

        if (channel === null) {
            console.log('MQ channel is not ready yet');
            return;
        }

        const queue = this.#messageQueue.getQueue();

        channel.consume(
            queue,
            (queueMessage) => {
                if (queueMessage === undefined || queueMessage === null) {
                    console.log('queueMessage undefinded or null...');
                    return;
                }

                const queueUrl = `/${queue}`;
                const connectedWebsockets = this.#webSocketServerHandler.getConnectedWebSockets();
                const connectedWebSocketByUrl = connectedWebsockets[queueUrl];

                if (connectedWebSocketByUrl === undefined || connectedWebSocketByUrl === null) {
                    console.log('websocket does not exist on array...');
                    return;
                }

                connectedWebSocketByUrl.forEach((webSocket) => {
                    webSocket.send(queueMessage.content.toString());
                });
            }, {
            noAck: true,
        }
        );
    }
}

export default MessageQueueSocketSender;