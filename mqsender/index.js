import WebSocketServerHandler from './WebSocket/WebSocketServerHandler.js';
import { WebSocketServer } from 'ws';
import MQSender from './MQSender.js';

/** ===== WSS CONFIG ==== */
const wss = new WebSocketServer({
    port: 3000
}, () => {
    console.log('[*] WS Server running on port 3000')
});
/** ===================== */


/** ===== WSS CONNECTION ==== */
const webSocketServerHandler = new WebSocketServerHandler(wss);
webSocketServerHandler.listen();
/** ======================== */


/** ===== CLEAN ARCHITECTURE DEBUG QUEUE ===== */
const cleanArchMQSender = new MQSender('cleanArch', webSocketServerHandler);
cleanArchMQSender.consumeAndSend();
/** ========================================== */


/** ===== DATABASE UPDATE QUEUE ===== */
const newEntityMQSender = new MQSender('newEntity', webSocketServerHandler);
newEntityMQSender.consumeAndSend();
/** ================================= */