export function Button({
    text,
    onClick,
    disabled = false,
    fontSize = '24px',
}: {
    text: string,
    onClick: () => void,
    disabled: boolean,
    fontSize: string,
}) {
    const style = `
        .react-button {
            width: 100%;
            height: 100%;
            background-color: #51afe6;
            border: 0;
            cursor: pointer;
            box-shadow: 0 0 5px 1px #2d6ba5;
            font-size: 24px;
            font-weight: bold;
            color: #2d6ba5;
        }
        
        .react-button:disabled {
            cursor: auto;
            opacity: 0.45;
        }
    `;

    return <>
        <button className='react-button'
            onClick={onClick}
            disabled={disabled}
            style={{ fontSize: fontSize }}
        >
            {text}
        </button>
        <style>
            {style}
        </style>
    </>
}