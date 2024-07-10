import ampq from 'amqplib/callback_api.js';
import MessageQueue from "./MessageQueue/MessageQueue.js";
import MessageQueueSocketSender from "./MessageQueue/MessageQueueSocketSender.js";

class MQSender {
    #messageQueue;
    #socketSender;

    constructor(queue, webSocketServerHandler) {
        this.#messageQueue = new MessageQueue(ampq, queue);
        this.#socketSender = new MessageQueueSocketSender(
            this.#messageQueue,
            webSocketServerHandler
        );
    }

    consumeAndSend() {
        setTimeout(() => {
            this.#messageQueue.init();
        }, 5000);

        setTimeout(() => {
            this.#socketSender.consumeAndSend();
        }, 6000);
    }
}

export default MQSender;