import { useParticles } from "../../hooks/useParticles";
import { RequestButton } from "./elements/RequestButton";


export default function ButtonsController({ particles }: { particles: any[] }) {
    const { createParticle } = useParticles();

    async function newPositiveParticle(): Promise<void> {
        await createParticle({ charge: 'positive' }, true);
    }

    function showNewParticleButton(): boolean {
        return particles.length > 5;
    }

    return <>
        <RequestButton text="Create Particle" onClick={newPositiveParticle} disabled={showNewParticleButton()} />
    </>;
}