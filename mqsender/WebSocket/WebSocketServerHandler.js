class WebSocketServerHandler {
    #connectedWebSockets;
    #websocketServer;

    constructor(websocketServer) {
        this.#websocketServer = websocketServer;
        this.#connectedWebSockets = [];
    }

    listen() {
        this.#websocketServer.on('connection', (webSocket, request) => {
            const { url } = request;
            const queueName = '/' + url.split('/')[1];
            console.log(` ~ connected to websocket on the url '${url}'`)

            this.#loadOnMessageBehaviour(webSocket);
            if (this.#connectedWebSockets[queueName] === undefined) {
                this.#connectedWebSockets[queueName] = [];
            }
            this.#connectedWebSockets[queueName].push(webSocket);

            this.#loadOnCloseBehaviour(webSocket);
        });
    }

    #loadOnMessageBehaviour(webSocket) {
        webSocket.on('message', (message) => {
            const jsonData = JSON.parse(message);
            console.log(jsonData);
        });
    }

    #loadOnCloseBehaviour(webSocket) {
        webSocket.on('close', (code, reason) => {
            console.log(`Connection closed: ${code} ${reason}!`);
        });
    }

    getConnectedWebSockets() {
        return this.#connectedWebSockets;
    }
}

export default WebSocketServerHandler;