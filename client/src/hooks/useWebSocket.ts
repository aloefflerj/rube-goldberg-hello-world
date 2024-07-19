const wsBaseUrl = "ws://localhost:16000";

export const useWebSocket = (route: string) => ({
    onMessage: (callback: (this: WebSocket, ev: MessageEvent<any>) => any) => {
        const wsUrl = `${wsBaseUrl}${route}`;
        const webSocket = new WebSocket(wsUrl);

        webSocket.onmessage = callback;
    }
});