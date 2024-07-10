import { useParticles } from "../../../hooks/useParticles";
import { Button } from "./Button";

export function RequestButton({ text }: { text: string }) {
    const { createParticle } = useParticles();

    async function newPositiveParticle() {
        await createParticle({ charge: 'positive' });
    }

    return <Button text={text} onClick={() => newPositiveParticle()} />
}