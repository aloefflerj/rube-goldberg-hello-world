import { Button } from "./Button";

export function RequestButton({
    text,
    onClick,
    disabled = false
}: {
    text: string,
    onClick: () => void,
    disabled: boolean
}) {
    return <Button text={text} onClick={onClick} disabled={disabled} fontSize="24px"/>
}