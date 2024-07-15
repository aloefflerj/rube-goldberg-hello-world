export function Button({
    text,
    onClick,
    disabled = false
}: {
    text: string,
    onClick: () => void,
    disabled: boolean
}) {
    const style = `
        .react-button {
            width: 100%;
            height: 100%;
            background-color: #51afe6;
            border: 0;
            cursor: pointer;
            box-shadow: 0 0 5px 1px #2d6ba5;
            font-family: 'Times New Roman';
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
        >
            {text}
        </button>
        <style>
            {style}
        </style>
    </>
}