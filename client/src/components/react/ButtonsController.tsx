import { useEffect, useState } from "react";
import { stepPossibleTitles } from "../../helpers/StepPossibleTitles";
import { useSteps } from "../../hooks/useSteps";
import { currentStep, disableBigBangButton, disableButton, disablePrologueButton } from "../../service/Steps.service";
import type Step from "../../types/Step";
import { RequestButton } from "./elements/RequestButton";
import { Button } from "./elements/Button";
import { useBackendDebug } from "../../hooks/useBackendDebug";
import type BackentDebug from "../../types/BackentDebug";


export default function ButtonsController({ steps }: { steps: Step[] }) {
    const [step, setStep] = useState<Step | null>(currentStep(steps));
    const { nextStep } = useSteps();

    let loadedGetDebugInfo = () => { return { active: false } };
    let loadedSetDebugInfo = (value: BackentDebug) => { };

    useEffect(() => {
        const { getDebugInfo, setDebugInfo } = useBackendDebug();
        loadedGetDebugInfo = getDebugInfo;
        loadedSetDebugInfo = setDebugInfo;
    });

    const [debug, setDebug] = useState<BackentDebug>(loadedGetDebugInfo() ?? { active: false });

    const callNextStep = async () => {
        const response = await nextStep();
        setStep(response.data.step);
    }

    const toggleDebug = () => {
        const newDebug = {
            active: !debug.active
        } as BackentDebug;

        loadedSetDebugInfo(newDebug);
        setDebug(loadedGetDebugInfo());
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
            onClick={callNextStep}
            disabled={disableButton(step, stepPossibleTitles.bigBang, disableBigBangButton)}
        />

        <RequestButton
            text="Big Bang"
            onClick={() => { }}
            disabled={true}
        />

        <RequestButton
            text="Big Bang"
            onClick={() => { }}
            disabled={true}
        />

        <Button
            text={debug.active ? "Deactivate Backend Debug" : "Activate Backend Debug"}
            onClick={toggleDebug}
            disabled={false}
            fontSize="16px"
        />
    </>;
}