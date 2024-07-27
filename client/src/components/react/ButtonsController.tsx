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
    const { nextStep, resetSteps } = useSteps();

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

    const callResetSteps = async () => {
        const response = await resetSteps();
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
            text="The Universe"
            onClick={callNextStep}
            disabled={disableButton(step, stepPossibleTitles.beggining, disableBigBangButton)}
        />

        <RequestButton
            text="Inflation"
            onClick={callNextStep}
            disabled={disableButton(step, stepPossibleTitles.theUniverse, disableBigBangButton)}
        />

        <RequestButton
            text="Big Bang"
            onClick={callNextStep}
            disabled={disableButton(step, stepPossibleTitles.inflation, disableBigBangButton)}
        />

        <RequestButton
            text="Nucleosynthesis"
            onClick={callNextStep}
            disabled={disableButton(step, stepPossibleTitles.bigBang, disableBigBangButton)}
        />

        <RequestButton
            text="Recombination"
            onClick={callNextStep}
            disabled={disableButton(step, stepPossibleTitles.nucleosynthesis, disableBigBangButton)}
        />

        <RequestButton
            text="First Stars"
            onClick={callNextStep}
            disabled={disableButton(step, stepPossibleTitles.recombination, disableBigBangButton)}
        />

        <RequestButton
            text="Our Sun"
            onClick={callNextStep}
            disabled={disableButton(step, stepPossibleTitles.firstStars, disableBigBangButton)}
        />

        <RequestButton
            text="Our Planet"
            onClick={callNextStep}
            disabled={disableButton(step, stepPossibleTitles.ourSun, disableBigBangButton)}
        />

        <RequestButton
            text="Hello"
            onClick={callNextStep}
            disabled={disableButton(step, stepPossibleTitles.ourPlanet, disableBigBangButton)}
        />

        <Button
            text={debug.active ? "Disable Backend Debug" : "Enable Backend Debug"}
            onClick={toggleDebug}
            disabled={false}
            fontSize="16px"
        />

        <Button
            text="Reset Steps"
            onClick={callResetSteps}
            disabled={false}
            fontSize="16px"
        />
    </>;
}