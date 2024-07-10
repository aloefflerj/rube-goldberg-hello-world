export function Button({ text, onClick }: { text: string, onClick: () => void }) {
    return <button onClick={onClick} style={{
        width: '100%',
        height: '100%',
        backgroundColor: '#51afe6',
        border: '0',
        cursor: 'pointer',
        boxShadow: '0 0 5px 1px #2d6ba5',
        fontFamily: 'Times New Roman',
        fontSize: '24px',
        fontWeight: 'bold',
        color: '#2d6ba5'
    }}>
        {text}
    </button>
}