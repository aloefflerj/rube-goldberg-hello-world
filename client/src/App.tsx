import { useEffect, useState } from 'react';
import './App.css';
const wsUrl = 'ws://localhost:16000/cleanArch';
  interface Message{
    messageType: string;
    className: string;
    functionName: string;
    abstractionLayer: string;
  }
  
  function App() {
    const [msg, setMsg] = useState<Message>({
      messageType: '',
      className: '',
      functionName: '',
      abstractionLayer: '',
    })
    
    useEffect(() => {
      const webSocket = new WebSocket(wsUrl);
      webSocket.onmessage = (e) => {
        const data = JSON.parse(e.data);
        setMsg(data)
      }
  }, [])

  return (
    <>
      <div>
        <h2>{msg.messageType}</h2>
        <h2>{msg.className}</h2>
        <h2>{msg.functionName}</h2>
        <h2>{msg.abstractionLayer}</h2>
      </div>
    </>
  )
}

export default App
