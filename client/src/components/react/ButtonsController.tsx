import { useState } from "react";
import { stepPossibleTitles } from "../../helpers/StepPossibleTitles";
import { useSteps } from "../../hooks/useSteps";
import { currentStep, disableButton, disablePrologueButton } from "../../service/Steps.service";
import type Step from "../../types/Step";
import { RequestButton } from "./elements/RequestButton";


export default function ButtonsController({ steps }: { steps: Step[] }) {
    const [step, setStep] = useState<Step | null>(currentStep(steps));
    const { nextStep } = useSteps();

    const callNextStep = async () => {
        const response = await nextStep();
        setStep(response.data.step);
    }

    return <>
        {/* <RequestButton text="Create Particle" onClick={newPositiveParticle} disabled={showNewParticleButton()} /> */}
        <RequestButton
            text="Begin"
            onClick={callNextStep}
            disabled={disableButton(step, stepPossibleTitles.prologue, disablePrologueButton)}
        />

        <RequestButton
            text="Big Bang"
            onClick={() => { }}
            disabled={step?.title !== stepPossibleTitles.bigBang}
        />
    </>;
}