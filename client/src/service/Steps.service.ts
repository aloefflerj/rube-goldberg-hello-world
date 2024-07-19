import type Step from "../types/Step";

export function currentStep(steps: Step[]): Step | null {
    const currentStep = steps.find((step) => step.status === "ongoing");

    if (!currentStep) {
        return null;
    }

    return currentStep;
}

export function disableButton(currentStep: Step | null, stepTitle: string, callback: (...args: any[]) => boolean): boolean {
    return currentStep?.title !== stepTitle && callback();
}

export function disablePrologueButton(): boolean {
    return true;
}