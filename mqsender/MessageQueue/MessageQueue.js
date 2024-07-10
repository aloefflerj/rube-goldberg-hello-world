class MessageQueue {
    #amqp;
    #channel;
    #queue;

    constructor(amqp, queue) {
        this.#amqp = amqp;
        this.#channel = null;
        this.#queue = queue;
    }

    init() {
        this.#amqp.connect("amqp://rabbitmq", (connectionError, connection) => {
            if (connectionError) {
                throw connectionError;
            }

            connection.createChannel((channelError, channel) => {
                if (channelError) {
                    throw channelError;
                }

                this.#channel = channel;
                this.#mqChannelAssert();
            });
        });
    }

    #mqChannelAssert() {
        if (this.#channel === null) {
            return;
        }

        this.#channel.assertQueue(this.#queue, {
            durable: false
        });
    }

    logWaitingMessage() {
        console.log(
            "[*] Waiting for messages in %s. To exit press CTRL+C",
            this.queue
        );
    }

    getChannel() {
        return this.#channel;
    }

    getQueue() {
        return this.#queue;
    }
}

export default MessageQueue;